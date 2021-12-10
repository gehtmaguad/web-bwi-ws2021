<?php

$passwordplaintext = "topSecretPassword123";
echo "Password as plaintext: " . $passwordplaintext . "<br>";

//https://www.php.net/manual/de/function.password-hash.php
$hashvalue = password_hash($passwordplaintext, PASSWORD_DEFAULT); //PASSWORD_DEFAULT; //PASSWORD_BCRYPT;
echo "Password as hashed value: " . $hashvalue . "<br>";

echo "<br>";

$typedpassword = "topSecretPassword123"; //e.g. received via $_POST["password"];
echo "Typed in password: " . $typedpassword . "<br>";

//to verify the output of password_hash() --> use password_verify //https://www.php.net/manual/de/function.password-verify.php
//--> simple string comparison will not work!

if(password_verify($typedpassword, $hashvalue)) {
    echo "Valid password!<br>";
} else {
    echo "Invalid password!<br>";
}

echo "<br><br>";



//https://www.php.net/manual/de/function.hash.php
$sha256hash = hash('sha256', $passwordplaintext);
echo "SHA256: " . $sha256hash . "<br>";

if(hash('sha256', $typedpassword) == $sha256hash) {
    echo "Valid password!<br>";
} else {
    echo "Invalid password!<br>";
}

echo "<br>";



$sha512hash = hash('sha512', $passwordplaintext);
echo "SHA512: " . $sha512hash . "<br>";

if(hash('sha512', $typedpassword) == $sha512hash) {
    echo "Valid password!<br>";
} else {
    echo "Invalid password!<br>";
}

echo "<br>";



//MD5 IS NOT SAVE ANYMORE!
echo "DO NOT USE MD5 ANYMORE! IT HAS BEEN CRACKED ALREADY!<br>";
$md5hash = hash('md5', $passwordplaintext);
echo "MD5: " . $md5hash . "<br>";

if(hash('md5', $typedpassword) == $md5hash) {
    echo "Valid password!<br>";
} else {
    echo "Invalid password!<br>";
}

?>