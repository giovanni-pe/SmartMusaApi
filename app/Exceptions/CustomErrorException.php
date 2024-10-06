<?php

namespace App\Exceptions;

use Exception;

class CustomErrorException extends Exception
{
    protected $message;
    protected $statusCode;

    public function __construct($message = 'Algo salió mal', $statusCode = 400)
    {
        $this->message = $message;
        $this->statusCode = $statusCode;

        parent::__construct($this->message, $this->statusCode);
    }

    public function render($request)
    {
        // Aquí puedes personalizar la respuesta en formato JSON
        return response()->json([
            'error' => true,
            'message' => $this->message
        ], $this->statusCode);
    }
}
