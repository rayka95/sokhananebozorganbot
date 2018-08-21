<?php

function create($text){
header('Content-type: image/jpeg');
  require_once('persian_log2vis.php');
  $jpg_image = imagecreatefromjpeg('erfan.jpg');
  $white = imagecolorallocate($jpg_image, 255, 255, 255);
  putenv('GDFONTPATH=' . realpath('.'));
  $font_path = "iransans.ttf";
  if(!(isset($text))){
  $text= "خط اول هستش خیلی هم قشنگ هست\n نرفتم\n کجا برم \n جایی ندارم بر";
}
  persian_log2vis($text);
    //  echo strlen($text);
    $arr = explode("\n",$text);
  foreach ($arr as $key => $line){
        $dim = imagettfbbox ( 18 , 0 , $font_path , $line);
        $textWidth = abs($dim[4] - $dim[0]);
        $x = imagesx($jpg_image) - $textWidth;
        imagettftext($jpg_image, 18, 0, $x - 10, (500 + ($key * 50)) , $white, $font_path, $line);
}
  imagejpeg($jpg_image);
  imagedestroy($jpg_image);
}

if (isset($_GET['text'])){

create(file_get_contents($_GET['text']));

}
else{
  create("هیچ سخنی ندارم بگویم جز تبدیل مو به خال عزیزان من . \n آقای پازیار");

}



?>
