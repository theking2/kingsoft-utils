<?php declare(strict_types=1);

namespace Kingsoft\Utils;
/**
 * check_params
 *
 * @param  array $params this params should be in the $_REQUEST
 * @return bool true when all params are in $_REQUEST
 */
function check_request_params( array $params ) : bool
{
	$params_check = array_intersect(array_keys($_REQUEST),$params);
	return count($params_check) !== count($params);
}

/**
 * convert bin to url friendly base64
 * translating + to - and / to _
 * @param string $data
 * @return string
 */
function base64url_encode( $data ) : string
{
  return rtrim( strtr( base64_encode( $data ), '+/', '-_'), '=');
}
/**
 * convert url friendly base64 to bin
 * translating - to + and _ to /
 * @param string $data
 * @return string
 */
function base64url_decode( $data ) : string
{
  return base64_decode( strtr( $data, '-_', '+/') . str_repeat('=', 3 - ( 3 + strlen( $data )) % 4 ));
}

/**
 * Wrap a text in a tag
 * @param string $tag Tag to wrap arount text
 * @param string $text Text to wrap tag around
 * @param ?string $class optional class or classes string
 * @param ?string $id optional id string
 * @return string
 */
function wrap_tag( string $tag, string $text, ?string $class = null, ?string $id = null ): string
{
	return 
		"<$tag" .
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
function option_tag( string $text, mixed $value, string $var ): string
{
	return
		'<option ' . 
		// set attribute selected when $var has value $value
		( $var===$value? 'selected ': '' ) . 
		'value="' . $value . '">' . $text . 
		'</option>' . PHP_EOL;
}