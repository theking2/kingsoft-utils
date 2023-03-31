<?php declare(strict_types=1);

namespace Kingsoft\Utils;
/**
 * use {$_c('defined')} to interpolate constants
 */
$_c = 'constant';

/**
 * Are we in debug mode?
 */
define('DEBUG', strpos( $_SERVER['SERVER_NAME'], 'localhost')!==false);

/**
 * calculate difference in procent
 * @param float $a numerator
 * @param float $b denominator 
 * @return string result in procent with one decimal or NaN if donominator is zero
 */
function proc_diff($a, $b): string
{
	return $b != 0
		? number_format( 100.0 * ($a - $b) / $b, 1, '.', "’" ) . '%'
		: 'n.a.';
}

/**
 * format a money float
 * @param float $value - value to convert
 * @return string
 */
function format_money($value): string
{
	return is_numeric($value)
		? number_format($value, 2, '.', "’")
		: '';
}
/**
 * format a money float
 * @param float $value - value to convert
 * @return string
 */
function format_moneyz($value): string
{
	return is_numeric($value)
		? number_format($value, 2, '.', "’")
		: '0.00';
}
/**
 * format a percent float
 * @param float $value - value to convert
 * @return string
 */
function format_percent(float $value): string
{
	return is_numeric($value)
		? number_format($value, 1, '.', "’") . '%'
		: 'n.a.';
}
/**
 * format a percent float
 * @param float $value - value to convert
 * @return string
 */
function format_percentz($value): string
{
	return is_numeric($value)
		? number_format($value, 1, '.', "’") . '%'
		: 'n.a.';
}
/**
 * format a liter float
 * @param float $value - value to convert
 * @return string
 */
function format_liter(float $value): string
{
	return is_numeric($value)
		? number_format($value, 3, '.', "’")
		: $value;
}
/**
 * format a amount float/integer, floats get one decimal
 * @param float $value - value to convert
 * @return string
 */
function format_amount($value): string
{
	return is_float($value)
		? number_format($value, 1, '.', "’")
		: (	is_numeric($value)
			? number_format($value, 0, '.', "’")
			: '' );
}

/**
 * Custom fputcsv
 * @param int $handle filehandle
 * @param mixed[] $fields array of values to write
 * @param string $delimiter field delimiter
 * @param string $enclosure field enclosures
 * @param string $escape_char escape enclosure chars in fields
 * @param string $record_seperator 
 * @return int characters written
 */
function dwh_fputcsv( $handle, $fields, $delimiter = ",", $enclosure = '"', $escape_char = "\\", $record_seperator = "\r\n" ) {
	$result = [];
	foreach( $fields as $field ) {
		$result[] = $enclosure . str_replace($enclosure, $escape_char . $enclosure, $field) . $enclosure;
	}
	return fwrite( $handle, implode( $delimiter, $result ) );
}

/**
 * Wrap a text in a tag
 * @param string $tag Tag to wrap arount text
 * @param string $text Text to wrap tag around
 * @param ?string $class optional class or classes string
 * @param ?string $id optional id string
 */
function wrap_tag( string $tag, string $text, ?string $class = null, ?string $id = null ) {
	return "<$tag" .
		// if class is set include a class="" section
		( $class ? " class=\"$class\"" : '' ) .

		// if id is set include a id="" section
		( $id    ? " id=\"$id\"" : '' ) .

		">$text</$tag>";
}

/**
 * Create option entry setting the selected value
 *
 * @param string $text Text to display
 * @param string $value the value attribute of the option
 * @param string $var The variable holding $value to test the selection
 * @return string
 */
function option_tag( string $text, mixed $value, string $var ): string {
	return '<option ' . 
		// set attribute selected when $var has value $value
		( ( $var==$value )? 'selected ': '' ) . 
		'value="' . $value . '">' . $text . PHP_EOL;
}
/**
 * get array value if key exist otherwise default
 * @param string $key needle
 * @param mixed[] $array haystack
 * @param mixed $default value if needle not found
 */
function array_value( string $key, string $array, ?string $default = '' ):string {
	return $array[$key] ?? $default;
}

/**
 * Method kebabToPascal
 */
function kebabToPascal( string $str ): string {
	return str_replace( ' ', '', ucwords( str_replace( '-', ' ', $str ) ) );
}

/**
* convert snake_case to PascalCase
*/
function snakeToPascal( string $str ): string {
	return str_replace (' ', '', ucwords( str_replace( '_', ' ', $str ) ) );
}

/**
* convert snake_case to camelCase
*/
function snakeToCamel( string $str ): string {
	return lcfirst( snakeToPascal( $str ) );
}

/**
* convert kebab-case to camelCase
*/
function kebabToCamel( string $str): string {
	return lcfirst( kebabToPascal( $str ) );
}

