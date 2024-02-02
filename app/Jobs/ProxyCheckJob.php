<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use GuzzleHttp\Client;
use App\Models\Proxy;
use App\Models\HistoryCheck;

class ProxyCheckJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $proxy, $historyCheck;

    /**
     * Create a new job instance.
     */
    public function __construct(String $proxy, HistoryCheck $historyCheck)
    {
        $this->proxy = $proxy;
        $this->historyCheck = $historyCheck;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
            $isHttpProxy = $isSocksProxy = false;
            $proxyAddress = trim($this->proxy);


            $proxyData = [
                "ip_port" => $proxyAddress,
                "history_check_id" => $this->historyCheck->id
            ];

            $isHttpProxy = $this->checkIsHttp($proxyAddress);
            if(!$isHttpProxy){
                $isSocksProxy = $this->checkIsSocks($proxyAddress);
            }

            if($isHttpProxy){
               $proxyData["type"] = "http"; 
               $proxyData["status"] = "working";
            }
            elseif($isSocksProxy){
                $proxyData["type"] = "socks";
                $proxyData["status"] = "working";
            }
            else{
                $proxyData["type"] = "unknown";
                $proxyData["status"] = "not_working";
            }

            $this->historyCheck->increment('total_proxies_checked');
            if ($isHttpProxy || $isSocksProxy) {
                $this->historyCheck->increment('working_proxies');
            }
            $this->historyCheck->save();

            Proxy::create($proxyData);

    }

    public function checkIsHttp(String $proxyAddress)
    {
        $client = new Client();
        try{
            $httpResponse = $client->request('GET', 'http://check-host.net/ip', 
            [
                'proxy' => "http://$proxyAddress",
                'connect_timeout' => 5,
            ]);

            if($httpResponse->getStatusCode() === 200){
                return true;
            }
            return false;
        }
        catch(\Exception $e){
            return false;
        }
    }

    public function checkIsSocks(String $proxyAddress)
    {
        $client = new Client();
        try{
            $socksResponse = $client->request('GET', 'http://check-host.net/ip', [
                'proxy' => "socks5h://$proxyAddress",
                'connect_timeout' => 5,
            ]);

            if($socksResponse->getStatusCode() === 200){
                return true;
            }
            return false;
        }
        catch(\Exception $e){
            return false;
        }
    }
}
