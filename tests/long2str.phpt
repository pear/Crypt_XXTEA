--TEST--
_long2str()
--FILE--
<?php
require_once 'Crypt/XXTEA.php';

$XXTEA = new Crypt_XXTEA();

$long_1 = array(-282394275, -1371654656, -1089001438, 1721729056,
                -1247508216, -1776105474, 1604484372, -16996332,
                52991);

$long_2 = array(-282394275, -1371654656, -1089001438, 1721729056,
                -1247508216, -1776105474, 1604484372, -16996332,
                52991, 35);

$str_1 = $XXTEA->_long2str($long_1, FALSE);
$str_2 = $XXTEA->_long2str($long_2, TRUE);

echo base64_encode($str_1);
echo "\n";
echo base64_encode($str_2);

?>
--EXPECT--
XQEr7wA2Pq4iKBe/IICfZgiJpLX+xyKWFH2iXxSo/P7/zgAA
XQEr7wA2Pq4iKBe/IICfZgiJpLX+xyKWFH2iXxSo/P7/zgA=
