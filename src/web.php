<?php declare(strict_types=1);

namespace Kingsoft\Utils;
/**
 * check_params
 *
 * @param  array $params this params should be in the $_REQUEST
 * @return void
 */
function check_request_params( array $params )
{
	$params_check = array_intersect(array_keys($_REQUEST),$params);
	if(count($params_check) !== count($params)) {
		header("HTTP/1.1 400 Bad Request");
		die();
	}
}

/**
 * convert bin to url friendly base64
 */
function base64url_encode( $data ){
  return rtrim( strtr( base64_encode( $data ), '+/', '-_'), '=');
}
/**
 * convert url friendly base64 to bin
 */
function base64url_decode( $data ){
  return base64_decode( strtr( $data, '-_', '+/') . str_repeat('=', 3 - ( 3 + strlen( $data )) % 4 ));
}