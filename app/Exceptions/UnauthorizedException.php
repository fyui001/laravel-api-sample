<?php

namespace App\Exceptions;

use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UnauthorizedException extends ApiErrorException
{
    protected $statusCode = Response::HTTP_UNAUTHORIZED;
    protected $code = Response::HTTP_UNAUTHORIZED;
}
