<?php

namespace Dxnz\Hindiafest\Models;

use Exception as BaseException;

class Exception extends BaseException
{
  // Custom exception handling logic can go here
  protected $userMessage;

  public function __construct($message = "", $code = 0, BaseException $previous = null)
  {
    // Optional: customize the exception message or code
    parent::__construct($message, $code, $previous);

    // You can set a user-friendly message here
    $this->userMessage = $message;
  }

  // Getter for user-friendly message
  public function getUserMessage()
  {
    return $this->userMessage;
  }

  // You can override other methods as needed
}
