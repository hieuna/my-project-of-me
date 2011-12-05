<?php
defined('PG_PAGE') or die();

class PGSettings
{
	function PGSettings()
	{
		return;
	}
	
	function getSettings()
	{
		// Cache settings
		$cacheTime = 2592000; // 30d
		$settings = CacheLib::get('getSettings', $cacheTime);
		if ($settings) return $settings;
		
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
			'setting_signup_enable' => 0,
			'setting_signup_verify' => 1,
			'setting_signup_code' => 0,
			'setting_signup_randpass' => 0,
			'setting_signup_welcome' => 1,
			'setting_login_code' => 0,
			'setting_login_code_failedcount' => 10,
			'setting_gold_rate' => 95/100,
			'setting_transfer_expires' => 86400,
			'mail_type' => 'smtp',
			'mail_sendmailpath' => '/usr/sbin/sendmail',
			'mail_smtpauth' => true,
			'mail_smtpsecure' => 'none',
			'mail_smtpport' => 25,
			'mail_smtpuser' => 'noreply@sohapay.com',
			'mail_smtppass' => 'FaKU2s2js9htK493IGd5X',
			'mail_smtphost' => '192.168.3.68'
		);
		
		CacheLib::set('getSettings', $settings, $cacheTime);
		
		return $settings;
	}
	
	function getSettingOnepay($order_session){
		global $database;
		//Cache site
		$cacheTime = 1800; // 30m
		$cacheKey = 'getSitecode_'.$order_session;
		$settings = CacheLib::get($cacheKey, $cacheTime);
		if ($settings) return $settings;
		
		$query = "SELECT order_site_id FROM orders WHERE order_session=".$database->Quote($order_session)." LIMIT 1";
		$result = $database->db_fetch_assoc( $database->db_query($query) );
		$siteID = $result['order_site_id'];
			
		if (!$siteID) return false;

		$settings = array(
			'onepay_qt_vpcURL' 					=> 'https://migs.mastercard.com.au/vpcpay',
			'onepay_qt_vpc_Locale' 				=> 'en',
			'onepay_qt_vpc_Merchant' 			=> 'VCCORPVND',
			'onepay_qt_vpc_AccessCode' 			=> '738B6438',
			'onepay_qt_SECURE_SECRET' 			=> '520D0AA3EBC076434A387A45DD69D4B0',
			'onepay_qt_virtualPaymentClientURL' => 'https://migs.mastercard.com.au/vpcdps',
			'onepay_qt_vpc_User' 				=> 'op01',
			'onepay_qt_vpc_Password' 			=> 'op123456',
			'onepay_qt_query_SECURE_SECRET' 	=> '520D0AA3EBC076434A387A45DD69D499',
			'onepay_nd_vpcURL' 					=> 'https://onepay.vn/onecomm-pay/vpc.op',
			'onepay_nd_vpc_Locale' 				=> 'vn',
			'onepay_nd_vpc_Currency' 			=> 'VND',
			'onepay_nd_vpc_Merchant' 			=> 'VCCORP',
			'onepay_nd_vpc_AccessCode' 			=> 'KH3WAMVE',
			'onepay_nd_SECURE_SECRET' 			=> 'ZVNSL03TKZGCOKVVXWTJUWANQTBTNTHB',
			'onepay_nd_virtualPaymentClientURL' => 'https://onepay.vn/onecomm-pay/Vpcdps.op',
			'onepay_nd_vpc_User' 				=> 'op01',
			'onepay_nd_vpc_Password'			=> 'op123456',
			'onepay_qt_NO3D_vpc_Merchant' 		=> 'VCCORPVND01',
			'onepay_qt_NO3D_vpc_AccessCode' 	=> 'ACD836E2',
			'onepay_qt_NO3D_SECURE_SECRET' 		=> '8AB0E75E5F30AE069E82BA626C805ECE',
			'onepay_qt_NO3D_vpc_User' 			=> 'op01',
			'onepay_qt_NO3D_vpc_Password' 		=> 'op123456',
			'onepay_qt_NO3D_query_SECURE_SECRET' => '8AB0E75E5F30AE069E82BA626C805ECE'
		);
		
		// Quy Tu Thien
		if ($siteID==4){
			$settings['onepay_qt_vpcURL'] 				= 'https://migs.mastercard.com.au/vpcpay';
			$settings['onepay_qt_vpc_Merchant'] 		= 'UNGHOTUTHIEN';
			$settings['onepay_qt_vpc_AccessCode'] 		= 'FC1B3954';
			$settings['onepay_qt_SECURE_SECRET'] 		= '6B77558A6691145B65D57F30F9ACFEC0';
			$settings['onepay_qt_query_SECURE_SECRET'] 	= '6B77558A6691145B65D57F30F9ACFEC0';
			$settings['onepay_nd_vpcURL'] 				= 'http://onepay.vn/onecomm-pay/vpc.op';
			$settings['onepay_nd_vpc_Merchant'] 		= 'UNGHOTUTHIEN';
			$settings['onepay_nd_vpc_AccessCode'] 		= 'LO5BZGHW';
			$settings['onepay_nd_SECURE_SECRET'] 		= 'SOH1KEFZTK4NWQGUTTK09JWVCS7AJWCX';
		}
		// TEST MODE
		if ($siteID==1){
			$settings['onepay_qt_vpcURL'] 				= 'https://migs.mastercard.com.au/vpcpay';
			$settings['onepay_qt_vpc_Merchant'] 		= 'TESTONEPAYUSD';
			$settings['onepay_qt_vpc_AccessCode'] 		= '2F668CD2';
			$settings['onepay_qt_SECURE_SECRET'] 		= '18D7EC3F36DF842B42E1AA729E4AB010';
			$settings['onepay_qt_query_SECURE_SECRET'] 	= '18D7EC3F36DF842B42E1AA729E4AB010';
			$settings['onepay_nd_vpcURL'] 				= 'http://mtf.onepay.vn/onecomm-pay/vpc.op';
			$settings['onepay_nd_vpc_Merchant'] 		= 'ONEPAY';
			$settings['onepay_nd_vpc_AccessCode'] 		= 'D67342C2';
			$settings['onepay_nd_SECURE_SECRET'] 		= 'A3EFDFABA8653DF2342E8DAC29B51AF0';
		}
		
		CacheLib::set($cacheKey, $settings, $cacheTime);		
		
		return $settings;
	}
	
	function getSettingMobileCard($ungho=false)
	{
		// Cache settings
		$cacheTime = 2592000; // 30d
		$cacheKey = $ungho?'getSettingMobileCardUngHo':'getSettingMobileCard';

		$settings = CacheLib::get($cacheKey, $cacheTime);
		if ($settings) return $settings;
		
		if ($ungho==false){
			$settings = array(
				'wsdl' => 'http://123.30.179.27:8081/webservice/VDCTelcoAPI?wsdl',
				'username' => 'vccorp',
				'password' => 'soha.vn',
				'agent_id' => 3,
				'pin' => 'muachung.vn'
			);
		}
		else {
			$settings = array(
				'wsdl' => 'http://123.30.179.27:8081/webservice/VDCTelcoAPI?wsdl',
				'username' => 'ungho_dantri',
				'password' => 'vccorp.dantri',
				'agent_id' => 19,
				'pin' => 'ungho.dantri.com'
			);
		}
		
		CacheLib::set($cacheKey, $settings, $cacheTime);
		
		return $settings;
	}
	
	function getPaymentMethod($siteID='', $order_session=''){
		global $database;
		// Cache method
		$cacheTime = 1800; // 30m
		$cacheKey = 'getPaymentFee_'.$siteID.'_'.$order_session;
		$method = CacheLib::get($cacheKey, $cacheTime);
		if ($method) return $method;
		
		$site = array();
		if (!$siteID && $order_session){
			$query = "SELECT order_site_id FROM orders WHERE order_session=".$database->Quote($order_session)." LIMIT 1";
			$result = $database->db_fetch_assoc( $database->db_query($query) );
			$siteID = $result['order_site_id'];
		}
	
		if ($siteID){
			$query = "SELECT a.site_qt_feename, a.site_qt_feeper, a.site_qt_feefix, a.site_nd_feename, a.site_nd_feeper, a.site_nd_feefix, a.site_mc_feename, a.site_mc_feeper, a.site_mc_feefix 
					FROM sites AS a 
					WHERE a.site_id=".(int) $siteID." AND a.site_publish=1 LIMIT 1";
			$site = $database->db_fetch_assoc( $database->db_query($query) );
		}
		
		$method = array(
			1 => array(
				'name' 		=> 'Thẻ tín dụng và Ghi nợ Quốc tế',
				'fee' 		=> strval($site['site_qt_feename']),
				'fee_per' 	=> floatval($site['site_qt_feeper']),
				'fee_fix' 	=> intval($site['site_qt_feefix'])
			),
			2 => array(
				'name' 		=> 'Thẻ nội địa ATM và Internet Banking',
				'fee' 		=> strval($site['site_nd_feename']),
				'fee_per' 	=> floatval($site['site_nd_feeper']),
				'fee_fix' 	=> intval($site['site_nd_feefix'])
			),
			3 => array(
				'name'		=> 'Thẻ điện thoại trả trước',
				'fee' 		=> strval($site['site_mc_feename']),
				'fee_per' 	=> floatval($site['site_mc_feeper']),
				'fee_fix' 	=> intval($site['site_mc_feefix'])
			),
			4 => array(
				'name'		=> 'Chuyển khoản',
			),
			5 => array(
				'name'		=> 'COD',
			),
			6 => array(
				'name'		=> 'Nạp Gold',
			)
		);
		
		CacheLib::set($cacheKey, $method, $cacheTime);
		
		return $method;
	}
	
	function getDomesticBank(){
		// Cache getDomesticBank
		$cacheTime = 2592000; // 30d
		$cacheKey = 'getDomesticBank';
		$banks = CacheLib::get($cacheKey, $cacheTime);
		if ($banks) return $banks;
		
		$banks = array(
			1 => 'Vietcombank',
			2 => 'Techcombank',
			3 => 'TienPhongbank',
			4 => 'Vietinbank',
			5 => 'VIB',
			6 => 'Dong A Bank',
			7 => 'HD Bank',
			8 => 'MB Bank',
			9 => 'VietABank',
			10 => 'Maritime Bank',
			11 => 'EximBank',
			12 => 'SHB',
			17 => 'Nam A Bank'
		);
		
		CacheLib::set($cacheKey, $banks, $cacheTime);
		
		return $banks;
	}
	
	function getInternationalCard(){
		// Cache getInternationalCard
		$cacheTime = 2592000; // 30d
		$cacheKey = 'getInternationalCard';
		$card = CacheLib::get($cacheKey, $cacheTime);
		if ($card) return $card;
		
		$card = array(
			'Visa' => 'Visa',
			'Mastercard' => 'Mastercard'
		);
		
		CacheLib::set($cacheKey, $card, $cacheTime);
		
		return $card;
	}
	
	function getTypeEmail() {
		$cacheTime = 2592000; // 30d
		$cacheKey = 'type';
		$type = CacheLib::get($cacheKey, $cacheTime);
		if ($type) return $type;
		
		$type = array (
			'Register' => 'Register user Mail',
			'ChangePass' => 'Change password user Mail',
			'ForgotPass' => 'Forgot password user Mail'
		);
		
		CacheLib::set($cacheKey, $type, $cacheTime);
		
		return $type;
	}
	
	function getMobileCard(){
		// Cache getMobileCard
		$cacheTime = 2592000; // 30d
		$cacheKey = 'getMobileCard';
		$card = CacheLib::get($cacheKey, $cacheTime);
		if ($card) return $card;
		
		$card = array(
			'vinaphone' => 'Vinaphone',
			'mobifone' => 'Mobifone'
		);
		
		CacheLib::set($cacheKey, $card, $cacheTime);
		
		return $card;
	}
	
	static function getTypeUser() {
		$cacheTime = 2592000; // 30d
		$cacheKey = 'typeuser';
		$type = CacheLib::get($cacheKey, $cacheTime);
		if ($type) return $type;
		
		$type = array (
			1 => 'Người mua',
			2 => 'Người bán'
		);
		
		CacheLib::set($cacheKey, $type, $cacheTime);
		
		return $type;
	}
}
?>