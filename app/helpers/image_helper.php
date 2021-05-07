<?php

function isImage($imageFile){
    return getimagesize($imageFile["tmp_name"]);
}
function isCorrectSize($imageFile, $maxSize = "7000000"){
    // size maxed to 7MB
    return $imageFile['size'] < $maxSize;
}
function isCorrectExtension($extension){
    return !($extension != "jpg" 
    && $extension != "png" 
    && $extension != "jpeg" 
    && $extension != "gif");
}
function getUploadLocation($uploadFileName){
    // get directory where to save image
    $appDir = dirname(APPROOT) . '/public/images/storage/';

    // concat and return directory plus image file name
    return $appDir . $uploadFileName;
}
function getUploadFileName($imageFile){
    // get name of image from $_FILES = $imageFile
    $fileName = basename($imageFile['name']);

    // get name and extension seperate
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $fileName = pathinfo($fileName, PATHINFO_FILENAME);

    // retrun hashed filename with formated date and extension
    return date("Ymd", time()) . '_'. md5($fileName) . '.' . $fileExtension;
}
