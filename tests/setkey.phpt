--TEST--
setKey()
--FILE--
<?php
require_once 'Crypt/XXTEA.php';

$XXTEA = new Crypt_XXTEA();

$keys = array(NULL, '12345678901234567', '', 'abc', '1234567890123456',
              "\xF8\x5C\x34\xE1\x73\xF6\x15\xA3\x00\xCE");

foreach ($keys as $key) {
    $result = $XXTEA->setKey($key);
    if (PEAR::isError($result)) {
        echo $result->getMessage();
    } else {
        echo implode(', ', $XXTEA->_key);
    }
    echo "\n";
}

?>
--EXPECT--
The secret key must be a string.
The secret key cannot be more than 16 characters.
The secret key cannot be empty.
6513249, 0, 0, 0
875770417, 943142453, 842084409, 909456435
-516662024, -1558841741, 52736, 0
