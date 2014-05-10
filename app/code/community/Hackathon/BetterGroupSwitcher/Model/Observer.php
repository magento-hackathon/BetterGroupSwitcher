<?php

class Hackathon_BetterGroupSwitcher_Model_Observer
{
    public function salesOrderSaveBefore(Varien_Event_Observer $observer)
    {
        $order = $observer->getOrder();
        $order->setOldState($order->getState());
    }

    public function salesOrderSaveAfter(Varien_Event_Observer $observer)
    {
        /* @var $order Mage_Sales_Model_Order */
        $order = $observer->getOrder();
        if ($order->getOldState() == $order->getState()) {
            // if the state is the same stop.
            return;
        }

        if ($order->getState() != Mage_Sales_Model_Order::STATE_COMPLETE) {
            // if the order is not completed stop.
            return;
        }

        $customerId = $order->getCustomerId();
        if (!$customerId) {
            // Buyer has no account, stop.
            return;
        }
        $customerGroupId = 0;
        foreach ($order->getAllItems() as $item) {
            /* @var $item Mage_Sales_Model_Order_Item */
            $product = $item->getProduct();
            $customerGroupId = $product->getAddToCustomergroup();
            if ($customerGroupId) {
                break;
            }
        }

        if ($customerGroupId) {
            /* @var $customer Mage_Customer_Model_Customer */
            $customer = Mage::getModel('customer/customer')->load($customerId);
            $customer->setGroupId($customerGroupId)->save();
        }
    }
}
