### laraval queue

使用database队列驱动

- php artisan queue:table：database队列
- php artisan queue:failed-table
- php artisan migrate

创建任务类文件

- php artisan make:job Statistics

创建任务执行

- php artisan queue:work 
  - --tries=3：指定最大失败次数
  - --timeout=30：超时（单位：秒）

artisan命令

- php artisan queue:failed：查看失败任务
- php artisan queue:retry 5：重试id为5的任务
- php artisan queue:forget 5：删除id为5的任务
- php artisan queue:flush：清除所有失败的任务

### redis命令

keys queues*：查询队列key

type queues:test：获取类型

lrange queues:test 0 12：查询列表 12 条数据

### 注意问题

- 如果redis使用集群，队列名称必须包含 `key hash tag`，以确保给定队列对应的所有 Redis keys 都存放到同一个 `hash slot`。例如：'queue' => '{default}'

