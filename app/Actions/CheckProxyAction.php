<?php

namespace App\Actions;
use GuzzleHttp\Client;

use App\Jobs\ProxyCheckJob;
use App\Models\HistoryCheck;

class CheckProxyAction
{
    protected $client, $action;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function handle(Array $proxies)
    {
            $historyCheck = HistoryCheck::create(['total_proxies_checked' => 0, 'working_proxies' => 0]);
            foreach ($proxies as $proxy) {
                ProxyCheckJob::dispatch($proxy, $historyCheck)->onQueue('proxy_queue');
            }

            return response()->json(['message' => 'Proxies added to the queue for background checking']);
    }

}
