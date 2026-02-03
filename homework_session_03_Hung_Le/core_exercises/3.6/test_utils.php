<?php
require 'utils.php';

echo "<h2>Testing Utilities</h2>";

// Test 1: Sanitize
$badInput = "<script>alert('hack')</script>";
echo "Sanitize Test: " . (sanitize($badInput) === "&lt;script&gt;alert(&#039;hack&#039;)&lt;/script&gt;" ? "PASS" : "FAIL") . "<br>";

// Test 2: Email
echo "Email Valid Test: " . (validateEmail("test@test.com") ? "PASS" : "FAIL") . "<br>";
echo "Email Invalid Test: " . (!validateEmail("test@com") ? "PASS" : "FAIL") . "<br>";

// Test 3: Length
echo "Length Test (Hi, 2, 5): " . (validateLength("Hi", 2, 5) ? "PASS" : "FAIL") . "<br>";

// Test 4: Password
echo "Password Weak: " . (!validatePassword("123456") ? "PASS" : "FAIL") . "<br>";
echo "Password Strong (Pass#word1): " . (validatePassword("Pass#word1") ? "PASS" : "FAIL") . "<br>";
?>