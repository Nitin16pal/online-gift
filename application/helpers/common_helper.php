<?php
    function generateRandomString($length = 6) {// Random String Genrate
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_$#*', ceil($length/strlen($x)) )),1,$length);
    }
