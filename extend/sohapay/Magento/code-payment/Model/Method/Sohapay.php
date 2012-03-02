<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Payment
 * @copyright   Copyright (c) 2010 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


class Mage_Payment_Model_Method_Sohapay extends Mage_Payment_Model_Method_Abstract
{

    protected $_code  = 'sohapay';
    protected $_formBlockType = 'payment/form_sohapay';
    protected $_infoBlockType = 'payment/info_sohapay';

    /**
     * Assign data to info model instance
     *
     * @param   mixed $data
     * @return  Mage_Payment_Model_Method_Checkmo
     */
    public function assignData($data)
    {
        $details = array();
        if ($this->getPayableTo()) {
            $details['payable_to'] = $this->getPayableTo();
        }
    	if($this->getMerchantSite()){
        	$details['merchantID']=$this->getMerchantSite();
        }
        if($this->getSecureCode()){
        	$details['secure_code']=$this->getSecureCode();
        }
    	if($this->getNameStore()){
        	$details['name_store']=$this->getNameStore();
        }
        if ($this->getMailingAddress()) {
            $details['mailing_address'] = $this->getMailingAddress();
        }
        if ($this->getReturnUrl()){
        	$details['return_url']=$this->getReturnUrl();
        }
        if (!empty($details)) {
            $this->getInfoInstance()->setAdditionalData(serialize($details));
        }
        return $this;
    }

    public function getPayableTo()
    {
        return $this->getConfigData('payable_to');
    }

    public function getMailingAddress()
    {
        return $this->getConfigData('mailing_address');
    }
    
	public function getMerchantSite()
    {
    	return $this->getConfigData('merchantID');
    }
    public function getSecureCode()
    {
    	return $this->getConfigData('secure_code');
    }
	public function getNameStore()
    {
    	return $this->getConfigData('name_store');
    }
    
    public function getReturnUrl()
    {
       return $this->getConfigData('return_url');
    }
}
