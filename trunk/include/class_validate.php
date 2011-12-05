<?php
defined('PG_PAGE') or die();

class Validation {
    /**
     * construct method
     */
    public function __construct() {}
    
    /**
	 * Check string member login
	 * @param string $strLogin
	 * @return boolean
	 */
	public static function isAlnum($str) {
		if (preg_match("/^[A-Za-z0-9_s]+$/", (string) $str)) {
			return true;
		}
		return false;
	}
	

    public static function isEmail($email) {
        $result = false;
        $pattern = '/^(([a-z0-9!#$%&\/*+-=?^_`\'{|}~]'.
                '[a-z0-9!#$%&\/*+-=?^_`\'{|}~.]*'.
                '[a-z0-9!#$%&\/*+-=?^_`\'{|}~])'.
                '|[a-z0-9!#$%&\/*+-?^_`\'{|}~]|'.
                '("[^",<>]+"))'.
                '[@]((?:[-a-z0-9]+\.)+[a-z]{2,})$/ix';
    
        $value = str_replace('\"', '', $email);
        $result = preg_match($pattern, $value);
        if ($result) {
            $aryItem = explode('@', $email);
            array_pop($aryItem);
            $value1 = join('@', $aryItem);
            if (strpos($value1, '..') !== false || $value1{0} == '.' || $value1{strlen($value1) - 1} == '.') {
                $result = false;
            }
        }
        return $result;
    }
    
    /**
     * Checks that a value is a valid URL according to http://www.w3.org/Addressing/URL/url-spec.txt
     *
     * @param string $check Value to check
     * @return boolean Success
     * @access public
     */
    public static function isURL($url, $domain=false) {
        if (!$domain) return preg_match('|^http(s)?://[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
        else return preg_match('|^[a-z0-9-]+(\.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
    }

    public static function isNumber() {}

    public static function isDate() {}

    public static function isTime() {}

    public static function isPhone() {}

}
?>
