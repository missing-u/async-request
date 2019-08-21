<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 7/15/19
 * Time: 10:59 AM
 */

namespace AsyncRequest\Traits;

use AsyncRequest\Config\RequestFlowConstants;
use AsyncRequest\Interfaces\LoggerInstanceInterface;
use AsyncRequest\Interfaces\TaskInstanceInterface;
use RedisException;
use UnifyRedis\Execeptions\ParamsNeedGreaterThanZeroException;
use UnifyRedis\UnifyRedis;

/**
 * 所有的任务使用order set来进行管理
 * 越来越发现 order set 优于 queue
 * Trait RequestFlow
 * @package App\Traits
 */
trait DealTask
{
    public function main($job_key, TaskInstanceInterface $taskInstance, LoggerInstanceInterface $loggerInstance)
    {
        $job_ids = $this->get_job_ids($job_key, RequestFlowConstants::ONE_TIME_HANDLE_TIMES);

        /**
         * @var Collection|\Illuminate\Database\Eloquent\Collection
         */
        $tasks = $taskInstance->retrieve_jobs_instances($job_ids);

        $tasks->each(function (SyncFunderTask $task) use ($job_key, $loggerInstance) {
            $this->handle($task, $loggerInstance);
        });
    }

    public function handle($task, LoggerInstanceInterface $loggerInstance)
    {
        try {

            $this->doSingle($task);

        } catch (Throwable $throwable) {

            $loggerInstance->generate($throwable);

            $this->try_re_run($job_key, $task->id, $task->times);

        } finally {

            $task->add_one_time();

        }
    }


    /**
     * @param $key
     * @param $num
     * @return array
     * @throws ParamsNeedGreaterThanZeroException
     * @throws RedisException
     */
    public function get_job_ids($key, $num)
    {
        return UnifyRedis::zset_remove_highests($key, $num);
    }

    /**
     * 尝试重新推送
     * @param $key
     * @param $task_id
     * @param $run_times
     * @param int $max_try_times
     * @param int $priority
     * @return bool|mixed
     */
    public function try_re_run(
        $key,
        $task_id,
        $run_times,
        $max_try_times = RequestFlowConstants::default_max_try_times,
        $priority = 0
    ) {
        if ($this->can_re_run($run_times, $max_try_times)) {
            return $this->add_to_re_run_tasks($key, $priority, $task_id);
        }

        return false;
    }

    public function add_to_re_run_tasks($key, $priority, $task_id)
    {
        return UnifyRedis::zadd($key, $priority, $task_id);
    }

    //现在只判断 是否命中 尝试次数上线
    public function can_re_run(
        $run_times,
        $max_try_times = RequestFlowConstants::default_max_try_times
    ) {
        return !$this->hit_max_try_times($run_times, $max_try_times);
    }

    public function hit_max_try_times($run_times, $max_try_times)
    {
        return $run_times >= $max_try_times;
    }
}