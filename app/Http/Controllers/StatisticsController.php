<?php

namespace App\Http\Controllers;

use App\Jobs\Statistics;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index(Request $request)
    {
        $this->dispatch(new Statistics($request->all()));
    }
}
