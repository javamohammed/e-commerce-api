<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class ProductNotBelongsToUser extends Exception
{
    //
    public function report()
    {
        //
    }
    public function render($request, Exception $exception)
    {
        return response(['errors' => 'Product Not Belongs To User!'], Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
