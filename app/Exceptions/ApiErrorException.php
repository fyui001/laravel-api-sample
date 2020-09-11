<?php

namespace App\Exceptions;

use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiErrorException extends HttpException
{
    protected $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
    protected $code = null;

    /**
     * @param string     $message  The internal exception message
     * @param string     $code     The internal exception code
     * @param \Throwable $previous The previous exception
     */
    public function __construct(string $message = null, string $code = null, \Throwable $previous = null, array $headers = [])
    {
        if (is_array($message)) {
            $message = implode(' ', $message);
        }

        $this->code = $code;
        parent::__construct($this->statusCode, $message, $previous, $headers);
    }

    /**
     * get system code of exception
     *
     * @return string
     */
    public function getAPICode()
    {
        return $this->code;
    }
}
