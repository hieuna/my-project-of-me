<?php
class ControllerPaymentSohaPay extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('payment/sohapay');
		
		$this->document->setTitle($this->language->get('heading_title'));
    	$this->load->model('setting/setting');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->load->model('setting/setting');
			
			$this->model_setting_setting->editSetting('sohapay', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect(HTTPS_SERVER . 'index.php?route=extension/payment');
		}
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
		$this->data['entry_receiver'] = $this->language->get('entry_receiver');
		$this->data['entry_merchant'] = $this->language->get('entry_merchant');
		$this->data['entry_security'] = $this->language->get('entry_security');
		$this->data['entry_callback'] = $this->language->get('entry_callback');
		$this->data['entry_order_status'] = $this->language->get('entry_order_status');		
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		$this->data['tab_general'] = $this->language->get('tab_general');

  		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['merchant'])) {
			$this->data['error_merchant'] = $this->error['merchant'];
		} else {
			$this->data['error_merchant'] = '';
		}

 		if (isset($this->error['security'])) {
			$this->data['error_security'] = $this->error['security'];
		} else {
			$this->data['error_security'] = '';
		}
		
  		$this->document->breadcrumbs = array();

   		$this->document->breadcrumbs[] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=common/home',
       		'text'      => $this->language->get('text_home'),
      		'separator' => FALSE
   		);

   		$this->document->breadcrumbs[] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=extension/payment',
       		'text'      => $this->language->get('text_payment'),
      		'separator' => ' :: '
   		);

   		$this->document->breadcrumbs[] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=payment/sohapay',
       		'text'      => $this->language->get('heading_title'),
      		'separator' => ' :: '
   		);
				
		$this->data['action'] = HTTPS_SERVER . 'index.php?route=payment/sohapay&token=' . $this->session->data['token'];
		$this->data['cancel'] = HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token'];
		
		if (isset($this->request->post['sohapay_site_code'])) {
			$this->data['sohapay_site_code'] = $this->request->post['sohapay_site_code'];
		} else {
			$this->data['sohapay_site_code'] = $this->config->get('sohapay_site_code');
		}

		if (isset($this->request->post['sohapay_secure_secret'])) {
			$this->data['sohapay_secure_secret'] = $this->request->post['sohapay_secure_secret'];
		} else {
			$this->data['sohapay_secure_secret'] = $this->config->get('sohapay_secure_secret');
		}
		
		
		if (isset($this->request->post['sohapay_receiver'])) {
			$this->data['sohapay_receiver'] = $this->request->post['sohapay_receiver'];
		} else {
			$this->data['sohapay_receiver'] = $this->config->get('sohapay_receiver');
		}
		
		$this->data['callback'] = HTTP_CATALOG . 'index.php?route=payment/sohapay/callback';
		
		if (isset($this->request->post['sohapay_order_status_id'])) {
			$this->data['sohapay_order_status_id'] = $this->request->post['sohapay_order_status_id'];
		} else {
			$this->data['sohapay_order_status_id'] = $this->config->get('sohapay_order_status_id'); 
		} 
		
		$this->load->model('localisation/order_status');
		
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
	
		if (isset($this->request->post['sohapay_status'])) {
			$this->data['sohapay_status'] = $this->request->post['sohapay_status'];
		} else {
			$this->data['sohapay_status'] = $this->config->get('sohapay_status');
		}
		
		if (isset($this->request->post['sohapay_sort_order'])) {
			$this->data['sohapay_sort_order'] = $this->request->post['sohapay_sort_order'];
		} else {
			$this->data['sohapay_sort_order'] = $this->config->get('sohapay_sort_order');
		}
		
		$this->template = 'payment/sohapay.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/sohapay')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if (!$this->request->post['sohapay_site_code']) {
			$this->error['sohapay_site_code'] = $this->language->get('error_merchant');
		}

		if (!$this->request->post['sohapay_secure_secret']) {
			$this->error['sohapay_secure_secret'] = $this->language->get('error_security');
		}
		
		
		if (!$this->request->post['sohapay_receiver']) {
			$this->error['sohapay_receiver'] = $this->language->get('error_receiver');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
}
?>