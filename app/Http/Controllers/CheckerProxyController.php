<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Actions\CheckProxyAction;
use App\Models\HistoryCheck;

class CheckerProxyController extends Controller
{
    public function index()
    {

        return view('test');

    }

    public function history()
    {
        $historyChecks = HistoryCheck::all();
        return view('history', ['historyChecks' => $historyChecks]);
    }

    public function historyDetail(HistoryCheck $historyCheck)
    {
        return view('historyDetail', ['historyCheck' => $historyCheck]);
    }

    public function checkProxy(Request $request, CheckProxyAction $action)
    {

        $proxies = explode("\n", $request->input('proxies'));
        $action->handle($proxies);

    }
}
