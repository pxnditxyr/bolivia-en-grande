<?php
session_start();

require_once "../config/config.php";

function generateCaptchaText( $length = 6 ) {
  $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
  $captchaText = substr( str_shuffle( $characters ), 0, $length );
  return $captchaText;
}

$captchaText = generateCaptchaText();
$_SESSION[ 'captcha' ] = sha1( $captchaText );

header( 'Content-Type: image/png' );

$height = 50;
$width  = 130;
$image  = imagecreatetruecolor( $width, $height );

$bgColor   = imagecolorallocate( $image, 239, 243, 200 );
imagefilledrectangle( $image, 0, 0, $width, $height, $bgColor );

$textColor = imagecolorallocate( $image, 60, 41, 12 );
$lineColor = imagecolorallocate( $image, 3, 3, 3 );

for ( $i = 0; $i < 6; $i++ ) {
  imageline(
    $image,
    0, rand( 0, $height ), $width, rand( 0, $height ),
    $lineColor
  );
}

for ( $i = 0; $i < 500; $i++ ) {
  imagesetpixel(
    $image,
    rand( 0, $width ), rand( 0, $height ),
    $lineColor
  );
}

$font_size = 25;

imagettftext(
  $image,
  $font_size,
  -5, 10, 30,
  $textColor,
  '../assets/fonts/Consolas.ttf',
  $captchaText
);

imagepng( $image );
imagedestroy( $image );
