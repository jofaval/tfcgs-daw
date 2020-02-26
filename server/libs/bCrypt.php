<?php
class Cryptography {
    function blowfishCrypt($toEncrypt, $key) {
        // Salt starting with $2a$. The two digit cost parameter: 09. 22 characters
        $saltHash = '$2a$09$esternocleidomastoideo' . $key . '$';
        return crypt($toEncrypt, $saltHash);
    }
}
?>