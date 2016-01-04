<?php

/**
 * Exact target Tracking Data
 *
 * @category   ProxiBlue
 * @package    ProxiBlue_ExactTarget
 * @author     Lucas van Staden (sales@proxiblue.com.au)
 * @copyright  2014 Lucas van Staden / ProxiBlue
 */
class ProxiBlue_ExactTarget_Block_Default extends ProxiBlue_ExactTarget_Block_Abstract
{

    /**
     * Default uses global enable/disable
     *
     * @return int|mixed
     */
    public function isEnabled()
    {
        return Mage::helper('proxiblue_exacttarget')->isEnabled();
    }

    public function isUserLoggedIn()
    {
        return Mage::getSingleton('customer/session')->isLoggedIn();
    }

    public function getCustomerName()
    {
        return Mage::getSingleton('customer/session')->getCustomer()->getFirstname();
    }

    public function getCustomerEmail()
    {
        return Mage::getSingleton('customer/session')->getCustomer()->getEmail();
    }

    public function getCustomerLastName()
    {
        return Mage::getSingleton('customer/session')->getCustomer()->getLastname();
    }

    public function addUserData()
    {
        return true;
    }

}