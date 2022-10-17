# Swift Core
Swift core module

## How to Use
Add these codes to desired features on other modules, the samples below use plugin to add the codes.
1. Controller
Add these dependencies
```
public function __construct(
    \Swift\Core\Helper\Data $data,
    \Magento\Framework\UrlInterface $url,
    \Magento\Framework\App\ResponseFactory $responseFactory,
    \Magento\Framework\Message\ManagerInterface $messageManager
) {
    $this->data = $data;
    $this->url = $url;
    $this->responseFactory = $responseFactory;
    $this->messageManager = $messageManager;
}
```
Then add this code to the start of execute method
```
if (!$this->data->isLicenseValid($this->data->getLicense())) {
    $this->messageManager->addError(__('License is not valid.'));
    
    $redirectionUrl = $this->url->getUrl('customer/account/login');
    $this->responseFactory->create()->setRedirect($redirectionUrl)->sendResponse();
    exit;
}
```
2. GraphQl
Add this dependency
```
public function __construct(
    \Swift\Core\Helper\Data $data
) {
    $this->data = $data;
}
```
Then add this code to the start of resolve method
```
if (!$this->data->isLicenseValid($this->data->getLicense())) {
    throw new \Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException(__('License is not valid.'));
}
```

## How to Obfuscate Code (Helper)
1. Install [YAK Pro - Php Obfuscator](https://github.com/pk-fr/yakpro-po "YAK Pro - Php Obfuscator") on your machine
2. Configure yakpro-po.cnf
```
$conf->obfuscate_constant_name          = false;         // self explanatory
$conf->obfuscate_variable_name          = true;         // self explanatory
$conf->obfuscate_function_name          = true;         // self explanatory
$conf->obfuscate_class_name             = false;         // self explanatory
$conf->obfuscate_interface_name         = true;         // self explanatory
$conf->obfuscate_trait_name             = true;         // self explanatory
$conf->obfuscate_class_constant_name    = false;         // self explanatory
$conf->obfuscate_property_name          = true;         // self explanatory
$conf->obfuscate_method_name            = false;         // self explanatory
$conf->obfuscate_namespace_name         = false;         // self explanatory
$conf->obfuscate_label_name             = true;         // label: , goto label;  obfuscation
$conf->obfuscate_if_statement           = true;         // obfuscation of  if else elseif statements
$conf->obfuscate_loop_statement         = true;         // obfuscation of  for while do while statements
$conf->obfuscate_string_literal         = true;         // pseudo-obfuscation of  string literals
```
3. 
```
yakpro-po app/code/Swift/Core/Helper/Data.php -o app/code/Swift/Core/Helper/ObfuscatedData.php
```
This will generate a new obfuscated file (ObfuscatedData.php)
4. Backup the original Data.php and rename ObfuscatedData.php to Data.php to replace Data.php

## How to Obfuscate Code (Plugin Implementation)
1. Copy the if statement and its content to [Simple online PHP obfuscator](https://www.mobilefish.com/services/php_obfuscator/php_obfuscator.php "Simple online PHP obfuscator") and encode it
2.  Replace the original if statement and its content with the obfuscated code