<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/21/19
 * Time: 11:39 AM
 */

namespace AsyncRequest\Traits;

use AsyncRequest\Interfaces\TaskInstanceInterface;
use RedisException;
use UnifyRedis\UnifyRedis;

trait AddTask
{
    /**
     * @param $job_key
     * @param TaskInstanceInterface $taskInstance
     * @param $params
     * @throws RedisException
     */
    public static function generate($job_key, TaskInstanceInterface $taskInstance, $params)
    {
        $instance = $taskInstance->generate($params);

        UnifyRedis::zadd($job_key, 0, $instance->get_primary_key_val());
    }

}