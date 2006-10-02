--TEST--
decrypt()
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
    "8zD2Wg2tPl3eVEgZLkuT94cYgrA=",
    "T1FzcJFNsoZ5gqFG",
    "t0sCOKYVX2OpbTPCPvn0aw==",
    "315GaUm9lzwKinRVZtzAog==",
    "7nyNJRci2hP7GIJX",
    "ikjCG9ab5B9MVFKd3fP8uQ==",
    "WvxhTOxJibZWSPRMJNHflw==",
    "3aixkK75ynQCmwC0",
    "cijMQIZb3cQCs/jl",
    "kSp9Ss4v8c4RzO62EbJnX392xyw="
);

$result = $XXTEA->decrypt(NULL);
if (PEAR::isError($result)) {
    echo $result->getMessage();
} else {
    echo base64_encode($result);
}
echo "\n";

$result = $XXTEA->decrypt(base64_decode($texts[0]));
if (PEAR::isError($result)) {
    echo $result->getMessage();
} else {
    echo base64_encode($result);
}
echo "\n";

for ($i=0; $i<10; $i++) {
    $XXTEA->setKey($keys[$i]);
    $result = $XXTEA->decrypt(base64_decode($texts[$i]));
    echo base64_encode($result);
    echo "\n";
}

?>
--EXPECT--
The cipher text must be a string.
Secret key is undefined.
5EcauSauH4Vg5VA+1c4c
fHwxBGo=
qWDd8k8gC1ZC
erVBd1XCWYVJ3owQ
Wlq0Ofuy4Q==
T6kXHCQCTeVZMw==
eynRRDIDsobv4D0C
v4F+gZYO
8LcG4pmJoSQ=
b3JYlN6ZZVg+qNsVJw==
