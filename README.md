# MODX Snippet getRequestParam

## DESCRIPTION

This Snippet returns sanitized GET and POST request parameter,


## PROPERTIES:

* &name string required
	the request key is required

* &type string required Default: `GET`
	POST or GET

* &allowedValues array optional. 
	checks array of allowed input values,  returns a fallback value when it fails

* &allowedTypes string optional. 
 	checks input natural numbers (1,2,3 no zero), returns a fallback value when it fails   


## USAGE:

```php

[[!getRequestParam? &type=`POST` &name=`fruits`]]


[[!getRequestParam? 
  &name=`fruits` 
  &allowedValues=`apple,peaches,pear,apricots` 
  &fallbackvalue=`fallbackvalue` 
  &default=`defaultvalue`
]]

[[!getRequestParam? 
  &name=`number` 
  &allowedTypes=`naturalNumbers` 
  &fallbackvalue=`fallbackvalue` 
  &default=`defaultvalue` 
]]
```

## Notes

* Requires MODX 2.2+

## License

This script is dual licensed under the MIT and GPL licenses.



