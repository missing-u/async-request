<?php

namespace AsyncRequest\Interfaces;

/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/21/19
 * Time: 11:31 AM
 */
interface AddTaskInterface
{
    public static function generate($job_key, TaskInstanceInterface $taskInstance, $params);
}