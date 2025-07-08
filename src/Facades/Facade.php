<?php

namespace Garavel\Support\Facades;

use RuntimeException;

/**
 * Makes class methods accessible via static methods.
 */
class Facade
{
	/**
	 * Subclass instances.
	 *
	 * @var array
	 */
	protected static array $instances = [];

	/**
	 * Dynamically handle calls to the class.
	 *
	 * @param string $method Method name.
	 * @param array $arguments Method arguments.
	 * @return mixed
	 */
	public static function __callStatic( string $method, array $arguments ): mixed
	{
		return static::getInstance()->{ $method }( ...$arguments );
	}

	/**
	 * Returns underlying class' instance.
	 *
	 * This method is used to get the instance of the underlying class.
	 * It is used to resolve the instance of the class that is needed
	 * to call the given method.
	 *
	 * @return object Underlying class' instance.
	 */
	public static function getInstance(): object
	{
		$namespace = static::getFacadeAccessor();

		return static::$instances[ $namespace ] ??
			   static::$instances[ $namespace ] = new $namespace;
	}

	/**
	 * Gets the accessor of the underlying class.
	 *
	 * This method should be implemented in the subclasses of this class and
	 * should return the string name of the accessor.
	 *
	 * @return string The accessor of the underlying class.
	 */
	public static function getFacadeAccessor(): string
	{
		throw new RuntimeException( 'Facade should implements getFacadeAccessor method.' );
	}
}
