<?php
namespace App\Authentication;
use App\Authentication\AdapterInterface;
use App\Authentication\AbstractAdapter;
/* 
 * This is class to authentication through database
 * @author Thieu.LeQuang
 */
class EcomAdapter extends AbstractAdapter implements AdapterInterface
{
    private $_authInfo = null;
    /**
     * Set indentity and credential to adapter
     * @param type $identity
     * @param type $credential
     */
    public function __construct($identity,$credential) {
        
        $this->setCredential($credential)->setIdentity($identity);
        
    }
    /**
     * Authenticate  
     * @param object $db
     * @return boolean
     */
    public function authenticate() {

        $arrData = [
                        'email' => $this->identity,
                        'password' => $this->credential
                ];        

        $result = apiRequest(ECOM_API_BASE_URL . 'mobile/b2b_user/loginAgency', $arrData);                 
       // var_dump($result);die;  
        if(isset($result['error']) && $result['error'] == 0) {
           
            $this->setAuthInfo($result['data']);
            
            return true;
            
        }    
        
        return false;
    }
    
    /**
     * Encode indentity
     * @param string $identity
     * @return string
     */
    public function encodeCredential($credential)
    {
        return md5($credential);
    }
    /**
     * Set authentication info
     * @param stdclass $authInfo
     */
    public function setAuthInfo($authInfo)
    {
        $userInfor = new \stdClass();
        $userInfor->id = !empty($authInfo['entity_id']) ? $authInfo['entity_id'] : 0;
        $userInfor->name =(!empty($authInfo['address']['lastname']) ? $authInfo['address']['lastname'] : '')  . ' ' . (!empty($authInfo['address']['firstname']) ? $authInfo['address']['firstname'] : '') ;
        $userInfor->agencyId = !empty($authInfo['agency_id']['id_agency']) ? $authInfo['agency_id']['id_agency'] : '';
        $userInfor->parentAgencyId = !empty($authInfo['agency_id']['id_agency_parent']) ? $authInfo['agency_id']['id_agency_parent'] : '';
        $userInfor->agencyEntityId = $userInfor->id;
        $userInfor->agencyName = !empty($authInfo['agency_name']) ? $authInfo['agency_name'] : '';
        $userInfor->email = !empty($authInfo['email']) ? $authInfo['email'] : '';
        $userInfor->type = ($userInfor->parentAgencyId) ? 'agency_child' : 'agency_parent';
        $userInfor->accessToken = !empty($authInfo['access_token']) ? $authInfo['access_token'] : '';
        $userInfor->certificateType = $authInfo['certificate_type'];
        $userInfor->certificateNumber = $authInfo['certificate_number'];
        $userInfor->headOfficeAddress = $authInfo['head_office_address'];
        $userInfor->telephone = $authInfo['address']['telephone'];
        $userInfor->street = $authInfo['address']['street'];
        $userInfor->active = empty($userInfor->agencyId) ? 0 : 1;
        $userInfor->confirmation = 1;
        $this->_authInfo = $userInfor;
    }
    /**
     * Get authentication info
     * @return stdclass
     */
    public function getAuthInfo()
    {
        return $this->_authInfo;
    }
}

