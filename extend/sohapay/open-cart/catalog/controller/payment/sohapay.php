<?php
class ControllerPaymentSohaPay extends Controller {
	protected function index() {
		$this->data['button_confirm'] = $this->language->get('button_confirm');
		$this->data['button_back'] = $this->language->get('button_back');

		$this->load->model('checkout/order');
		$this->load->model('payment/sohapay');
		
		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
		
		$this->load->library('encryption');
		//Tạo link checkout cho sohapay
		$merchant_site_code=$this->config->get('sohapay_site_code');
		$secure_secret= $this->config->get('sohapay_secure_secret');
		$return_url=HTTPS_SERVER . 'index.php?route=checkout/success';
		$transaction_info="không có gì";
		$order_code=$this->session->data['order_id'];
		$order_email=$this->session->data['order_email'];
		$order_mobile=$this->session->data['order_mobile'];
		$price=$this->currency->format($order_info['total'], $order_info['currency'], $order_info['value'], FALSE);
		
		$this->data['action'] = $this->model_payment_sohapay->buildCheckoutUrl($return_url, $transaction_info, $order_code, $price, $order_email, $order_mobile);
	    // echo  $this->data['action'];die();
		//==============================

		$this->data['ap_merchant'] = $this->config->get('sohapay_merchant');
		$this->data['ap_amount'] = $this->currency->format($order_info['total'], $order_info['currency'], $order_info['value'], FALSE);
		$this->data['ap_currency'] = $order_info['currency'];
		$this->data['ap_purchasetype'] = 'Item';
		$this->data['ap_itemname'] = $this->config->get('config_name') . ' - #' . $this->session->data['order_id'];
		$this->data['ap_itemcode'] = $this->session->data['order_id'];
		$this->data['ap_returnurl'] = HTTPS_SERVER . 'index.php?route=checkout/success';
		
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
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/sohapay.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/payment/sohapay.tpl';
		} else {
			$this->template = 'default/template/payment/sohapay.tpl';
		}		
		
		$this->render();
	}
	
	public function callback() {
		if (isset($this->request->post['ap_securitycode']) && ($this->request->post['ap_securitycode'] == $this->config->get('sohapay_security'))) {
			$this->load->model('checkout/order');
			$this->model_checkout_order->confirm($this->request->post['ap_itemcode'], $this->config->get('sohapay_order_status_id'));
		}
	}
}
?>