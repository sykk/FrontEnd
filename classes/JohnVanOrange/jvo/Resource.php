<?php
namespace JohnVanOrange\jvo;

class Resource extends Base {
 
 private $user;

 public function __construct() {
  parent::__construct();
  $this->user = new User;
 }

 public function add($type, $image = NULL, $sid = NULL, $value = NULL) {
  $current = $this->user->current($sid);
  $user_id = NULL;
  if (isset($current['id'])) $user_id = $current['id'];
  $query = new \Peyote\Insert('resources');
  $query->columns(['ip', 'image', 'user_id', 'value', 'type'])
        ->values([$_SERVER['REMOTE_ADDR'], $image, $user_id, $value, $type]);
  return $this->db->fetch($query);
 }
 
 public function merge($to, $from) {
  if (!$this->user->isAdmin()) throw new \Exception('Must be an admin to access method', 401);
  $query = new \Peyote\Update('resources');
  $query->set(['image' => $to])
        ->where('image', '=', $from);
  $this->db->fetch($query);
  return TRUE;
 }
 
}