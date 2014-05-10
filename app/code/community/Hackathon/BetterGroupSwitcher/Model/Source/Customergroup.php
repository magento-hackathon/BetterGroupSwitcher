<?php

class Hackathon_BetterGroupSwitcher_Model_Source_Customergroup extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{

    /**
     * Retrieve All options
     *
     * @return array
     */
    public function getAllOptions()
    {
        if (!$this->_options) {
            $this->_options = array(
                0 => '-- Please Select --',
            );
            $this->_options += Mage::getResourceModel('customer/group_collection')
                ->toOptionArray();
        }

        return $this->_options;
    }
}