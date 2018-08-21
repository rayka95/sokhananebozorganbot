<?php
opcache_reset();






define('BOT_TOKEN', '290621114:AAFlcgDUQNoH211n7TbnQglj1TKgBjrL_fo');
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/');

$content = file_get_contents("php://input");
$update = json_decode($content, true);
$chatID = $update["message"]["chat"]["id"];
$messageID = $update["message"]["message_id"];
$text = $update["message"]["text"];
if(strpos($text,"/sokhan") !== false){
  $update["message"]["text"] = str_replace("/sokhan ","",$update["message"]["text"]);
//  $update["message"]["text"] = preg_replace('/%u([0-9A-F]+)/', '&#x$1;', $update["message"]["text"]);
  //$update["message"]["text"] = preg_replace('/\s/', '%20', $update["message"]["text"]);
file_put_contents("log.txt",$update["message"]["text"]);
file_put_contents($messageID.".txt",$update["message"]["text"]);

$url = "https://drsafety.ir/erfan/create.php?text=" . $messageID.".txt";
$sendto =API_URL."sendphoto?chat_id=".$chatID."&photo=".$url."&reply_to_message_id=" .$messageID;
file_put_contents("log.txt",file_get_contents($sendto),FILE_APPEND);
unlink($messageID.".txt");

}
?>
