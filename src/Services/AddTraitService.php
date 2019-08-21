<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/21/19
 * Time: 11:47 AM
 */

namespace AsyncRequest\Services;

use AsyncRequest\Interfaces\AddTaskInterface;
use AsyncRequest\Traits\AddTask;

class AddTraitService implements AddTaskInterface
{
    use AddTask;
}