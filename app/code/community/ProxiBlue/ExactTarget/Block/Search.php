<?php
/**
 * Exact target Tracking Data
 *
 * @category   ProxiBlue
 * @package    ProxiBlue_ExactTarget
 * @author     Lucas van Staden (sales@proxiblue.com.au)
 * @copyright  2014 Lucas van Staden / ProxiBlue
 */
class ProxiBlue_ExactTarget_Block_Search extends  ProxiBlue_ExactTarget_Block_Abstract
{

    /**
     * This trackers config key
     *
     * @var string
     */
    protected $_configKey = 'search';

    /**
     * Custom track data for this tracker
     *
     * @return bool|string
     */
    public function getTrackData()
    {
        $terms = $this->helper('catalogsearch')->getEscapedQueryText();
        if (is_string($terms)) {
            $data = array('search' => trim($terms));

            return json_encode($data);
        }

        return false;
    }

}