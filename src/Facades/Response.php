<?php

namespace Garavel\Support\Facades;

use Garavel\Http\Response as RealResponse;

/**
 * Facade for Response class.
 */
class Response extends Facade
{
	/**
	 * Returns response class' namespace.
	 *
	 * @return string
	 */
	public static function getFacadeAccessor(): string
	{
		return RealResponse::class;
	}
}
