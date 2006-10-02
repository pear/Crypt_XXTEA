--TEST--
encrypt()
--FILE--
<?php
require_once 'Crypt/XXTEA.php';

$XXTEA = new Crypt_XXTEA();

$keys = array(
    "\xB2\x93\x13\xE5\x96\x0A\xA2\xDD\xD2",
    "\xA5\x26\x12\x0E\x56\xCD\x4D\xD2\xD8\xFF\xE1\x36\x6E\x9B\x96\x0A",
    "\x00",
    "\x8E\x4F\x79\x7D\x29\x65\xD3\xC6\x21\x0A\x17\xF3",
    "\x8B\x7F\xB1\x92\x3B\x15\x06\xED\x0C\x56\xD0",
    "\x0E",
    "\xBC\x63\xD9\xAE\xAC\xD3\xF5",
    "\x8C\xEA\xE3\x95\x52\xED\xD8\xDD\xDA\x29",
    "\x95\x6B\xB6",
    "\x6F\xC0\x6D\xF3\xCC\xBF"
);

$texts = array(
    "\xE4\x47\x1A\xB9\x26\xAE\x1F\x85\x60\xE5\x50\x3E\xD5\xCE\x1C",
    "\x7C\x7C\x31\x04\x6A",
    "\xA9\x60\xDD\xF2\x4F\x20\x0B\x56\x42",
    "\x7A\xB5\x41\x77\x55\xC2\x59\x85\x49\xDE\x8C\x10",
    "\x5A\x5A\xB4\x39\xFB\xB2\xE1",
    "\x4F\xA9\x17\x1C\x24\x02\x4D\xE5\x59\x33",
    "\x7B\x29\xD1\x44\x32\x03\xB2\x86\xEF\xE0\x3D\x02",
    "\xBF\x81\x7E\x81\x96\x0E",
    "\xF0\xB7\x06\xE2\x99\x89\xA1\x24",
    "\x6F\x72\x58\x94\xDE\x99\x65\x58\x3E\xA8\xDB\x15\x27",
);

$result = $XXTEA->encrypt(NULL);
if (PEAR::isError($result)) {
    echo $result->getMessage();
} else {
    echo base64_encode($result);
}
echo "\n";

$result = $XXTEA->encrypt('text');
if (PEAR::isError($result)) {
    echo $result->getMessage();
} else {
    echo base64_encode($result);
}
echo "\n";

for ($i=0; $i<10; $i++) {
    $XXTEA->setKey($keys[$i]);
    $result = $XXTEA->encrypt($texts[$i]);
    echo base64_encode($result);
    echo "\n";
}

?>
--EXPECT--
The plain text must be a string.
Secret key is undefined.
8zD2Wg2tPl3eVEgZLkuT94cYgrA=
T1FzcJFNsoZ5gqFG
t0sCOKYVX2OpbTPCPvn0aw==
315GaUm9lzwKinRVZtzAog==
7nyNJRci2hP7GIJX
ikjCG9ab5B9MVFKd3fP8uQ==
WvxhTOxJibZWSPRMJNHflw==
3aixkK75ynQCmwC0
cijMQIZb3cQCs/jl
kSp9Ss4v8c4RzO62EbJnX392xyw=
