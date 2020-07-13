<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class Statistics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $request;
    public $tries = 2;//指定最大失败次数
    public $timeout = 80;//超时（单位：秒）

    public function __construct($request)
    {
        $this->request = $request;
    }

    //在指定时间内允许任务的最大尝试时间，注意当设置了最大尝试时间，$tries将失去作用。
    public function retryUntil()
    {
        return now()->addSeconds(5);
    }

    public function handle()
    {
        Log::debug($this->request);
        //限定给定类型任务每 60 秒只运行 1 次
        Redis::throttle('Statistics:throttle')->allow(1)->every(60)->then(function () {
            Log::debug("throttle success");
        }, function () {
            Log::debug("throttle error");
            return $this->release(5);
        });
        //任务一次只能由一个工作进程
        Redis::funnel('Statistics:funnel')->limit(1)->then(function () {
            Log::debug("funnel success");
        }, function () {
            Log::debug("funnel error");
            return $this->release(5);
        });
    }

    public function failed(\Exception $exception)
    {
        Log::debug("failed " . $exception->getMessage());
    }
}
