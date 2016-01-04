<?php

/**
 * Exact target Tracking Data
 *
 * @category   ProxiBlue
 * @package    ProxiBlue_ExactTarget
 * @author     Lucas van Staden (sales@proxiblue.com.au)
 * @copyright  2014 Lucas van Staden / ProxiBlue
 */
class ProxiBlue_ExactTarget_Block_Success extends ProxiBlue_ExactTarget_Block_Abstract
{

    /**
     * This trackers config key
     *
     * @var string
     */
    protected $_configKey = 'success';

    public function _construct()
    {
        $order = Mage::getSingleton("sales/order")->load(Mage::getSingleton("checkout/session")->getLastOrderId());
        if (is_object($order)) {
            $this->setData($order->getData());
            $this->setOrderItems($order->getAllItems());
            $this->setPaymentMethod($order->getPayment()->getMethodInstance()->getCode());
        }
    }

    /**
     * This trackers custom track data
     *
     * @return bool|string
     */
    public function getTrackData()
    {
        $items = array();
        foreach ($this->getOrderItems() as $item) {
            $items[] = array('item'     => $item->getSku(),
                             'quantity' => $item->getQtyOrdered(),
                             'price'    => $item->getPrice()
            );
        }
        return json_encode($items);

        return false;
    }

    public function getTrackType()
    {
        return "trackConversion";
    }

    public function hasAlreadyTracked(){
        return false;
    }

}
