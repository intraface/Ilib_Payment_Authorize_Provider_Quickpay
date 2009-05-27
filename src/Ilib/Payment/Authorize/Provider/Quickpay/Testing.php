<?php
/**
 * Testing of Quickpay <www.quickpay.dk> online payments with html template
 * 
 * @author sune jensen <sj@sunet.dk>
 * @version 0.0.1
 * @package Payment_Authorize_Provider_Quickpay
 * @category Payment
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */

/**
 * Testing of <www.quickpay.dk> online payments with html template
 * 
 * @author sune jensen <sj@sunet.dk>
 * @version 0.0.1
 * @package Payment_Authorize_Provider_Quickpay
 * @category Payment
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */
class Ilib_Payment_Authorize_Provider_Quickpay_Testing extends Ilib_Payment_Authorize_Provider_Quickpay
{
    
    
    /**
     * Constuctor
     * @param string $merchant
     * @param string $verification_key
     * @return void
     */
    public function __construct($merchant, $verification_key)
    {
        parent::__construct($merchant, $verification_key);
    }
    
    /**
     * Prepare object
     * 
     * @param string $order_identifier order identifier
     * @param integer $order_number order number
     * @param float $amount amount
     * @param string $currency currency
     * @param string $language 2 letter languagage
     * @param string $okpage url to ok page
     * @param string $errorpage url to error page
     * @param string $resultpage url to result page
     * @param string $inputpage url to input page
     * @param array $get_var GET vars
     * @param array $post_vars POST vars
     * @return object prepare
     */
    public function getPrepare($order_identifier, $order_number, $amount, $currency, $language, $okpage, $errorpage, $resultpage, $inputpage, $get_vars, $post_vars)
    {
        if(!isset($this->prepare)) {
            $this->prepare = new Ilib_Payment_Authorize_Provider_Quickpay_Testing_Prepare(
                $this->getMerchant(), 
                $this->getVerificationKey(), 
                $order_identifier,
                $order_number, 
                $amount, 
                $currency, 
                $language, 
                $okpage, 
                $errorpage, 
                $resultpage,
                $inputpage, 
                $get_vars,
                $post_vars
            );
        }
        
        return $this->prepare;
    } 
}