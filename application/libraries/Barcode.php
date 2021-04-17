<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require "vendor/autoload.php";
$qrcode = new QrReader('path/to_image');
$text = $qrcode->text(); //return decoded text from QR Code
// use PHPZxing\PHPZxingDecoder;
// namespace Barcode;

// use PHPZxing\PHPZxingDecoder;

// class PHPZxingDecoder extends PHPZxingBase

// include_once('vendor/dsiddharth2/php-zxing/src/PHPZxing/PHPZxingDecoder.php');
error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
require "D:/wamp/www/jafa/vendor/dsiddharth2/php-zxing/src/PHPZxing/PHPZxingBase.php";
require "D:/wamp/www/jafa/vendor/dsiddharth2/php-zxing/src/PHPZxing/PHPZxingInterface.php";
require "D:/wamp/www/jafa/vendor/dsiddharth2/php-zxing/src/PHPZxing/PHPZxingDecoder.php";
require "D:/wamp/www/jafa/vendor/dsiddharth2/php-zxing/src/PHPZxing/ZxingImage.php";
require "D:/wamp/www/jafa/vendor/dsiddharth2/php-zxing/src/PHPZxing/ZxingBarNotFound.php";    

use PHPZxing\PHPZxingDecoder;

// Bar Code Found
$decoder        = new PHPZxingDecoder();
// $data           = $decoder->decode('../images/Code128Barcode.jpg');
$data           = $decoder->decode('D:/wamp/www/jafa/resource/img/Code128Barcode.jpg');
if($data->isFound()) {
    $data->getImageValue();
    $data->getFormat();
    $data->getType();        
}

// Bar Code Not Found
$decoder        = new PHPZxingDecoder();
$data           = $decoder->decode('D:/wamp/www/jafa/resource/img/Code128Barcode.jpg');
if($data->isFound()) {
    $data->getImageValue();
    $data->getFormat();
    $data->getType();        
} else {
    echo "No Bar Code Found";
}

// Bar Code Options
$config = array(
    'try_harder'            => true,
    'crop'                  => '100,200,300,300',
);
$decoder        = new PHPZxingDecoder($config);
$decodedArray   = $decoder->decode('../images');
if(is_array($decodedArray)){
    foreach ($decodedArray as $data) {
        if($data->isFound()) {
            print_r($data);
        }
    }
}

// Send Multiple Images
$decoder        = new PHPZxingDecoder();
$imageArrays = array(
    '../images/Code128Barcode.jpg',
    '../images/Code39Barcode.jpg'
);
$decodedArray  = $decoder->decode($imageArrays);
foreach ($decodedArray as $data) {
    if($data instanceof PHPZxing\ZxingImage) {
        print_r($data);
    } else {
        echo "Bar Code cannot be read";
    }
}

// Bar Code options for reading multiple bar codes in the same image
$config = array(
    'try_harder' => true,
    'multiple_bar_codes' => true
);
$decoder        = new PHPZxingDecoder($config);
$decodedData    = $decoder->decode('../images/multiple_bar_codes.jpg');
print_r($decodedData);
