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
