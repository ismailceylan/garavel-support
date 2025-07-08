<?php

namespace Garavel\Support;

/**
 * Handles string operations.
 */
class Str
{
	/**
	 * Merges two strings separated by the given glue.
	 *
	 * Splits each string with the given glue and then joins them.
	 * If the glue is found in either string, it will be split into
	 * two parts. If the glue is not found in either string, the
	 * function will return the concatenation of the two strings.
	 *
	 * @param string $glue The glue to split and join the strings with.
	 * @param string $left The left string to merge.
	 * @param string $right The right string to merge.
	 * @return string The merged string.
	 */
	public static function mergeWith( string $glue, string $left, string $right  ): string
	{
		return Arr::join(
			Arr::clean(
			[
				...static::split( $left, $glue ),
				...static::split( $right, $glue )
			]),
			$glue
		);
	}

	/**
	 * Ensures a string begins with a given string.
	 *
	 * If the string already begins with the given string, it returns the
	 * original string. Otherwise, it prepends the given string to the
	 * beginning of the string and returns it.
	 *
	 * @param string $str The string to check.
	 * @param string $start The string to check against.
	 * @param bool $insensitive Whether the check should be case insensitive.
	 * @return string The modified string.
	 */
	public static function startWith( string $str, string $start, bool $insensitive = true ): string
	{
		return self::startsWith( $str, $start, $insensitive )
			? $start . Str::slice( $str, Str::len( $start ))
			: $start . $str;
	}

	/**
	 * Checks if a string starts with a given substring.
	 *
	 * This method verifies whether the specified string begins with the provided
	 * starting substring. It can perform a case-sensitive or case-insensitive
	 * check based on the given flag.
	 *
	 * @param string $str The string to check.
	 * @param string $starts The starting substring to look for.
	 * @param bool $insensitive Whether the check should be case insensitive (default is true).
	 * @return bool True if the string starts with the given substring, false otherwise.
	 */
	public static function startsWith( string $str, string $starts, bool $insensitive = true ): bool
	{
		$strStart = Str::slice( $str, 0, Str::len( $starts ));

		if( $insensitive )
		{
			$strStart = strtolower( $strStart );
			$starts = strtolower( $starts );
		}

		return $strStart == $starts;
	}

	/**
	 * Splits a string by a given separator into an array of strings.
	 *
	 * This method uses the built-in explode() function to split the given
	 * string into an array of strings. The separator is used to determine
	 * where the splitting should occur. The resulting array will contain all
	 * the pieces of the string.
	 *
	 * @param string $str The string to split.
	 * @param string $separator The separator to split the string with.
	 * @return array The array of strings.
	 */
	public static function split( string $str, string $separator ): array
	{
		return explode( $separator, $str );
	}

	/**
	 * Prepends a prefix to a string.
	 *
	 * If the given string is empty, this method returns an empty string.
	 * Otherwise, it prepends the given prefix to the string and returns the
	 * modified string.
	 *
	 * @param string $prefix The prefix to prepend.
	 * @param string|null $str The string to prepend to.
	 * @return string The modified string.
	 */
	public static function prefix( string $prefix, string|null $str ): string
	{
		return empty( $str )? '' : $prefix . $str;
	}

	/**
	 * Gets the length of the given string.
	 *
	 * If the multibyte flag is set to true, the mb_strlen() function is used to
	 * get the length of the string. Otherwise, the strlen() function is used.
	 *
	 * @param string $str The string to get the length of.
	 * @param bool $multibyte Whether to use the mb_strlen() function.
	 * @return int The length of the string.
	 */
	public static function len( string $str, bool $multibyte = false ): int
	{
		return $multibyte? mb_strlen( $str ) : strlen( $str );
	}

	/**
	 * Extracts a portion of a string.
	 *
	 * This method returns a part of the given string, starting at the specified
	 * position and optionally limited to a given length. It supports both regular
	 * and multibyte strings.
	 *
	 * @param string $str The input string.
	 * @param int $start The starting position of the substring.
	 * @param ?int|null $length The length of the substring to extract. If null, extracts to the end of the string.
	 * @param bool $multibyte Whether to use multibyte string functions.
	 * @return string The extracted substring.
	 */
	public static function slice( string $str, int $start, ?int $length = null, bool $multibyte = false ): string
	{
		return $multibyte
			? mb_substr( $str, $start, $length )
			: substr( $str, $start, $length );
	}

	/**
	 * Checks if the given string contains the given needle.
	 *
	 * This method is case-sensitive and will not perform a regex search.
	 *
	 * @param string $str The string to search in.
	 * @param string $needle The string to search for.
	 * @param ?int $offset The position to start the search from.
	 * @return bool True if the string contains the needle, false otherwise.
	 */
	public static function contains( string $str, string $needle, ?int $offset = null ): bool
	{
		return strpos( $str, $needle, $offset );
	}

	/**
	 * Parses a value to its boolean equivalent.
	 *
	 * This function converts various types of input to a boolean value.
	 * The following values are interpreted as false: the string 'false',
	 * the boolean false itself, the string '0', and the integer 0.
	 * All other values are considered true.
	 *
	 * @param string|int|bool $str The value to be parsed to a boolean.
	 * @return bool The boolean representation of the input value.
	 */
	public static function parseBool( string|int|bool $str ): bool
	{
		if( $str === 'false' || $str === false || $str === '0' || $str === 0 )
		{
			return false;
		}
		
		return true;
	}

	/**
	 * Determines if a value can be interpreted as a boolean.
	 *
	 * This method checks if the input is one of the following
	 * values: the string 'true', the string 'false', the boolean
	 * true, or the boolean false. If the input matches any of
	 * these values, it is considered boolable.
	 *
	 * @param mixed $str The value to check.
	 * @return bool True if the value is boolable, false otherwise.
	 */
	public static function isBoolable( mixed $str ): bool
	{
		return $str === 'true' || $str === 'false' ||
			   $str ===  true  || $str ===  false;
	}

	/**
	 * Checks if the given string can be interpreted as an array.
	 *
	 * This method checks if the given string can be split into an array
	 * using the splitter() method. If the string can be split, it is
	 * considered arrayable.
	 *
	 * @param string $str The string to check.
	 * @return bool True if the string is arrayable, false otherwise.
	 */
	public static function isArrayable( string $str ): bool
	{
		return self::splitter( $str ) !== false;
	}

	/**
	 * Gets the splitter of a given string.
	 *
	 * This method checks if a given string can be split into an array
	 * using a splitter. The splitter can be a comma (,) or a pipe (|).
	 * If the string can be split, the splitter is returned as a string.
	 * Otherwise, false is returned.
	 *
	 * @param string $str The string to get the splitter of.
	 * @return string|false The splitter of the string, or false if the string
	 *                      cannot be split.
	 */
	public static function splitter( string $str ): string|false
	{
		if( strpos( $str, ',' ) !== false )
		{
			return ',';
		}
		else if( strpos( $str, '|' ))
		{
			return '|';
		}

		return false;
	}
}
