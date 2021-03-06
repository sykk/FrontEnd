<?php
namespace JohnVanOrange\jvo;

require_once('../../vendor/autoload.php');
require_once('../../settings.inc');

$db = new DB('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
$image = new Image;
$query = new \Peyote\Select('images');
$query->columns('filename, uid')
      ->where('display', '=', 1)
	  ->where('type', '=', 'gif');
$results = $db->fetch($query);
$count = 0;
foreach ($results as $result) {
 $count++;
 set_time_limit(1000);
 echo 'Preparing image '.$result['uid']. ' ' . $count .' of '. count($results) . "\n";
 try {
  $thumb = @$image->scale($result['uid']);
  file_put_contents(ROOT_DIR.'/media/thumbs/'.$result['filename'],$thumb);
  echo 'Thumb created for '.$result['filename']."\n";
 }
 catch(\ImagickException $e) {
  $log = $result['filename'].' '.$e->getMessage()."\n";
  file_put_contents('thumb.log',$log,FILE_APPEND);
  echo 'Error saving thumb for '.$result['filename']."\n";
 }
}
echo "Processing complete.\n"
?>
