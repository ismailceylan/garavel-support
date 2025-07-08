<?php

namespace Garavel\Support\Facades;

use Garavel\Http\JsonResponse as RealResponse;

/**
 * Facade for JsonResponse class.
 */
class JsonResponse extends Facade
{
	/**
	 * Returns json response class' namespace.
	 *
	 * @return string
	 */
	public static function getFacadeAccessor(): string
	{
		return RealResponse::class;
	}
}
