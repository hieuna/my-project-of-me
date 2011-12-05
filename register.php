<?php
include "header.php";
require_once(PG_ROOT."/include/oauth/SohaPayOAuth2Client.php");
require_once(PG_ROOT."/include/environment/request.php");

function dprint_r($msg) {
  echo "<code><pre>";
  var_dump($msg);
  echo "</pre></code>";
}

$input['user_email'] 	= trim(PGRequest::getVar('user_email', '', 'POST'));
$input['user_username'] = trim(PGRequest::getVar('user_username', '', 'POST'));
$input['user_password'] = trim(PGRequest::getVar('user_password', '', 'POST'));
$input['repassword'] 	= trim(PGRequest::getVar('repassword', '', 'POST'));
$input['user_fullname'] = trim(PGRequest::getVar('user_fullname', '', 'POST'));
$input['user_mobile'] 	= trim(PGRequest::getCmd('user_mobile', '', 'POST'));
$input['user_address'] 	= trim(PGRequest::getVar('user_address', '', 'POST'));

$client = new SohaPayOAuth2Client(array(
  'client_id' => 'fc3351731507867de3e764715e2e945b',
  'client_secret' => 'c74d6bd1f81d40b8d1bc276891fe871e',
  'base_uri' => 'http://localhost/payment/',
  'authorize_uri' => 'services/sv_authorize.php',
  'access_token_uri' => 'services/sv_token.php',  
  'client_credentials' => TRUE,
  //'services_uri' => 'o',
  'expires_in' => 3600,
  'cookie_support' => TRUE,
));

$param = array(
	'user_email' 		=> $input['user_email'],
	'user_username' 	=> $input['user_username'],
	'user_password'		=> $input['user_password'],
	'repassword'		=> $input['repassword'],
	'user_fullname' 	=> $input['user_fullname'],
	'user_mobile' 		=> $input['user_mobile'],
	'user_address' 		=> $input['user_address'],
);
//var_dump($param);

$session = $client->getSession();
//dprint_r($session);
$result = $client->api("services/sv_register.php","", $param);
//dprint_r($result);
echo $result;
?>
