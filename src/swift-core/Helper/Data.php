<?php 
namespace Swift\Core\Helper;

use Magento\Framework\App\Helper\Context;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    public $scopeConfig;
    public $storeManager;
    
    /**
     * @param Context $context
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfigontext
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
    } 

    public function getLicense()
    {
        $license = $this->scopeConfig->getValue(
            'swift_core/general/license',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
        );

        return $license;
    }

    public function getSecretKey()
    {
        return 'IcU83S1rC10';
    }

    public function isLicenseValid($license)
    {
        if ($license == null) {
            return false;
        }
        $decryptedLicense = $this->decrypt($license, $this->getSecretKey());
        $validTo = substr($decryptedLicense, -8);
        $domain = str_replace(substr($decryptedLicense, -9), '', $decryptedLicense);

        $currentDomain = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB);
        $currentDomain = parse_url($currentDomain, PHP_URL_HOST);

        if ($currentDomain != $domain) {
            return false;
        }

        $validToDate = date_format(date_create_from_format('Ymd', $validTo), 'Ymd');
        $currentDate = date('Ymd');
        if ($currentDate > $validToDate) {
            return false;
        }

        return true;
    }

    public function decrypt($encryptedMessage, $secretKey)
    {
        $encryptedMessage = base64_decode($encryptedMessage);
        $method = "aes-128-ctr";
        $ivLength = openssl_cipher_iv_length($method);
        $iv = mb_substr($encryptedMessage, 0, $ivLength, '8bit');
        $ciphertext = mb_substr($encryptedMessage, $ivLength, null, '8bit');
        
        $decryptedMessage = openssl_decrypt($ciphertext , $method, $secretKey, 0, $iv);

        return $decryptedMessage;
    }
}