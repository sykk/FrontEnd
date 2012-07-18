<?php

function page_exception_handler($e) {
 $message = "An error occured for site ". SITE_NAME . ".\n\n";
 $message .= "Error:\n";
 $message .= $e->getMessage()."\n\n";
 $message .= "Code:\n";
 $message .= $e->getCode();
 mail(
  ADMIN_EMAIL,
  'Error Occured for '. SITE_NAME,
  $message
 );
 switch($e->getCode()) {
  case 403:
  case 404:
   $number = $e->getCode();
   include(ROOT_DIR.'/pages/error.php');
   die();
   break;
   default:
    include(ROOT_DIR.'/pages/exception.php');
    die();
   break;
 }
}

function js_exception_handler($e) {
 echo json_encode(array(
  'error' => $e->getCode(),
  'message' => $e->getMessage()
 ));
 die();
}

function call($method, $options=array()) {
 $result = explode('/',$method);
 $class = $result[0];
 $method = $result[1];
 
 $valid_classes = array(
  'image' => 'Image',
  'user' => 'User',
  'tag' => 'Tag',
  'theme' => 'Theme',
  'reddit' => 'Reddit'
 );
 try {
  switch ($class) {
   case 'image':
   case 'user':
   case 'tag':
   case 'theme':
   case 'reddit':
    $class_name = $valid_classes[$class];
    require_once('classes/'.$class.'.class.php');
   break;
   default:
    throw new Exception('Invalid class/URL');
   break;
  }
  $class_obj = new $class_name;
  return $class_obj->{$method}($options);
 }
 catch(Exception $e) {
  page_exception_handler($e);
 }
}