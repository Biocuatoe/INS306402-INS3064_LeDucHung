<?php
function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validateLength($str, $min, $max) {
    $len = strlen($str);
    return $len >= $min && $len <= $max;
}

function validatePassword($pass) {
    // Min 8 chars, 1 special char is a simple rule for this exercise
    // Using Regex: At least 8 chars, at least 1 special char
    return preg_match('/^(?=.*[\W_]).{8,}$/', $pass);
}
?>