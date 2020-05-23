<?php

namespace Elite\RedirectLogout\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Redirect extends AbstractDb
{

    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('elite_redirect_logout', '');
    }
}
