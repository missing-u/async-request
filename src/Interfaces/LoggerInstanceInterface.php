<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/21/19
 * Time: 1:50 PM
 */

namespace AsyncRequest\Interfaces;


use Illuminate\Support\Collection;

use Throwable;

interface LoggerInstanceInterface
{
    public function generate($sign, Throwable $throwable);
}