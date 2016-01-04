<?php

/**
 * Exact target Tracking Data
 *
 * @category   ProxiBlue
 * @package    ProxiBlue_ExactTarget
 * @author     Lucas van Staden (sales@proxiblue.com.au)
 * @copyright  2014 Lucas van Staden / ProxiBlue
 */
class ProxiBlue_ExactTarget_Block_Category extends ProxiBlue_ExactTarget_Block_Abstract
{

    /**
     * This trackers config key
     *
     * @var string
     */
    protected $_configKey = 'category';

    /**
     * This trackers custom track data
     *
     * @return bool|string
     */
    public function getTrackData()
    {
        $currentCategory = mage::registry('current_category');
        if (is_object($currentCategory)) {
            $data = array('category' => trim($currentCategory->getName()));

            return json_encode($data);
        }

        return false;
    }

}