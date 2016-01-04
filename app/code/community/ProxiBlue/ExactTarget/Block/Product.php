<?php

/**
 * Exact target Tracking Data
 *
 * @category   ProxiBlue
 * @package    ProxiBlue_ExactTarget
 * @author     Lucas van Staden (sales@proxiblue.com.au)
 * @copyright  2014 Lucas van Staden / ProxiBlue
 */
class ProxiBlue_ExactTarget_Block_Product extends ProxiBlue_ExactTarget_Block_Abstract
{

    /**
     * This trackers config key
     *
     * @var string
     */
    protected $_configKey = 'product';

    /**
     * This trackers custom track data
     *
     * @return bool|string
     */
    public function getTrackData()
    {
        $currentProduct = mage::registry('current_product');
        if (is_object($currentProduct)) {
            $data = array('item' => trim($currentProduct->getSku()));

            return json_encode($data);
        }

        return false;
    }

}