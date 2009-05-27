<?php
/**
 * Class for Quickpay <www.quickpay.dk> online payments with html template
 * 
 * @author sune jensen <sj@sunet.dk>
 * @version 0.0.1
 * @package Payment_Authorize_Provider_Quickpay
 * @category Payment
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */

/**
 * Class for <www.quickpay.dk> online payments with html template
 * 
 * @author sune jensen <sj@sunet.dk>
 * @version 0.0.1
 * @package Payment_Authorize_Provider_Quickpay
 * @category Payment
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */
class Ilib_Payment_Authorize_Provider_Quickpay extends Ilib_Payment_Authorize_Provider
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
            $this->prepare = new Ilib_Payment_Authorize_Provider_Quickpay_Prepare(
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
    
    /**
     * Post form object
     * 
     * @param integer $order_number order number
     * @param float $amount amount
     * @param string $currency currency
     * @param string $language 2 letter languagage
     * @param string $okpage url to ok page
     * @param string $errorpage url to error page
     * @param string $resultpage url to result page
     * @param array $get_vars GET vars
     * @param array $post_vars POST vars
     * @return object post form
     */
    public function getForm($order_number, $amount, $currency, $language, $okpage, $errorpage, $resultpage, $get_vars, $post_vars)
    {
        if(!isset($this->form)) {
            $this->form = new Ilib_Payment_Authorize_Provider_Quickpay_Form($this->getMerchant(), $this->getVerificationKey(), $order_number, $amount, $currency, $language, $okpage, $errorpage, $resultpage, $get_vars, $post_vars);
        }
        
        return $this->form;
    }
    
    /**
     * Returns post process object 
     * 
     * @param array $get
     * @param array $post
     * @param array $session
     * @param array $payment_target
     * @return object
     */
    public function getPostProcess($get, $post, $session, $payment_target)
    {
        if(!isset($this->post_process)) {
            $this->post_process = new Ilib_Payment_Authorize_Provider_Quickpay_PostProcess(
                $this->getMerchant(), 
                $this->getVerificationKey(),
                $get, 
                $post, 
                $session, 
                $payment_target
            );
        }
        
        return $this->post_process;
    }
    
    /**
     * Returns false as redirect url to payment page.
     * 
     * @param $identifier payment identifier
     * @param $receipt_url the url to the receipt page
     * @return string url
     */
    public function getRedirectUrlToPayment($order_identifier, $receipt_url)
    {
        return false;
        
    }
    
    
}