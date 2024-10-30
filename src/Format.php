<?php declare(strict_types=1);

namespace Kingsoft\Utils;

class Format
{
	/**
	 * calculate difference in procent
	 * @param float $a numerator
	 * @param float $b denominator 
	 * @return string result in procent with one decimal or NaN if donominator is zero
	 */
	public static function proc_diff( $a, $b ): string
	{
		return $b != 0
			? number_format( 100.0 * ( $a - $b ) / $b, 1, '.', "’" ) . '%'
			: 'n.a.';
	}

	/**
	 * format a money float
	 * @param float $value - value to convert
	 * @return string
	 */
	public static function money( $value ): string
	{
		return is_numeric( $value )
			? number_format( $value, 2, '.', "’" )
			: '';
	}
	/**
	 * format a money float
	 * @param float $value - value to convert
	 * @return string
	 */
	public static function moneyz( $value ): string
	{
		return is_numeric( $value )
			? number_format( $value, 2, '.', "’" )
			: '0.00';
	}
	/**
	 * format a percent float
	 * @param $value - value to convert
	 */
	public static function percent( mixed $value ): string
	{
		return is_numeric( $value )
			? number_format( $value, 1, '.', "’" ) . '%'
			: 'n.a.';
	}
	/**
	 * format a percent float
	 * @param $value - value to convert
	 */
	public static function percentz( mixed $value ): string
	{
		return is_numeric( $value )
			? number_format( $value, 1, '.', "’" ) . '%'
			: 'n.a.';
	}
	/**
	 * format a liter float
	 * @param $value - value to convert
	 */
	public static function liter( float $value ): string
	{
		return is_numeric( $value )
			? number_format( $value, 3, '.', "’" )
			: $value;
	}
	/**
	 * format a amount float/integer, floats get one decimal
	 * @param $value - value to convert
	 */
	public static function amount( float $value ): string
	{
		return is_float( $value )
			? number_format( $value, 1, '.', "’" )
			: ( is_numeric( $value )
				? number_format( $value, 0, '.', "’" )
				: '' );
	}

	/**
	 * Custom fputcsv
	 * @param resource $handle filehandle
	 * @param $fields array of values to write
	 * @param $delimiter field delimiter
	 * @param $enclosure field enclosures
	 * @param $escape_char escape enclosure chars in fields
	 * @param $record_seperator 
	 */
	public static function fputcsv(
		$handle,
		array $fields,
		string $delimiter = ",",
		string $enclosure = '"',
		string $escape_char = "\\",
		string $record_seperator = "\r\n"
	) {
		$result = [];
		foreach( $fields as $field ) {
			$result[] = $enclosure . str_replace( $enclosure, $escape_char . $enclosure, $field ) . $enclosure;
		}
		return fwrite( $handle, implode( $delimiter, $result ) );
	}

	/**
	 * get array value if key exist otherwise default
	 * @param $needle
	 * @param $haystack
	 * @param $default value if needle not found
	 */
	public static function array_value( string $needle, array $haystack, ?string $default = '' ): string
	{
		return $haystack[ $needle ] ?? $default;
	}

	/**
	 * Convert kebab-case to PascalCase
	 * @param string $str
	 * @return string
	 */
	public static function kebabToPascal( string $str ): string
	{
		return str_replace( ' ', '', ucwords( str_replace( '-', ' ', $str ) ) );
	}

	/**
	 * Convert snake_case to PascalCase
	 * @param string $str
	 * @return string
	 */
	public static function snakeToPascal( string $str ): string
	{
		return str_replace( ' ', '', ucwords( str_replace( '_', ' ', $str ) ) );
	}

	/**
	 * Convert snake_case to camelCase
	 * @param string $str
	 * @return string
	 */
	public static function snakeToCamel( string $str ): string
	{
		return lcfirst( self::snakeToPascal( $str ) );
	}

	/**
	 * Convert kebab-case to camelCase
	 * @param string $str
	 * @return string
	 */
	public static function kebabToCamel( string $str ): string
	{
		return lcfirst( self::kebabToPascal( $str ) );
	}

	/**
	 * Loads and processes a file.
	 *
	 * This function reads a file and performs string expansion on placeholders.
	 * Placeholders in the format of $variableName within the SQL file are replaced
	 * with their corresponding values from the $variables map or $GLOBALS.
	 *
	 */
	static function load_parse_file( string $file, array $variables = null ): string
	{
		$variables ??= $GLOBALS;
		if( !file_exists( $file ) ) {
			throw new \InvalidArgumentException( "File not found: $file" );
		}
		$data = file_get_contents( $file );
		// /\$[a-zA-Z_]\w*|\{\$[a-zA-Z_]\w*\}|\{\$this->\w+\}/g
		return preg_replace_callback( '/\$([a-zA-Z_]\w*)|(\{\$[a-zA-Z_]\w*\}|\{\$this->\w+\})/',
			fn( $matches ) =>
			array_key_exists( $matches[ 1 ], $variables )
				? $variables[ $matches[ 1 ] ]
				: throw new \InvalidArgumentException( "Variable not found: {$matches[ 1 ]}" ),
			$data
		);
	}
}
