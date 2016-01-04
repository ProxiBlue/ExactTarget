<?php

/**
 * Exact target Tracking Data
 *
 * @category   ProxiBlue
 * @package    ProxiBlue_ExactTarget
 * @author     Lucas van Staden (sales@proxiblue.com.au)
 * @copyright  2014 Lucas van Staden / ProxiBlue
 */
class ProxiBlue_ExactTarget_Block_Cart extends ProxiBlue_ExactTarget_Block_Abstract
{

    /**
     * This trackers config key
     *
     * @var string
     */
    protected $_configKey = 'cart';

    /**
     * This trackers custom track data
     *
     * The data is injected to session during add to cart via observer event
     * checkout_cart_product_add_after
     *
     * @see ProxiBlue_ExactTarget_Model_Observer::checkout_cart_product_add_after
     *
     * @return bool|string
     */
    public function getTrackData()
    {

        $items = $this->getStashedTrackData();
        if (is_array($items) && count($items) > 0) {
            $data = json_encode($items);
            Mage::getSingleton('checkout/session')->setExactTargetTracking(false);
            return $data;
        }

        return false;
    }

    public function getTrackType() {
        $items = $this->getStashedTrackData();
        if(!is_array($items) || count($items) == 0) {
            return parent::getTrackType();
        }
        return "trackCart";
    }

    public function getStashedTrackData(){
        return Mage::getSingleton('checkout/session')->getExactTargetTracking();
    }



}