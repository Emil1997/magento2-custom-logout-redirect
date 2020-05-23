<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Elite\RedirectLogout\Controller\Account;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Stdlib\Cookie\CookieMetadataFactory;
use Magento\Framework\Stdlib\Cookie\PhpCookieManager;
use Magento\Customer\Controller\AbstractAccount;
use Elite\RedirectLogout\Helper\Data as HelperData;

/**
 * Sign out a customer.
 */
class Logout extends AbstractAccount implements HttpGetActionInterface, HttpPostActionInterface
{
    /**
     * @var Session
     */
    protected $session;
    protected $helperData;

    /**
     * @var CookieMetadataFactory
     */
    private $cookieMetadataFactory;

    /**
     * @var PhpCookieManager
     */
    private $cookieMetadataManager;

    /**
     * @param Context $context
     * @param Session $customerSession
     * @param HelperData $helperData
     */
    public function __construct(
        Context $context,
        Session $customerSession,
        HelperData $helperData
    ) {
        $this->session = $customerSession;
        $this->helperData = $helperData;
        parent::__construct($context);
    }

    /**
     * Retrieve cookie manager
     *
     * @deprecated 100.1.0
     * @return PhpCookieManager
     */
    private function getCookieManager()
    {
        if (!$this->cookieMetadataManager) {
            $this->cookieMetadataManager = ObjectManager::getInstance()->get(PhpCookieManager::class);
        }
        return $this->cookieMetadataManager;
    }

    /**
     * Retrieve cookie metadata factory
     *
     * @deprecated 100.1.0
     * @return CookieMetadataFactory
     */
    private function getCookieMetadataFactory()
    {
        if (!$this->cookieMetadataFactory) {
            $this->cookieMetadataFactory = ObjectManager::getInstance()->get(CookieMetadataFactory::class);
        }
        return $this->cookieMetadataFactory;
    }

    /**
     * Customer logout action
     *
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $lastCustomerId = $this->session->getId();
        $this->session->logout()->setBeforeAuthUrl($this->_redirect->getRefererUrl())
            ->setLastCustomerId($lastCustomerId);
        if ($this->getCookieManager()->getCookie('mage-cache-sessid')) {
            $metadata = $this->getCookieMetadataFactory()->createCookieMetadata();
            $metadata->setPath('/');
            $this->getCookieManager()->deleteCookie('mage-cache-sessid', $metadata);
        }

        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        /** get enabled | not enabled value from backend & url value */

        $enabled = $this->helperData->getGeneralConfig('enable');
        $url = stripslashes($this->helperData->getGeneralConfig('url'));
        $url = str_replace('/',' ', $url);
        $url = trim($url);

        /** @var  $objectManager */
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
        $baseUrl = $storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB);

        /** Concat url with base url */
        $url = $baseUrl.$url;

        /** if module is enabled redirect to path else redirect to default magento path */
        ($enabled == 1) ? $resultRedirect->setPath($url) : $resultRedirect->setPath('*/*/logoutSuccess');

        return $resultRedirect;
    }
}
