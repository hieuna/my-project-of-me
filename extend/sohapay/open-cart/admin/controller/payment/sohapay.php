<?php
class ControllerPaymentsohapay extends Controller {
	  private $error = array(); 
	  public function index() {
	  $this->load->language('payment/sohapay');
	  $this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');
	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('sohapay', $this->request->post);				
			$this->session->data['success'] = $this->language->get('text_success');
			$this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}
	  $this->data['heading_title']  		= $this->language->get('heading_title');
	  $this->data['text_enabled']   		= $this->language->get('text_enabled');
	  $this->data['text_disabled']  		= $this->language->get('text_disabled');
	  $this->data['entry_receiver'] 		= $this->language->get('entry_receiver');
	  $this->data['entry_site_code'] 		= $this->language->get('entry_site_code');
	  $this->data['entry_secure_secret'] 	= $this->language->get('entry_secure_secret');
	  $this->data['entry_return_url'] 		= $this->language->get('entry_return_url');
      $this->data['entry_order_status'] 	= $this->language->get('entry_order_status');		
	  $this->data['entry_status'] 			= $this->language->get('entry_status');
	  $this->data['entry_sort_order'] 		= $this->language->get('entry_sort_order');
	  $this->data['button_save'] 			= $this->language->get('button_save');
	  $this->data['button_cancel'] 			= $this->language->get('button_cancel');
	  $this->data['tab_general'] 			= $this->language->get('tab_general');
  if (isset($this->error['warning'])) {
		  $this->data['error_warning'] = $this->error['warning'];
		  } else {
		  $this->data['error_warning'] = '';
		  }
		  if (isset($this->error['receiver'])) {
		  $this->data['error_receiver'] = $this->error['receiver'];
		  } else {
		  $this->data['error_receiver'] = '';
		  }
		  
	  	if (isset($this->error['site_code'])) {
		  $this->data['error_site_code'] = $this->error['site_code'];
		  } else {
		  $this->data['error_site_code'] = '';
		}
	  	if (isset($this->error['site_secure_secret'])) {
		  $this->data['error_secure_secret'] = $this->error['site_secure_secret'];
		  } else {
		  $this->data['error_secure_secret'] = '';
		}
	  if (isset($this->error['site_return_url'])) {
		  $this->data['error_return_url'] = $this->error['site_return_url'];
		  } else {
		  $this->data['error_return_url'] = '';
		}
		  
			$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/sohapay', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
		$this->data['action'] = $this->url->link('payment/sohapay', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');
		if (isset($this->request->post['sohapay_total'])) {
			$this->data['sohapay_total'] = $this->request->post['sohapay_total'];
		} else {
			$this->data['sohapay_total'] = $this->config->get('sohapay_total'); 
		}	
	
	  if (isset($this->request->post['sohapay_receiver'])) {
	  $this->data['sohapay_receiver'] = $this->request->post['sohapay_receiver'];
	  } else {
	  $this->data['sohapay_receiver'] = $this->config->get('sohapay_receiver');
	  }
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
	  if (isset($this->request->post['sohapay_return_url'])) {
	  $this->data['sohapay_return_url'] = $this->request->post['sohapay_return_url'];
	  } else {
	  $this->data['sohapay_return_url'] = $this->config->get('sohapay_return_url');
	  }
	  if (isset($this->request->post['sohapay_order_status_id'])) {
	  $this->data['sohapay_order_status_id'] = $this->request->post['sohapay_order_status_id'];
	  } else {
	  $this->data['sohapay_order_status_id'] = $this->config->get('sohapay_order_status_id'); 
	  }  
  	$this->data['callback'] = HTTP_CATALOG . 'index.php?route=payment/sohapay/callback';
  
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
			'common/footer',
		);
				
		$this->response->setOutput($this->render());
	}
  private function validate() {
	  if (!$this->user->hasPermission('modify', 'payment/sohapay')) {
	  $this->error['warning'] = $this->language->get('error_permission');
	  }	
	  if (!$this->request->post['sohapay_receiver']) {
	  $this->error['receiver'] = $this->language->get('error_receiver');
	  }
	if (!$this->error) {
			return true;
		} else {
			return false;
		}		
  }
}
?>