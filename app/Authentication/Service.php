<?php
namespace App\Authentication;
use App\Authentication\AdapterInterface as Adapter;
use Session;
/**
 * Authentication service
 *
 * User library for the application
 */
class Service
{
   
    private $_adapter;

    public function authenticate($adapter = null){
        
        if ($adapter instanceof Adapter) {
            $this->setAdapter($adapter);
        }

        if($this->_adapter->authenticate()) {
            $this->_storageAuthenticationInfor();
            return true;
        }
        
        return false;
    }
    /**
     * return status of authentication
     * @return boolean
     */
    public static function isAuthenticated()
    {
        $authInfo = Session::get('userinfo');
       
        if (!empty($authInfo->id)) {
            return true;
        }
        
        return false;
    }
    
    public static function getAuthInfo()
    {
        if(Session::has('userinfo')){
            return Session::get('userinfo');
        }
        
        return null;
    }
    
  
    /**
     * 
     */
    private function _storageAuthenticationInfor()
    {
        Session::set('userinfo', $this->_adapter->getAuthInfo());
    }
    
    public function setAdapter($adapter)
    {
        $this->_adapter = $adapter;
    }
    
    public static function clearAuthInfo()
    {
        Session::forget('userinfo');
        
    }
    
    public static function encodeCredential($credential)
    {
        return md5($credential);
    }
    /**
     * 
     * @param type $length
     * @param type $chars
     * @return type
     */
    public static function generatePassAuto($length = 8, $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789')
    {
        return substr( str_shuffle( $chars ), 0, $length );
    }
    
}
