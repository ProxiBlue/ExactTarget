<?php

/**
 * Exact target Tracking Data
 *
 * @category   ProxiBlue
 * @package    ProxiBlue_ExactTarget
 * @author     Lucas van Staden (sales@proxiblue.com.au)
 * @copyright  2014 Lucas van Staden / ProxiBlue
 */
class ProxiBlue_ExactTarget_Model_Observer
{

    /**
     * Inject a new handle for exact target to render its default tracking last.
     *
     * @param $observer
     *
     * @return $this
     */
    public function controller_action_layout_load_before($observer)
    {
        try {
            /** @var $layout Mage_Core_Model_Layout */
            $layout = $observer->getEvent()->getLayout();
            $layout->getUpdate()->addHandle('exacttarget_tracking');
        } catch (Exception $e) {
            mage::logException($e);
        }

        return $this;
    }

    /**
     * Intercept every request, and test if this was a link in from ET
     *
     * @param $observer
     */
    public function controller_front_send_response_before($observer)
    {
        if (Mage::getStoreConfig('exacttarget/tracking/enable_conversion')) {
            $request = $observer->getFront()->getAction()->getRequest();
            $params = $request->getParams();
            #ref: https://help.exacttarget.com/en/documentation/exacttarget/content/conversion_tracking/
            if (0 === count(array_diff(['mid', 'j', 'sfmc_sub', 'l', 'u', 'jb'], array_keys($params)))) {
                Mage::getSingleton('checkout/session')->setExactTargetConversionTracking($params);
            }
        }

    }


    /**
     * Inject the tracking data to session during add to cart
     *
     * @param $observer
     *
     * @return $this
     */
    public function checkout_cart_product_add_after($observer)
    {
        try {
            $product = $observer->getProduct();
            $infoBuyRequest = $product->getCustomOption('info_buyRequest');
            $buyRequest = new Varien_Object(unserialize($infoBuyRequest->getValue()));
            if (is_object($infoBuyRequest)) {
                $currentTrackedItems = Mage::getSingleton('checkout/session')->getExactTargetTracking();
                if (!is_array($currentTrackedItems)) {
                    $currentTrackedItems = array();
                }
                $currentTrackedItems[]
                    = array('item' => $product->getSku(), 'quantity' => $buyRequest->getQty(),
                            'price' => $product->getPrice()
                );


                Mage::getSingleton('checkout/session')->setExactTargetTracking($currentTrackedItems);
            }
        } catch (Exception $e) {
            mage::logException($e);
        }

        return $this;
    }

    /**
     * Inject ET conversion data into datalayer
     *
     * @param $observer
     * @return $this
     */
    public function cvm_googletagmanager_get_datalayer($observer)
    {
        if (Mage::helper('proxiblue_exacttarget')->isTrackingEnabled('conversion')) {
            $dataLayer = $observer->getDataLayer();
            $params = Mage::getSingleton('checkout/session')->getExactTargetConversionTracking();
            if (count($params) > 1) {
                $dataLayer->setExactTargetConversion($params);
                if(Mage::getSingleton('checkout/session')->getResetExactTargetConversionTracking()){
                    Mage::getSingleton('checkout/session')->setExactTargetConversionTracking(false);
                }
            }
        }
        return $this;
    }

    public function sales_order_place_after($observer)
    {
        //simply reset tracking data after sale was made.
        Mage::getSingleton('checkout/session')->setResetExactTargetConversionTracking(true);
    }

}
