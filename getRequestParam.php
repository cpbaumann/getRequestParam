<?php
/**
 * getRequestParam
 *
 * DESCRIPTION
 *
 * This Snippet returns sanitized
 * GET and POST Request Parameter
 *
 * PROPERTIES:
 *
 * &name string required
 * &type string required Default: `GET`
 * &allowedValues array optional. 
 * &allowedTypes string optional. (naturalNumbers 1,2,3,4,) 
 *
 * USAGE:
 *
 * [[!getRequestParam? &type=`POST` &name=`fruits`]]
 *
 *
 * [[!getRequestParam? 
 *	  &name=`fruits` 
 *	  &allowedValues=`apple,peaches,pear,apricots` 
 *	  &fallbackvalue=`fallbackvalue` 
 *	  &default=`defaultvalue`
 * ]]
 *
 * [[!getRequestParam? 
 *    &name=`number` 
 * 	  &allowedTypes=`naturalNumbers` 
 * 	  &fallbackvalue=`fallbackvalue` 
 * 	  &default=`defaultvalue` 
 * ]]
 *
 */

$name = $modx->getOption('name', $scriptProperties);
$type = $modx->getOption('type', $scriptProperties,'GET');
$allowedValues = $modx->getOption('allowedValues', $scriptProperties,false);
$allowedTypes = $modx->getOption('allowedTypes', $scriptProperties); 

// default return if request is not set or empty
$default = $modx->getOption('default', $scriptProperties,'');

// return if request value is filtered and eliminated
$fallbackvalue = $modx->getOption('fallbackvalue', $scriptProperties,'');

// For debugging:
$modx->log(modX::LOG_LEVEL_DEBUG , '[getRequestParam] called on page ' 
	. $modx->resource->id 
	. ' with the following properties: '
    . print_r($scriptProperties, true));

// Verify Inputs
if (!isset($scriptProperties['name'])) {
    $modx->log(modX::LOG_LEVEL_ERROR, '[getRequestParam] missing required properties &name!');
    return;
}


if ('POST' === $type) {
	if (isset($_POST[$name]) AND (!empty($_POST[$name]))) {

		if ( true == $allowedValues ) {
			$allowedValues = split(',',$allowedValues);
			if (!in_array($_POST[$name], $allowedValues)) {
				return $fallbackvalue;
			}
		}

		if ( 'naturalNumbers' === $allowedTypes ) {
			if(!preg_match("/^[1-9]{1}[0-9]{0,}$/", $_POST[$name])){
				return $fallbackvalue;
			}
		}

		$value = filter_var($_POST[$name], FILTER_SANITIZE_STRING);

	}else{
		$value = $default;
	}
}

if ( 'GET' === $type ) {
	if (isset($_GET[$name]) AND (!empty($_GET[$name]))) {

		if (true == $allowedValues ) {
			$allowedValues = split(',',$allowedValues);			
			if (!in_array($_GET[$name], $allowedValues)) {
				return $fallbackvalue;
			}
		}

		if ('naturalNumbers' === $allowedTypes) {
			if(!preg_match("/^[1-9]{1}[0-9]{0,}$/", $_GET[$name])){
				return $fallbackvalue;
			}
		}

		$value = filter_var($_GET[$name], FILTER_SANITIZE_STRING);

	}else{
		$value = $default;
	}
}

$output = $value;
return $output;
?>