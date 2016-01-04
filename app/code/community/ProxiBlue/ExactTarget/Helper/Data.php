<?php
/**
 * Exact target Tracking Data
 *
 * @category   ProxiBlue
 * @package    ProxiBlue_ExactTarget
 * @author     Lucas van Staden (sales@proxiblue.com.au)
 * @copyright  2014 Lucas van Staden / ProxiBlue
 */
class ProxiBlue_ExactTarget_Helper_Data extends Mage_Core_Helper_Abstract {

    public function getConnectUrl()
    {
        return '//' . $this->getAccountId() . '.' . mage::getStoreConfig('exacttarget/options/connect_url');
    }

    public function getConversionUrl()
    {
        return mage::getStoreConfig('exacttarget/tracking/conversion_url');
    }

    public function getAccountId()
    {
        return mage::getStoreConfig('exacttarget/options/account_id');
    }

    public function isEnabled(){
        return Mage::getStoreConfig('exacttarget/options/enabled_tracking');
    }

    public function isTrackingEnabled($type){
        return Mage::getStoreConfig('exacttarget/tracking/enable_' . $type);
    }
}