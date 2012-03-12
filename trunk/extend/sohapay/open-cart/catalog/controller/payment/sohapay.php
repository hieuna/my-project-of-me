<?php
class ControllerPaymentsohapay extends Controller {
	protected function index() {
		include("class_payment.php");
    	$this->data['button_confirm'] = $this->language->get('button_confirm');
		$this->load->model('checkout/order');
		
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		
		$this->load->library('encryption');
		
		/*-- START PAYMENT SOHAPAY --*/
		$return_url = $this->config->get('sohapay_return_url');
		$receiver=$this->config->get('sohapay_receiver');
		$site_code = $this->config->get('sohapay_site_code');
		$secure_secret = $this->config->get('sohapay_secure_secret');	
		$order_code=$this->session->data['order_id'];
		$order_email = $order_info["email"];
		$price=$this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false);
		$transaction_info = 'Thanh toán đơn đặt hàng tại website '.str_replace('www.','',$_SERVER['HTTP_HOST']);
		$order_phone = $order_info["telephone"];
		
		$classPayment = new PG_checkout($site_code, $secure_secret);
		$sohapay_checkout_url = $classPayment->buildCheckoutUrl($return_url, $transaction_info, $order_code, $price, $order_email, $order_phone);
	
		$msg = 'Thanh toán thành công !';
		
		$_SESSION['link_pay'] = $sohapay_checkout_url;
		/*-- END PAYMENT SOHAPAY --*/
		
		$this->data['continue'] = $this->url->link('checkout/success');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/sohapay.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/payment/sohapay.tpl';
		} else {
			$this->template = 'default/template/payment/sohapay.tpl';
		}	
		
		$this->render();
	}
	
	public function confirm() {
		$this->load->model('checkout/order');
		var_dump($_GET);
		
		$shp_check = $classPayment->verifyReturnUrl();
		$shp_error_text= isset($_GET["error_text"])?$_GET["error_text"]:"";
		$shp_payment_type = isset($_GET["payment_type"])?$_GET["payment_type"]:"";
		$shp_respone_code = isset($_GET["response_code"])?$_GET["response_code"]:"";
		$shp_respone_massage = isset($_GET["response_message"])?$_GET["response_message"]:"";
		
		$pp_response = array();
  
		if ($shp_check && empty($shp_error_text)){
		  $pp_response['order_status']    = 'P';
		  $pp_response['transaction_id']  = isset($_GET['order_code'])?$_GET['order_code']:"";
		}else{
		  $pp_response['order_status']    = 'F';
		  if (empty($shp_error_text)){
			if ($shp_payment_type==1) $pp_response['reason_text'] = $classPayment->getResponseDescriptionInternational($shp_respone_code);
		  else $pp_response['reason_text'] = $classPayment->getResponseDescriptionDomestic($shp_respone_code);
		  }else{
			$pp_response['reason_text'] = $shp_error_text;
		  }
		} 
				
		$this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('sohapay_order_status_id'));
	}
}
?>