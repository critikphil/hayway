<?php

class Paypal {

    private $_params = array();
    private $_paypalUrl;
    private $_webscrUrl;
    
    private $_nbProducts = 0;
            
    function  __construct( ){
        
        global $paypalConfigs;
        
        $this->_paypalUrl = $paypalConfigs['production'] ? 'https://api-3t.paypal.com/nvp' : 'https://api-3t.sandbox.paypal.com/nvp';
        $this->_webscrUrl = $paypalConfigs['production'] ? 'https://www.paypal.com/webscr' : 'https://www.sandbox.paypal.com/webscr';
        
        $this->_params['VERSION']   = 109.0;
        $this->_params['USER']      = $paypalConfigs['user'];
        $this->_params['PWD']       = $paypalConfigs['password'];
        $this->_params['SIGNATURE'] = $paypalConfigs['signature'];
        $this->_params['HDRIMG']    = !empty($paypalConfigs['hdrImg'])  ? $paypalConfigs['hdrImg']  : '' ;
        $this->_params['LOGOIMG']   = !empty($paypalConfigs['logoImg']) ? $paypalConfigs['logoImg'] : '' ;
        
        $this->_params['PAYMENTREQUEST_0_AMT']          = 0.00;
        $this->_params['PAYMENTREQUEST_0_ITEMAMT']      = 0.00;
        $this->_params['PAYMENTREQUEST_0_CURRENCYCODE'] = 'EUR';
        
        unset($paypalConfigs);
    }
    
    function setCancelUrl($_cancelUrl)
    {
        $this->_params['CANCELURL'] = $_cancelUrl;
    }
    
    function setReturnUrl($_returnUrl)
    {
        $this->_params['RETURNURL'] = $_returnUrl;
    }
    
    function setCurrencyCode($_currencyCode)
    {
        $this->_params['PAYMENTREQUEST_0_CURRENCYCODE'] = $_currencyCode;
    }
    
    private function setPayerID($_payerId)
    {
        $this->_params['PAYERID'] = $_payerId;
    }
    
    private function setToken($_token)
    {
        $this->_params['TOKEN'] = $_token;
    }
    
    function addShipping($_shipping)
    {
        $this->_params['PAYMENTREQUEST_0_SHIPPINGAMT']  = $_shipping;
        $this->_params['PAYMENTREQUEST_0_AMT']          += $_shipping;
    }
    
    function addProduct($_name, $_price, $_description = '', $_quantity = 1)
    {
        $this->_params['PAYMENTREQUEST_0_AMT']      += $_price*$_quantity;
        $this->_params['PAYMENTREQUEST_0_ITEMAMT']  += $_price*$_quantity;
        
        $this->_params['L_PAYMENTREQUEST_0_NAME'.$this->_nbProducts]  = $_name;
        $this->_params['L_PAYMENTREQUEST_0_DESC'.$this->_nbProducts]  = $_description;
        $this->_params['L_PAYMENTREQUEST_0_AMT'.$this->_nbProducts]   = $_price;
        $this->_params['L_PAYMENTREQUEST_0_QTY'.$this->_nbProducts]   = $_quantity;
        
        ++$this->_nbProducts;
    }
    
    function addPreFillEmail($_mail)
    {
        $this->_params['EMAIL'] = $_mail;
    }
    
    private function request($_method)
    {
        $this->_params['METHOD'] = $_method;
        
        $params = http_build_query($this->_params);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL             => $this->_paypalUrl,
            CURLOPT_POST            => 1,
            CURLOPT_POSTFIELDS      =>$params,
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_SSL_VERIFYPEER  => false,
            CURLOPT_SSL_VERIFYHOST  => false,
            CURLOPT_VERBOSE         => 1
        ));
        
        $responseStr = curl_exec($curl);
        
        if(curl_errno($curl)) {
            curl_close($curl);
            throw new SException('Curl Error', 590);
        }
        else {
            $responseArr = array();
            parse_str($responseStr, $responseArr);
            if($responseArr['ACK'] == 'Success') {
                curl_close($curl);
                return $responseArr;
            }
            else {
                curl_close($curl);
                throw new SException('Paypal Error', 591);
            }
        }
    }
    
    function SetExpressCheckout()
    {
        try {
            $responseArr = $this->request('SetExpressCheckout');
            header("Location: " . $this->_webscrUrl . '?cmd=_express-checkout&useraction=commit&token=' . $responseArr['TOKEN']);
        }
        catch (Exception $e) {
            throw $e;
        }
    }
    
    function GetExpressCheckoutDetails($_token)
    {
        try {
            $this->setToken($_token);
            $responseArr = $this->request('GetExpressCheckoutDetails');   
            return $responseArr;
        }
        catch (Exception $e) {
            throw $e;
        }
    }
    
    function DoExpressCheckoutPayment($_token, $_payerId)
    {
        try {
            $this->setToken($_token);
            $this->setPayerID($_payerId);
            $responseArr = $this->request('DoExpressCheckoutPayment');   
            return $responseArr;
        }
        catch (Exception $e) {
            throw $e;
        }
    }

    
}
?>
