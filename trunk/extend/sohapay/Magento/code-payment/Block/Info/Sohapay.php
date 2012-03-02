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


class Mage_Payment_Block_Info_Sohapay extends Mage_Payment_Block_Info
{

    protected $_payableTo;
    protected $_merchantID;
    protected $_secure_code;
    protected $_name_store;
    protected $_mailingAddress;
    protected $_return_url;
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('payment/info/sohapay.phtml');
    }

    /**
     * Enter description here...
     *
     * @return string
     */
    public function getPayableTo()
    {
        if (is_null($this->_payableTo)) {
            $this->_convertAdditionalData();
        }
        return $this->_payableTo;
    }

    /**
     * Enter description here...
     *
     * @return string
     */
	public function getMerchantSite()
    {
    	if (is_null($this->_merchantID)) {
            $this->_convertAdditionalData();
        }
        return $this->_merchantID;
    }
    public function getSecureCode()
    {
    	if (is_null($this->_secure_code)) {
            $this->_convertAdditionalData();
        }
        return $this->_secure_code;
    }
	public function getNameStore()
    {
    	if (is_null($this->_name_store)) {
            $this->_convertAdditionalData();
        }
        return $this->_name_store;
    }
    public function getMailingAddress()
    {
        if (is_null($this->_mailingAddress)) {
            $this->_convertAdditionalData();
        }
        return $this->_mailingAddress;
    }
     public function getReturnUrl()
    {
        if (is_null($this->_return_url)) {
            $this->_convertAdditionalData();
        }
        return $this->_return_url;
    }
    /**
     * Enter description here...
     *
     * @return Mage_Payment_Block_Info_Checkmo
     */
    protected function _convertAdditionalData()
    {
        $details = @unserialize($this->getInfo()->getAdditionalData());
        if (is_array($details)) {
            $this->_payableTo = isset($details['payable_to']) ? (string) $details['payable_to'] : '';
            $this->_merchantID = isset($details['_merchantID']) ? (string) $details['_merchantID'] : '';
            $this->_secure_code = isset($details['_secure_code']) ? (string) $details['_secure_code'] : '';
            $this->_name_store = isset($details['_name_store']) ? (string) $details['_name_store'] : '';
            $this->_mailingAddress = isset($details['mailing_address']) ? (string) $details['mailing_address'] : '';
             $this->_return_url = isset($details['return_url']) ? (string) $details['return_url'] : '';
        } else {
            $this->_payableTo = '';
            $this->_merchantID = '';
            $this->_secure_code = '';
            $this->_name_store = '';
            $this->_mailingAddress = '';
            $this->_return_url='';
        }
        return $this;
    }
    
    public function toPdf()
    {
        $this->setTemplate('payment/info/pdf/sohapay.phtml');
        return $this->toHtml();
    }

}
