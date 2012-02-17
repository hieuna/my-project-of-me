<?php
class ControllerPaymentbaokim extends Controller {
	protected function index() {
		$this->data['button_confirm'] = $this->language->get('button_confirm');
		$this->data['button_back'] = $this->language->get('button_back');

		$this->load->model('checkout/order');
		
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		
		$this->load->library('encryption');
		

		//$this->data['action'] = 'https://www.baokim.com/PayProcess.aspx';

		$this->data['ap_merchant'] = $this->config->get('baokim_merchant');
		$this->data['ap_amount'] = $this->currency->format($order_info['total'], $order_info['currency'], $order_info['value'], FALSE);
		$this->data['ap_currency'] = $order_info['currency'];
		$this->data['ap_purchasetype'] = 'Item';
		$this->data['ap_itemname'] = $this->config->get('config_name') . ' - #' . $this->session->data['order_id'];
		$this->data['ap_itemcode'] = $this->session->data['order_id'];
		$this->data['ap_returnurl'] = HTTPS_SERVER . 'index.php?route=checkout/success';
		
		$order_id = $this->session->data['order_id'];
		
		$total_amount = $this->currency->format($order_info['total'], $order_info['currency'], $order_info['value'], FALSE);
		$total_amount = intval($total_amount);
		$shipping_fee = '';
		$tax_fee = '';
		$order_description = '';
		$url_success = HTTPS_SERVER . 'index.php?route=checkout/success';
		$url_cancel = HTTPS_SERVER . 'index.php?route=checkout/success';
		$url_detail = HTTPS_SERVER . 'index.php?route=checkout/cart';
		$merchant_id = $this->config->get('baokim_merchant');
		$secure_pass = $this->config->get('baokim_security');
		$business = $this->config->get('baokim_business');
		
		$this->data['action'] = self::createRequestUrl($order_id, $business, $total_amount, $shipping_fee, $tax_fee, $order_description, $url_success, $url_cancel, $url_detail,$merchant_id,$secure_pass);
		//echo $this->data['action'];
		
		
		if ($this->request->get['route'] != 'checkout/guest_step_3') {
			$this->data['ap_cancelurl'] = HTTPS_SERVER . 'index.php?route=checkout/payment';
		} else {
			$this->data['ap_cancelurl'] = HTTPS_SERVER . 'index.php?route=checkout/guest_step_2';
		}
		
		if ($this->request->get['route'] != 'checkout/guest_step_3') {
			$this->data['back'] = HTTPS_SERVER . 'index.php?route=checkout/payment';
		} else {
			$this->data['back'] = HTTPS_SERVER . 'index.php?route=checkout/guest_step_2';
		}
		
		$this->id = 'payment';
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/baokim.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/payment/baokim.tpl';
		} else {
			$this->template = 'default/template/payment/baokim.tpl';
		}		
		
		$this->render();
		
	}
	
	
	public function createRequestUrl($order_id, $business, $total_amount, $shipping_fee, $tax_fee, $order_description, $url_success, $url_cancel, $url_detail,$merchant_id,$secure_pass)
	{
		$baokim_url = 'https://www.baokim.vn/payment/customize_payment/order';
		// Mảng các tham số chuyển tới baokim.vn
		$params = array(
			'merchant_id'		=>	strval($merchant_id),
			'order_id'			=>	strval($order_id),
			'business'			=>	strval($business),
			'total_amount'		=>	strval($total_amount),
			'shipping_fee'		=>  strval($shipping_fee),
			'tax_fee'			=>  strval($tax_fee),
			'order_description'	=>	strval($order_description),
			'url_success'		=>	strtolower($url_success),
			'url_cancel'		=>	strtolower($url_cancel),
			'url_detail'		=>	strtolower($url_detail)
		);
		ksort($params);
		
		$str_combined = $secure_pass.implode('', $params);
		$params['checksum'] = strtoupper(md5($str_combined));
		
		//Kiểm tra  biến $redirect_url xem có '?' không, nếu không có thì bổ sung vào
		$redirect_url = $baokim_url;
		if (strpos($redirect_url, '?') === false)
		{
			$redirect_url .= '?';
		}
		else if (substr($redirect_url, strlen($redirect_url)-1, 1) != '?' && strpos($redirect_url, '&') === false)
		{
			// Nếu biến $redirect_url có '?' nhưng không kết thúc bằng '?' và có chứa dấu '&' thì bổ sung vào cuối
			$redirect_url .= '&';			
		}
				
		// Tạo đoạn url chứa tham số
		$url_params = '';
		foreach ($params as $key=>$value)
		{
			if ($url_params == '')
				$url_params .= $key . '=' . urlencode($value);
			else
				$url_params .= '&' . $key . '=' . urlencode($value);
		}
		return $redirect_url.$url_params;
	}
	
	public function confirm() {
			$this->load->model('checkout/order');
			
			$this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('baokim_order_status_id'));
	}
}
?>