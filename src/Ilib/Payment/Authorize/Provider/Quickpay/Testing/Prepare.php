<?php
/**
 * Testing for preparing of Quickpay <www.quickpay.dk> online payments with html template
 * 
 * @author sune jensen <sj@sunet.dk>
 * @version 0.0.1
 * @package Payment_Authorize_Provider_Quickpay
 * @category Payment
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */

/**
 * Testing for preparing of <www.quickpay.dk> online payments with html template
 * 
 * @author sune jensen <sj@sunet.dk>
 * @version 0.0.1
 * @package Payment_Authorize_Provider_Quickpay
 * @category Payment
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */
class Ilib_Payment_Authorize_Provider_Quickpay_Testing_Prepare extends Ilib_Payment_Authorize_Provider_Quickpay_Prepare
{
    
    /**
     * Contructor
     * 
     * @param string $merchant
     * @param string $verification_key
     * @param string $order_identifier
     * @param integer $order_number
     * @param float $amount
     * @param string $currency
     * @param string $language
     * @param string $okpage
     * @param string $errorpage
     * @param string $resultpage
     * @param string $inputpage
     * @param array $get_vars
     * @param array $post_vars
     * @param string $secure_url
     * @return void
     */
    public function __construct($merchant, $verification_key, $order_identifier, $order_number, $amount, $currency, $language, $okpage, $errorpage, $resultpage, $inputpage, $get_vars, $post_vars)
    {
        $this->testing = 1;
        parent::__construct($merchant, $verification_key, $order_identifier, $order_number, $amount, $currency, $language, $okpage, $errorpage, $resultpage, $inputpage, $get_vars, $post_vars);
    }
    
    /**
     * Returns the name of the provider. Needs to be overridden in extends.
     * 
     * @return string name of provider
     */
    public function getProviderName()
    {
        return 'Quickpay (Only Testing)';
    }
}