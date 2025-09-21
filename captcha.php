<?php
session_start();

// Prevent any output before image headers
ob_clean();

// Generate a random 4-digit code
$code = rand(1000, 9999);
$_SESSION["captcha"] = $code;

// Create image
$image = imagecreate(80, 30);
$bg = imagecolorallocate($image, 255, 255, 255);  // White background
$text_color = imagecolorallocate($image, 0, 0, 0); // Black text

// Add the random code to image
imagestring($image, 5, 20, 7, $code, $text_color);

// Send headers to indicate image type
header('Content-Type: image/png');

// Output the image
imagepng($image);
imagedestroy($image);
exit;
?>
