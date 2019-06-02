<?php

namespace App\Exceptions;


use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


trait ExceptionTrait {

    public function apiException( $request, Exception $exception){

        if ($exception instanceof ModelNotFoundException) {
            return  response(['errors' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }
        if ($exception instanceof NotFoundHttpException) {
            return  response(['errors' => 'Route not found!'], Response::HTTP_NOT_FOUND);
        }
    }
}


?>
