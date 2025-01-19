<?php

namespace Elmogy\Larafast\Traits\Exceptions;

use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;
use Core\Base\Traits\Response\SendResponse;

if (!class_exists(SendResponse::class, false)) {
    module_autoloader();
    module_autoloader('Plugins', base_path() . '/plugins');
}

trait Handler
{
    use SendResponse;

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function handleExceptions()
    {
        $this->renderable(function (AuthenticationException $e, $request) {
            return $this->sendResponse([], $e->getMessage(), false, 401);
        });

        $this->renderable(function (AuthorizationException $e, $request) {
            return $this->sendResponse([], $e->getMessage(), false, 403);
        });

        $this->renderable(function (ValidationException $e, $request) {
            $errors         = [];
            $code_attribute = config('larafast.validation.code');

            foreach ($e->errors() as $field => $error) {
                $errors[] = [
                    config('larafast.validation.field')   => $field,
                    config('larafast.validation.message') => $error[0]['message'],
                    $code_attribute                       => (int)$error[0][$code_attribute],
                ];
            }

            return $this->sendResponse($errors, $e->getMessage(), false, 422);
        });

        $this->renderable(function (Throwable $e, $request) {
            return $this->sendExceptionResponse($e, false);
        });
    }
}
