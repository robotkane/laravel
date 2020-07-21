<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class PublishController extends Controller
{
    public function index(Request $request)
    {
        Redis::publish('publish_subscribe', $request->get('publish_subscribe', 'test'));
    }
}
