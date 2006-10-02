--TEST--
_str2long()
--FILE--
<?php
require_once 'Crypt/XXTEA.php';

$XXTEA = new Crypt_XXTEA();

$str = "\x5D\x01\x2B\xEF\x00\x36\x3E\xAE" .
       "\x22\x28\x17\xBF\x20\x80\x9F\x66" .
       "\x08\x89\xA4\xB5\xFE\xC7\x22\x96" .
       "\x14\x7D\xA2\x5F\x14\xA8\xFC\xFE" .
       "\xFF\xCE\x00";

$long_1 = $XXTEA->_str2long($str, FALSE);
$long_2 = $XXTEA->_str2long($str, TRUE);

print_r($long_1);

print_r($long_2);

?>
--EXPECT--
Array
(
    [0] => -282394275
    [1] => -1371654656
    [2] => -1089001438
    [3] => 1721729056
    [4] => -1247508216
    [5] => -1776105474
    [6] => 1604484372
    [7] => -16996332
    [8] => 52991
)
Array
(
    [0] => -282394275
    [1] => -1371654656
    [2] => -1089001438
    [3] => 1721729056
    [4] => -1247508216
    [5] => -1776105474
    [6] => 1604484372
    [7] => -16996332
    [8] => 52991
    [9] => 35
)
