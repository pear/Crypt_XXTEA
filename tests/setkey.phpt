--TEST--
setKey()
--FILE--
<?php
require_once 'Crypt/XXTEA.php';

$XXTEA = new Crypt_XXTEA();

$keys = array(
    null,
    '',
    array(),
    '12345678901234567',
    array(2077727570, -1614848219, -214975263, 307481358, 820681276),
    'abc',
    array(667863821),
    '1234567890123456',
    array(2077727570, -1614848219, -214975263, 307481358),
    "\xF8\x5C\x34\xE1\x73\xF6\x15\xA3\x00\xCE"
);

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
The secret key must be a string or long array.
The secret key cannot be empty.
The secret key cannot be empty.
The secret key cannot be more than 16 characters or 4 long values.
The secret key cannot be more than 16 characters or 4 long values.
6513249, 0, 0, 0
667863821, 0, 0, 0
875770417, 943142453, 842084409, 909456435
2077727570, -1614848219, -214975263, 307481358
-516662024, -1558841741, 52736, 0
