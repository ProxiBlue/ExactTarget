<?php

/**
 * Exact target Tracking Data
 *
 * @category   ProxiBlue
 * @package    ProxiBlue_ExactTarget
 * @author     Lucas van Staden (sales@proxiblue.com.au)
 * @copyright  2014 Lucas van Staden / ProxiBlue
 */
class ProxiBlue_ExactTarget_Block_Abstract extends Mage_Core_Block_Template
{

    /**
     * Test if the section is enabled
     *
     * @return integer
     */
    public function isEnabled()
    {
        return Mage::helper('proxiblue_exacttarget')->isTrackingEnabled($this->_configKey);
    }

    /**
     * Allow this section to be tracked. Defaults to False
     *
     * @return bool
     */
    public function getTrackData()
    {
        return false;
    }

    /**
     * Has tracking already been done for this page request?
     *
     * @return mixed
     */
    public function hasAlreadyTracked()
    {
        return Mage::registry('exacttarget_tracking_done');
    }

    /**
     * Flag this request as tracked
     */
    public function flagHasTracked()
    {
        Mage::register('exacttarget_tracking_done', true, true);
    }

    public function getTrackType()
    {
        return "trackPageView";
    }

    public function addUserData()
    {
        return false;
    }



}