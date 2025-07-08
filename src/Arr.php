<?php

namespace Garavel\Support;

/**
 * Handles array operations.
 */
class Arr
{
	/**
	 * Gets the last element in the array.
	 *
	 * @param array $arr The array to get the last element from.
	 * @return mixed The last element in the array.
	 */
	public static function latest( array $arr ): mixed
	{
		return $arr[ count( $arr ) - 1 ];
	}

	/**
	 * Joins the array into a string with the given glue.
	 *
	 * @param array $arr The array to join.
	 * @param string $glue The glue to join with.
	 * @return string The joined string.
	 */
	public static function join( array $arr, string $glue = ', ' ): string
	{
		return implode( $glue, $arr );
	}

	/**
	 * Filters the array elements using a callback function.
	 *
	 * If no callback is supplied, all entries of array equal to FALSE will be removed.
	 *
	 * @param array $arr The array to filter.
	 * @param callable $callback The callback function to use.
	 * @param int $mode Flag determining what arguments are sent to callback:
	 *     0 - Send value as the first and only argument.
	 *     1 - Send key and value as argument 1 and 2, respectively.
	 *     2 - Send value, key and array as argument 1, 2 and 3, respectively.
	 * @return array The filtered array.
	 * @see https://www.php.net/manual/en/function.array-filter.php
	 */
	public static function filter( array $arr, callable $callback, ?int $mode = 0 ): array
	{
		return array_filter( $arr, $callback, $mode );
	}

	/**
	 * Removes empty values from an array.
	 *
	 * @param array $arr The array to clean.
	 * @return array The cleaned array.
	 */
	public static function clean( array $arr ): array
	{
		return static::filter( $arr, fn( $item ) =>
			! empty( $item )
		);
	}

	/**
	 * Plucks the value of the given key from each item in the array and
	 * returns a new array with the plucked values.
	 *
	 * @param array $arr The array to pluck.
	 * @param string $key The key to pluck.
	 * @return array The plucked array.
	 */
	public static function pluck( array $arr, string $key ): array
	{
		$stack = [];

		foreach( $arr as $item )
		{
			$stack[] = $item->{ $key };
		}

		return $stack;
	}

	/**
	 * Recursively flattens an array.
	 *
	 * Flattens an array to one dimensional, meaning that if the array contains
	 * other arrays, these sub-arrays will be merged into the main array.
	 *
	 * @example
	 * [
	 *     'a',
	 *     [ 'b', 'c' ],
	 *     [ 'd', [ 'e' ] ],
	 *     'f'
	 * ]
	 * // Becomes
	 * [
	 *     'a',
	 *     'b',
	 *     'c',
	 *     'd',
	 *     'e',
	 *     'f'
	 * ]
	 *
	 * @param array $arr The array to flatten.
	 * @return array The flattened array.
	 */
	public static function flat( array $arr ): array
	{
		$tmp = [];

		foreach( $arr as $item )
		{
			if( is_array( $item ))
			{
				$tmp = [ ...$tmp, ...self::flat( $item )];
			}
			else
			{
				$tmp[] = $item;
			}
		}

		return $tmp;
	}

	/**
	 * Normalizes the elements of an array by converting numeric strings to floats,
	 * recursively normalizing nested arrays, converting boolean-like strings to 
	 * booleans, and splitting and normalizing array-like strings.
	 *
	 * @param array $arr The array to normalize.
	 * @return array The normalized array with converted data types.
	 */
	public static function normalize( array $arr ): array
	{
		foreach( $arr as &$item )
		{
			if( is_numeric( $item ))
			{
				$item = (float) $item;
			}
			else if( is_array( $item ))
			{
				$item = self::normalize( $item );
			}
			else if( Str::isBoolable( $item ))
			{
				$item = Str::parseBool( $item );
			}
			else if( Str::isArrayable( $item ))
			{
				$item = self::normalize(
					Str::split( $item, Str::splitter( $item ))
				);
			}
		}

		return $arr;
	}
}
