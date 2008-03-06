--TEST--
decrypt()
--FILE--
<?php
require_once 'Crypt/XXTEA.php';

$XXTEA = new Crypt_XXTEA();

// key-plaintext tuples for string encryptiont test
$tuples_string = array(
    array('abcdefghijklmnop', 'UsFmrB/Q8zLl+5TIYicLk+mMgrj41jRB'),
    array('gd2fk$2ds', '0ec5tIhpKCIiwdN05MynE+qbtjtD45pEUsaVGaKkHKlD2AewGrjAryZOjQIYLY20HZTbq6Y/YcCcNoAJ'),
    array('p', 'iRj+IHHKrz5yXL6w7PnvflYzHoDItfi7Eg8+dyaL79vPbCUyRw2eVCKnU7LO2zbxYzj1T+o2kTA+MMhX85ktjddmC6FuVafophvx4Qxc9LU='),
    array("\xb2\x93\x13\xe5\x96", 'bmeLisYRXKwB6xSK1v10c/QUYJh/iAtEX9q/qX74k8A3l/jVd++Gb41N327ARdZVrUxOG24Rw46WeS8LcEpML585kbOglxY6SbmUaw=='),
);

// key-plaintext tuples for long integer array encryptiont test
$tuples_array = array(
    array(array(0, 0, 0, 0), array(87491755, 1465748608)),
    array(array(0), array(-1698224617, 1492735309, 566640726, 178473705, 1574735419)),
);

// the following key-plaintext tuples are from http://www.crypt.co.za/post/27
$tuples_hex = array(
    array('6a6f686e636b656e64616c6c6a6f686e', '014e7a34874eeb29'),
    array('6a6f686e636b656e64616c6c6a6f686e', 'e9d39f636e9ed090'),
    array('6a6f686e636b656e64616c6c6a6f686e', 'd20ec51c06feaf0e'),
    array('6a6f686e636b656e64616c6c6a6f686e', 'b1551d6ffcd4b61b'),
    array('6a6f686e636b656e64616c6c6a6f686e', '0ff91e518b9837e3'),
    array('6a6f686e636b656e64616c6c6a6f686e', '7003fc98b6788a77'),
    array('6a6f686e636b656e64616c6c6a6f686e', '93951ad360650022'),
    array('6a6f686e636b656e64616c6c6a6f686e', 'cdeb72b9c903ce52'),
    array('00000000000000000000000000000000', 'ab043705808c5d57'),
    array('0102040810204080fffefcf8f0e0c080', 'd1e78be2c746728a'),
    array('9e3779b99b9773e9b979379e6b695156', '67ed0ea8e8973fc5'),
    array('0102040810204080fffefcf8f0e0c080', '8c3707c01c7fccc4'),
    array('ffffffffffffffffffffffffffffffff', 'b2601cefb078b772abccba6a'),
    array('9e3779b99b9773e9b979379e6b695156', '579016d143ed6247ac6710dd'),
    array('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'c0a19f06ebb0d63925aa27f74cc6b2d0'),
    array('9e3779b99b9773e9b979379e6b695156', '01b815fd2e4894d13555da434c9d868a'),
    array('0102040810204080fffefcf8f0e0c080', '51f0ffeb46012a245e0c6c4fa097db27caec698d'),
    array('9e3779b99b9773e9b979379e6b695156', '759e5b212ee58be734d610248e1daa1c9d0647d428b4f95a'),
    array('9e3779b99b9773e9b979379e6b695156', '8e63ae7d8a119566990eb756f16abf94ff87359803ca12fbaa03fdfb'),
    array('0102040810204080fffefcf8f0e0c080', '5ef1b6e010a2227ba337374b59beffc5263503054745fb513000641e2c7dd107')
);

$result = $XXTEA->decrypt(null);
if (PEAR::isError($result)) {
    echo $result->getMessage();
} else {
    echo base64_encode($result);
}
echo "\n";

$XXTEA->setKey('abc');
$result = $XXTEA->decrypt(null);
if (PEAR::isError($result)) {
    echo $result->getMessage();
} else {
    echo base64_encode($result);
}
echo "\n";

foreach ($tuples_string as $tuple) {
    $XXTEA->setKey($tuple[0]);
    $result = $XXTEA->decrypt(base64_decode($tuple[1]));
    echo $result;
    echo "\n";
}

foreach ($tuples_array as $tuple) {
    $XXTEA->setKey($tuple[0]);
    $result = $XXTEA->decrypt($tuple[1]);
    echo 'array(' . implode(', ', $result) . ')';
    echo "\n";
}

foreach ($tuples_hex as $tuple) {
    $XXTEA->setKey(hex2long($tuple[0]));
    $result = $XXTEA->decrypt(hex2long($tuple[1]));
    echo long2hex($result);
    echo "\n";
}

function hex2long($hex) {
    return array_values(unpack('V*', pack('H*', $hex)));
}

function long2hex($arr) {
    $len = count($arr);
    $hex = '';
    for ($i = 0; $i < $len; $i++) {
        $hex .= pack('V', $arr[$i]);
    }
    return array_shift(unpack('H*', $hex));
}

?>
--EXPECT--
Secret key is undefined.
The chiper text must be a string or long integer array.
[encryption test]
PHP is a widely-used general-purpose scripting language
It is especially suited for Web development and can be embedded into HTML
PEAR is a framework and distribution system for reusable PHP components
array(0, 0)
array(0, 0, 0, 0, 0)
4100000000000000
4142000000000000
4142430000000000
4142434400000000
4142434445000000
4142434445460000
4142434445464700
4142434445464748
0000000000000000
0000000000000000
ffffffffffffffff
fffefcf8f0e0c080
157c13a850ba5e57306d7791
157c13a850ba5e57306d7791
0102040810204080fffefcf8f0e0c080
0102040810204080fffefcf8f0e0c080
157c13a850ba5e57306d77916fa2c37be1949616
690342f45054a708c475c91db77761bc01b815fd2e4894d1
3555da434c9d868a1431e73e73372fc0688e09ce11d00b6fd936a764
db9af3c96e36a30c643c6e97f4d75b7a4b51a40e9d8759e581e3c40b341b4436
