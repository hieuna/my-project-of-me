<?php
class ControllerPaymentbaokim extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('payment/baokim');

		$this->document->title = $this->language->get('heading_title');
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->load->model('setting/setting');
			
			$this->model_setting_setting->editSetting('baokim', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect(HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token']);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
		
		$this->data['entry_merchant'] = $this->language->get('entry_merchant');
		$this->data['entry_security'] = $this->language->get('entry_security');
		$this->data['entry_business'] = $this->language->get('entry_business');
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
		
		if (isset($this->error['business'])) {
			$this->data['error_business'] = $this->error['business'];
		} else {
			$this->data['error_business'] = '';
		}
		
  		$this->document->breadcrumbs = array();

   		$this->document->breadcrumbs[] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=common/home&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('text_home'),
      		'separator' => FALSE
   		);

   		$this->document->breadcrumbs[] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('text_payment'),
      		'separator' => ' :: '
   		);

   		$this->document->breadcrumbs[] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=payment/baokim&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('heading_title'),
      		'separator' => ' :: '
   		);
				
		$this->data['action'] = HTTPS_SERVER . 'index.php?route=payment/baokim&token=' . $this->session->data['token'];
		
		$this->data['cancel'] = HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token'];
		
		if (isset($this->request->post['baokim_merchant'])) {
			$this->data['baokim_merchant'] = $this->request->post['baokim_merchant'];
		} else {
			$this->data['baokim_merchant'] = $this->config->get('baokim_merchant');
		}

		if (isset($this->request->post['baokim_security'])) {
			$this->data['baokim_security'] = $this->request->post['baokim_security'];
		} else {
			$this->data['baokim_security'] = $this->config->get('baokim_security');
		}
		
		if (isset($this->request->post['baokim_business'])) {
			$this->data['baokim_business'] = $this->request->post['baokim_business'];
		} else {
			$this->data['baokim_business'] = $this->config->get('baokim_business');
		}
		
		$this->data['callback'] = HTTP_CATALOG . 'index.php?route=payment/baokim/callback';
		
		if (isset($this->request->post['baokim_order_status_id'])) {
			$this->data['baokim_order_status_id'] = $this->request->post['baokim_order_status_id'];
		} else {
			$this->data['baokim_order_status_id'] = $this->config->get('baokim_order_status_id'); 
		} 
		
		$this->load->model('localisation/order_status');
		
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['baokim_geo_zone_id'])) {
			$this->data['baokim_geo_zone_id'] = $this->request->post['baokim_geo_zone_id'];
		} else {
			$this->data['baokim_geo_zone_id'] = $this->config->get('baokim_geo_zone_id'); 
		} 

		$this->load->model('localisation/geo_zone');
										
		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['baokim_status'])) {
			$this->data['baokim_status'] = $this->request->post['baokim_status'];
		} else {
			$this->data['baokim_status'] = $this->config->get('baokim_status');
		}
		
		if (isset($this->request->post['baokim_sort_order'])) {
			$this->data['baokim_sort_order'] = $this->request->post['baokim_sort_order'];
		} else {
			$this->data['baokim_sort_order'] = $this->config->get('baokim_sort_order');
		}
		
		$this->template = 'payment/baokim.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/baokim')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['baokim_merchant']) {
			$this->error['merchant'] = $this->language->get('error_merchant');
		}

		if (!$this->request->post['baokim_security']) {
			$this->error['security'] = $this->language->get('error_security');
		}
		
		if (!$this->request->post['baokim_business']) {
			$this->error['business'] = $this->language->get('error_business');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
}
?>