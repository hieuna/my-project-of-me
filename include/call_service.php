<?php
//defined ( 'PG_PAGE' ) or die ();

require_once 'nusoap/nusoap.php';

class PrepaidcardServiceProxy {
	
	/**
	 * Constructor using wsdl location and options array
	 * @param string $wsdl WSDL location for this service
	 * @param array $options Options for the SoapClient
	 */
	public function __construct($options=array()) {
		
		$wsdl = "http://222.255.28.212:9900/wsdl";

		$this->client = new nusoap_client ( $wsdl, $options ); // phan nay khai bao client goi wa ben a
		$err = $this->client->getError ();
		
		if ($err) print_r ( $err );
		return true;
	}
	
	public function CheckCard($args) {
        var_dump($args);
        
        $result = $this->client->call("CheckCard", $args);
        
        $err = $this->client->getError();
        if ($err) print_r ( $err );
        
		return $result;
	}


	public function UseCard($mixed = null) {
		$args = func_get_args();
		return $this->client->call("UseCard", $args);
	}


	public function GetTransactionList($mixed = null) {
		$args = func_get_args();
		return $this->__soapCall("GetTransactionList", $args);
	}
    
    public function __call($function_name, $arguments) {
        try {
            return $this->__soapCall($function_name, $arguments);
        } catch (Exception $e) {
            return false;
        }
    }
}
