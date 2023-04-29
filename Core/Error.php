<?php

namespace App\Core;

class Error
{

	/**
	 *Error handler. Converts all errors to exceptions
	 *@param int $level error level
	 *@param string $message error message
	 *@param string $file the file in which the error happened
	 *@param int $line the line in which the error happened
	 **/
	public static function errorHandler($level, $message, $file, $line)
	{
		if (error_reporting() !== 0) {
			throw new \ErrorException($message, 0, $level, $file, $line);
		}
	}

	/**
	 *Handles the exception
	 *@param Exception $exception
	 *@return void
	 **/
	public static function exceptionHandler($exception)

	{

		$code = $exception->getCode();
		if (!$code) {
			$code = 500;
		}
		$code = intval($code);
		http_response_code($code);
		if ($_ENV["SHOW_ERRORS"] == true) {

			View::render('base.php', [
				'title' => "error",
				'template' => "Errors/FullError.php",
				'statusCode' => $code,
				'errors' => [
					"message" => $exception->getMessage(),
					"stackTrace" => $exception->getTraceAsString(),
					"file" => $exception->getFile(),
					"line" => $exception->getLine()
				]
			]);
		} else {

			View::render('base.php', [
				'title' => "error",
				'template' => "Errors/clientError.php",
				'statusCode' => $code,
				'errors' => [
					"message" => $exception->getMessage(),
				]
			]);
		}
	}
}
