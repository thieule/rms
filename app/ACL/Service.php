<?php 
namespace App\ACL;
use App\Authentication\Service as AuthService;

class Service 
{
    private static $_exceptRole = ['public'];
    private static $_role;
    private static $_permissions;
    /**
     * Get role of user current
     * @return type
     */
    public static function getPermissions()
    {
        if(!self::$_permissions){
            $role = new \App\ACL\Permission();
             self::$_permissions = $role->getPermission();
        }
        return self::$_permissions;
    }
    
    /**
     * Check permission
     * @return type
     */
    public static function checkPermission()
    {
        return self::hasPermission() || self::isExcept() ;
    }
   /**
    * 
    * @param type $permissions
    * @return boolean
    */
   public static function hasView($permissions = [])
   {
       if (self::isAgencyParent() || self::isAdmin()) {
            return true;
        }
        
        
       foreach($permissions as $permission) {
           if(in_array($permission, self::getPermissions())) {
               return true;
           }
       }
       return false;
   }

    public static function setRole($role)
    {
        self::$_role = $role;
    }
   
    public static function isAgencyParent()
    {
        return (AuthService::getAuthInfo()->type == 'agency_parent');
    }
    public static function isAgencyChild()
    {
        return (AuthService::getAuthInfo()->type == 'agency_child');
    }
    public static function isMember()
    {
        return (AuthService::getAuthInfo()->type == 'member');
    }
    public static function isAdmin()
    {
        return (AuthService::getAuthInfo()->type == 'admin');
    }
    

  /**
     * hasPermission Check if user has requested route permimssion
     * @param type $role | String
     * @return boolean
     */
   private static function hasPermission()
    {   
        
        return in_array(self::$_role,  self::getPermissions());
    }
    
    private static function isExcept()
    {
        if (self::isAgencyParent() || self::isAdmin()) {
            return true;
        }
       
        return in_array(self::$_role,  self::$_exceptRole);
    }

}