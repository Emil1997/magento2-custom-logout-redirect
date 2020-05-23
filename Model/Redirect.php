<?php

namespace Elite\RedirectLogout\Model;

use Magento\Framework\Model\AbstractModel;

class Redirect extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('Elite\RedirectLogout\Model\ResourceModel\Redirect');
    }
}
