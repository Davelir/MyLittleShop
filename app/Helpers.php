<?php


/* Helpers */


/**
 * Return price string
 *
 * @return string
 */
 function price($price,$currency = "zł"){
     $price = (float)$price;
     return number_format($price,2,'.',' ').' '.$currency;
 }
 /**
  * Make array flat
  */
 function flatten($array) {
    $result = [];
    foreach ($array as $item) {
        if (is_array($item)) {
            $result[] = array_filter($item, function($array) {
                return ! is_array($array);
            });
            $result = array_merge($result, flatten($item));
        }
    }
    return array_filter($result);
}
