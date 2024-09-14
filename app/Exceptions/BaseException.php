<?php

namespace App\Exceptions;

/**
 * Class BaseException
 *
 * This class extends the \Exception class and serves as the base class for all custom exceptions in the application.
 *
 * @package App\Exceptions
 */
class BaseException extends \Exception
{
    public function __construct(
        string $message = null,
        int $code = 0,
        \Throwable $previous = null
    ) {
        if ($message === null) {
            $message = "An exception occurred.";
        }
        echo "Stack trace:\n" . $this->getTraceAsString() . "\n";

        // Call the parent class's constructor
        parent::__construct($message, $code, $previous);
    }
}
