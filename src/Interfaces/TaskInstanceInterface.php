<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/21/19
 * Time: 1:50 PM
 */

namespace AsyncRequest\Interfaces;



use Illuminate\Support\Collection;

interface TaskInstanceInterface
{
    public function generate($data) : self;

    public function get_primary_key_val() : string;

    /**
     * @param $ids
     * @return Collection|\Illuminate\Database\Eloquent\Collection
     */
    public function retrieve_jobs_instances($ids) ;
}