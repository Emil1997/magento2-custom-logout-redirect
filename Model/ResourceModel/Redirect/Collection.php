<?php

namespace Elite\RedirectLogout\Model\ResourceModel\Redirect;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Elite\RedirectLogout\Model\Redirect',
            'Prince\RedirectLogout\Model\ResourceModel\Redirect'
        );
    }
}
