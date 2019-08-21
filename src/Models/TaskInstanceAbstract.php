<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/21/19
 * Time: 3:29 PM
 */

namespace AsyncRequest\Models;

use AsyncRequest\Interfaces\TaskInstanceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * 这里只是一个选项而已　真正做出约束的是　TaskInstanceInterface
 * 所以在这里的实现依赖了　特定的　Model
 *
 * Class TaskInstanceAbstract
 * @package AsyncRequest\Models
 */
abstract class TaskInstanceAbstract extends Model implements TaskInstanceInterface
{
    public function get_primary_key_val() : string
    {
        return $user->getKey();
    }

    public function retrieve_jobs_instances($ids) : Collection
    {
        $column = $user->getKeyName();

        return self::whereIn($column, $ids)->get();
    }

}