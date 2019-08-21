<?php

namespace AsyncRequest\Exceptions;


/**
 * Model::find($id);
 *
 * 类似这种的不存在
 *
 * Class RecordNotExistException
 * @package App\Modules\Exceptions
 */
class RecordNotExistException extends BaseAsyncRequestException
{
    public function __construct($data)
    {
        [
            'table' => $table,
            'id'    => $id,
        ] = $data;

        $message = sprintf('表%s中id为%s的记录不存在', $table, $id);

        parent::__construct($message);
    }
}

