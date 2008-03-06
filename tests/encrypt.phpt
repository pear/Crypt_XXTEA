--TEST--
encrypt()
--FILE--
<?php
require_once 'Crypt/XXTEA.php';

$XXTEA = new Crypt_XXTEA();

// key-plaintext tuples for string encryptiont test
$tuples_string = array(
    array('abcdefghijklmnop', '[encryption test]'),
    array('gd2fk$2ds', 'PHP is a widely-used general-purpose scripting language'),
    array('p', 'It is especially suited for Web development and can be embedded into HTML'),
    array("\xb2\x93\x13\xe5\x96", 'PEAR is a framework and distribution system for reusable PHP components'),
);

// key-plaintext tuples for long integer array encryptiont test
$tuples_array = array(
    array(array(0, 0, 0, 0), array(0, 0)),
    array(array(0), array(0, 0, 0, 0, 0)),
);

// the following key-plaintext tuples are from http://www.crypt.co.za/post/27
$tuples_hex = array(
    array('6a6f686e636b656e64616c6c6a6f686e', '4100000000000000'),
    array('6a6f686e636b656e64616c6c6a6f686e', '4142000000000000'),
    array('6a6f686e636b656e64616c6c6a6f686e', '4142430000000000'),
    array('6a6f686e636b656e64616c6c6a6f686e', '4142434400000000'),
    array('6a6f686e636b656e64616c6c6a6f686e', '4142434445000000'),
    array('6a6f686e636b656e64616c6c6a6f686e', '4142434445460000'),
    array('6a6f686e636b656e64616c6c6a6f686e', '4142434445464700'),
    array('6a6f686e636b656e64616c6c6a6f686e', '4142434445464748'),
    array('00000000000000000000000000000000', '0000000000000000'),
    array('0102040810204080fffefcf8f0e0c080', '0000000000000000'),
    array('9e3779b99b9773e9b979379e6b695156', 'ffffffffffffffff'),
    array('0102040810204080fffefcf8f0e0c080', 'fffefcf8f0e0c080'),
    array('ffffffffffffffffffffffffffffffff', '157c13a850ba5e57306d7791'),
    array('9e3779b99b9773e9b979379e6b695156', '157c13a850ba5e57306d7791'),
    array('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '0102040810204080fffefcf8f0e0c080'),
    array('9e3779b99b9773e9b979379e6b695156', '0102040810204080fffefcf8f0e0c080'),
    array('0102040810204080fffefcf8f0e0c080', '157c13a850ba5e57306d77916fa2c37be1949616'),
    array('9e3779b99b9773e9b979379e6b695156', '690342f45054a708c475c91db77761bc01b815fd2e4894d1'),
    array('9e3779b99b9773e9b979379e6b695156', '3555da434c9d868a1431e73e73372fc0688e09ce11d00b6fd936a764'),
    array('0102040810204080fffefcf8f0e0c080', 'db9af3c96e36a30c643c6e97f4d75b7a4b51a40e9d8759e581e3c40b341b4436')
);

$result = $XXTEA->encrypt(null);
if (PEAR::isError($result)) {
    echo $result->getMessage();
} else {
    echo base64_encode($result);
}
echo "\n";

$XXTEA->setKey('abc');
$result = $XXTEA->encrypt(null);
if (PEAR::isError($result)) {
    echo $result->getMessage();
} else {
    echo base64_encode($result);
}
echo "\n";

foreach ($tuples_string as $tuple) {
    $XXTEA->setKey($tuple[0]);
    $result = $XXTEA->encrypt($tuple[1]);
    echo base64_encode($result);
    echo "\n";
}

foreach ($tuples_array as $tuple) {
    $XXTEA->setKey($tuple[0]);
    $result = $XXTEA->encrypt($tuple[1]);
    echo 'array(' . implode(', ', $result) . ')';
    echo "\n";
}

foreach ($tuples_hex as $tuple) {
    $XXTEA->setKey(hex2long($tuple[0]));
    $result = $XXTEA->encrypt(hex2long($tuple[1]));
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
The plain text must be a string or long integer array.
UsFmrB/Q8zLl+5TIYicLk+mMgrj41jRB
0ec5tIhpKCIiwdN05MynE+qbtjtD45pEUsaVGaKkHKlD2AewGrjAryZOjQIYLY20HZTbq6Y/YcCcNoAJ
iRj+IHHKrz5yXL6w7PnvflYzHoDItfi7Eg8+dyaL79vPbCUyRw2eVCKnU7LO2zbxYzj1T+o2kTA+MMhX85ktjddmC6FuVafophvx4Qxc9LU=
bmeLisYRXKwB6xSK1v10c/QUYJh/iAtEX9q/qX74k8A3l/jVd++Gb41N327ARdZVrUxOG24Rw46WeS8LcEpML585kbOglxY6SbmUaw==
array(87491755, 1465748608)
array(-1698224617, 1492735309, 566640726, 178473705, 1574735419)
014e7a34874eeb29
e9d39f636e9ed090
d20ec51c06feaf0e
b1551d6ffcd4b61b
0ff91e518b9837e3
7003fc98b6788a77
93951ad360650022
cdeb72b9c903ce52
ab043705808c5d57
d1e78be2c746728a
67ed0ea8e8973fc5
8c3707c01c7fccc4
b2601cefb078b772abccba6a
579016d143ed6247ac6710dd
c0a19f06ebb0d63925aa27f74cc6b2d0
01b815fd2e4894d13555da434c9d868a
51f0ffeb46012a245e0c6c4fa097db27caec698d
759e5b212ee58be734d610248e1daa1c9d0647d428b4f95a
8e63ae7d8a119566990eb756f16abf94ff87359803ca12fbaa03fdfb
5ef1b6e010a2227ba337374b59beffc5263503054745fb513000641e2c7dd107
