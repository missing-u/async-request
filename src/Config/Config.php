<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 7/15/19
 * Time: 11:57 AM
 */

namespace AsyncRequest\Config;

class Config
{
    private $max_try_times = 3;

    private $one_time_handle_jobs = 10 * 60;

    /**
     * @return int
     */
    public function getMaxTryTimes() : int
    {
        return $this->max_try_times;
    }

    /**
     * @param int $max_try_times
     */
    public function setMaxTryTimes(int $max_try_times)
    {
        $this->max_try_times = $max_try_times;
    }

    /**
     * @return int
     */
    public function getOneTimeHandleJobs() : int
    {
        return $this->one_time_handle_jobs;
    }

    /**
     * @param int $one_time_handle_jobs
     */
    public function setOneTimeHandleJobs(int $one_time_handle_jobs)
    {
        $this->one_time_handle_jobs = $one_time_handle_jobs;
    }

}
