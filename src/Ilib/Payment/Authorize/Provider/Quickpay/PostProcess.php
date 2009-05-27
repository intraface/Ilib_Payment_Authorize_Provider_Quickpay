<?php
/**
 * Postprocess Quickpay <www.quickpay.dk> online payments with html template
 * 
 * @author sune jensen <sj@sunet.dk>
 * @version 0.0.1
 * @package Payment_Authorize_Provider_Quickpay
 * @category Payment
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */

/**
 * Postprocess Quickpay <www.quickpay.dk> online payments with html template
 * 
 * @author sune jensen <sj@sunet.dk>
 * @version 0.0.1
 * @package Payment_Authorize_Provider_Quickpay
 * @category Payment
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */
class Ilib_Payment_Authorize_Provider_Quickpay_PostProcess extends Ilib_Payment_Authorize_PostProcess
{
    /**
     * Contructor
     * 
     * @param string $merchant merchant number
     * @param string $language the language used in the payment
     * 
     * @return void
     */
    public function __construct($merchant, $verification_key, $get, $post, $session, $payment_target)
    {    
        parent::__construct($merchant, $verification_key, $get, $post, $session, $payment_target);
        
        
        $payment_vars = array('msgtype', 'ordernumber', 'amount', 'currency', 'time', 'state', 'qpstat', 'qpstatmsg' , 'chstat', 'chstatmsg', 'merchant', 'merchantemail', 'transaction', 'cardtype', 'cardnumber');
        $md5_string = '';

        foreach ($payment_vars as $var) {
            if (!isset($post[$var]) ) {
                throw new Exception('the value '.$var.' is missing!');
            }
            $md5_string .= $post[$var];
        }
        
        if ($post['chstat'] != '000' && !isset($post['transaction'])) {
            $post['transaction'] = 0;
        }

        $md5_string .= $this->getVerificationKey();

        if (empty($post['md5check']) || $post['md5check'] != md5($md5_string)) {
            throw new Exception('Check for md5 value failed!');
        }
        
        $this->amount = ($post['amount']/100);
        $this->order_number = $post['ordernumber'];
        $this->pbs_status = $post['chstat'];
        $this->transaction_number = $post['transaction'];
        $this->transaction_status = $post['qpstat'];
        $this->currency = $post['currency'];
        
        foreach ($post as $key => $optional) {
            if (substr($key, 0, 7) == 'CUSTOM_') {
                $this->optional_values[substr($key, 7)] = $optional;
            }
        }
        
    } 
}