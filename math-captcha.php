<?php
session_start();

// Generate random numbers and operation
$num1 = rand(1, 10);
$num2 = rand(1, 10);
$operators = ['+', '-'];
$operator = $operators[array_rand($operators)];

// Ensure subtraction doesn't result in a negative value
if ($operator == '-' && $num1 < $num2) {
    [$num1, $num2] = [$num2, $num1]; // Swap values
}

// Calculate the result
$result = ($operator == '+') ? ($num1 + $num2) : ($num1 - $num2);

// Store result in session
$_SESSION['captcha'] = $result;

// Create image
$width = 100;
$height = 40;
$image = imagecreatetruecolor($width, $height);
$background = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
$line_color = imagecolorallocate($image, 100, 100, 100);

imagefilledrectangle($image, 0, 0, $width, $height, $background);

// Add noise lines
for ($i = 0; $i < 3; $i++) {
    imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $line_color);
}

// Add the text
$font = 5; // Built-in font
$text = "$num1 $operator $num2 = ?";
$x = ($width - imagefontwidth($font) * strlen($text)) / 2;
$y = ($height - imagefontheight($font)) / 2;
imagestring($image, $font, $x, $y, $text, $text_color);

// Output the image
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
?>
