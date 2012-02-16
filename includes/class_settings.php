<?php
class PGSettings
{
	function PGSettings()
	{
		return;
	}
	
	function getSettings()
	{
		$settings = array(
			'setting_password_method' => 1,
			'setting_password_code_length' => 16,
			'setting_username' => 0,
			'setting_cache_enabled' => 0,
			'setting_cache_default' => 'file',
			'setting_cache_lifetime' => 120,
			'setting_cache_file_options' => 'a:2:{s:4:"root";s:7:"./cache";s:7:"locking";b:1;}',
			'setting_cache_memcache_options' => 'a:1:{s:7:"servers";a:1:{i:0;a:2:{s:4:"host";s:9:"localhost";s:4:"port";i:11211;}}}',
			'setting_cache_xcache_options' => '',
			'setting_session_options' => 'a:4:{s:7:"storage";s:4:"none";s:6:"expire";i:259200;s:4:"name";s:32:"fbbf55807d6bc9fe23bd03063ee6d557";s:7:"servers";a:1:{i:0;a:2:{s:4:"host";s:9:"localhost";s:4:"port";i:11211;}}}',
			'setting_banned_words' => '',
			'setting_list_limit' => 50,
			'setting_banned_emails' => '',
			'setting_banned_usernames' => '',
			'setting_password_code_length' => 16,
			'setting_signup_enable' => 1,
			'setting_signup_merchant_enable' => 0,
			'setting_signup_verify' => 1,
			'setting_signup_code' => 0,
			'setting_signup_randpass' => 0,
			'setting_signup_welcome' => 1,
			'setting_login_code' => 0,
			'setting_login_code_failedcount' => 10,
			'setting_gold_rate' => 95/100,
			'setting_transfer_expires' => 86400,
			'setting_amount_risk' => 10000000,
			'setting_vpc_version' => 2,
			'mail_type' => 'smtp',
			'mail_sendmailpath' => '/usr/sbin/sendmail',
			'mail_smtpauth' => true,
			'mail_smtpsecure' => 'none',
			'mail_smtpport' => 25,
			'mail_smtpuser' => 'noreply@sohapay.com',
			'mail_smtppass' => 'FaKU2s2js9htK493IGd5X',
			'mail_smtphost' => '192.168.3.68',
			'mail_soap_send' => 'http://192.168.3.151:8080/SendMailService.asmx?WSDL' 
		);
		
		return $settings;
	}
}
?>