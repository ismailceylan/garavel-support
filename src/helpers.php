<?php

use Garavel\Support\Facades\Request;
use Garavel\Support\Facades\Response;
use Garavel\Support\Facades\JsonResponse;

if( ! function_exists( 'response' ))
{
	/**
	 * Returns the response instance.
	 *
	 * @return \Garavel\Http\Response
	 */
	function response()
	{
		return Response::getInstance();
	}
}

if( ! function_exists( 'jsonResponse' ))
{
	/**
	 * Returns the JSON response instance.
	 *
	 * @return \Garavel\Http\JsonResponse
	 */
	function jsonResponse()
	{
		return JsonResponse::getInstance();
	}
}

if( ! function_exists( 'request' ))
{
	/**
	 * Returns the request instance.
	 *
	 * @return \Garavel\Http\Request
	 */
	function request()
	{
		return Request::getInstance();
	}
}

if( ! function_exists( 'dd' ))
{
	/**
	 * Dumps the given variables and ends the execution of the script.
	 *
	 * This function is a shortcut for var_dump() and exit.
	 *
	 * @param mixed ...$args The variables to dump.
	 */
	function dd( ...$args )
	{
		var_dump( ...$args );
		exit;
	}
}

if( ! function_exists( 'dump' ))
{
	/**
	 * Dumps the given variables.
	 *
	 * This function is a shortcut for var_dump().
	 *
	 * @param mixed ...$args The variables to dump.
	 */
	function dump( ...$args )
	{
		var_dump( ...$args );
	}
}
