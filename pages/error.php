<?php
require('common/smarty.php');

$template = 'error.tpl';

header("HTTP/1.0 ".$number);
$_SERVER['REDIRECT_STATUS'] = $number;

$tpl->assign('number',$number);
$tpl->assign('web_root',WEB_ROOT);

require_once('common.php');

header("Content-type: text/html; charset=UTF-8");
$tpl->display($template);
