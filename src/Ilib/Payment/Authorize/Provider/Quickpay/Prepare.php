<?php
/**
 * Prepares Quickpay <www.quickpay.dk> online payments with html template
 * 
 * @author sune jensen <sj@sunet.dk>
 * @version 0.0.1
 * @package Payment_Authorize_Provider_Quickpay
 * @category Payment
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */

/**
 * Prepares Quickpay <www.quickpay.dk> online payments with html template
 * 
 * @author sune jensen <sj@sunet.dk>
 * @version 0.0.1
 * @package Payment_Authorize_Provider_Quickpay
 * @category Payment
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */
class Ilib_Payment_Authorize_Provider_Quickpay_Prepare extends Ilib_Payment_Authorize_Prepare
{
    
    /**
     * @var $testing 
     */
    protected $testing = 0;
    
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
        parent::__construct($merchant, $verification_key, $order_identifier, $order_number, $amount, $currency, $language, $okpage, $errorpage, $resultpage, $inputpage, $get_vars, $post_vars);
    }
    
    /**
     * prepares the payment values into the fields
     *  
     * @return string post fields
     */
    public function getHiddenFields() 
    {
        $order_number = $this->order_number;
        if(strlen($order_number) < 4) {
                $order_number = str_repeat('0', 4-strlen($order_number)).$order_number;
        }
        
        $amount = $this->amount * 100;
        
        $language = $this->language;
        if($language == 'DK') { /* language should never be DK! */
            $language = 'da';
        }
        
        $md5_check = md5(
            '3'.  /* protocol */
            'authorize'. /* msgtype */
            $this->merchant. /* merchant */
            $language. /* language */
            $order_number. /* ordernumber */
            $amount. /* amount */
            $this->currency. /* currency */
            $this->okpage. /* continueurl */
            $this->errorpage. /* cancelurl */
            $this->resultpage. /* callbackurl */
            '0'. /* autocapture */
            ''. /* cardtypelock */
            ''. /* description */
            ''. /* ipaddress */
            $this->testing. /* testmode */
            $this->getVerificationKey() /* secret */
       );
        
        $fields = '<input type="hidden" name="protocol" value="3" />'. 
            '<input type="hidden" name="msgtype" value="authorize" />'.
            '<input type="hidden" name="merchant" value="'.$this->merchant.'" />'.
            '<input type="hidden" name="language" value="'.$language.'" />'.
            '<input type="hidden" name="ordernumber" value="'.$order_number.'" />'.   
            '<input type="hidden" name="amount" value="'.$amount.'" />'.
            '<input type="hidden" name="currency" value="'.$this->currency.'" />'.
            '<input type="hidden" name="continueurl" value="'.$this->okpage.'" />'.
            '<input type="hidden" name="cancelurl" value="'.$this->errorpage.'" />'.
            '<input type="hidden" name="callbackurl" value="'.$this->resultpage.'" />'.
            '<input type="hidden" name="autocapture" value="0" />'.
            '<input type="hidden" name="testmode" value="'.$this->testing.'" />'. 
            '<input type="hidden" name="md5check" value="'.$md5_check.'" />';
        
        return $fields;
    }
    
    /**
     * Returns the form action
     * 
     * @return string form action
     */
    public function getAction()
    {
        return 'https://secure.quickpay.dk/form/';
    }
    
    /**
     * Returns the name of the provider. Needs to be overridden in extends.
     * 
     * @return string name of provider
     */
    public function getProviderName()
    {
        return 'Quickpay';
    }
    
    /**
     * Returns error message
     * @return string error message
     */
    public function getErrorMessage()
    {
        if(isset($this->get_vars['error'])) {
            return ''; /* possible message */
        }
        
        return '';
    }
}