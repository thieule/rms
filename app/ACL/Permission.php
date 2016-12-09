<?php 
namespace App\ACL;
use DB;
use Session;
class Permission 
{

    private $_user;
    private static $_agency_parent_permissions = ['AGENCY','AGENCY-PARENT'];
    private static $_agency_child_permissions = ['AGENCY','AGENCY-CHILD'];
    /**
     * 
     */
    public function __construct() {
        $this->_user = \App\Authentication\Service::getAuthInfo();
    }
    /**
     * Get role of current user
     * @return type
     */
    public function getPermissionMember()
    {
        $permissions = Session::get('user.permission');
        if(is_array($permissions)){
            return $permissions;
        }
        $permissions = DB::table('acl_user_role')
                ->leftJoin('acl_role_permission', 'acl_role_permission.role_id', '=', 'acl_user_role.role_id')
                ->leftJoin('acl_permissions', 'acl_permissions.id', '=', 'acl_role_permission.permission_id')
                ->select( array(
                       'acl_permissions.ident'
                   ))->where('acl_user_role.user_id',$this->_user->id)->get();
        $permissionsArray = [];
        foreach($permissions as $role) {
            $permissionsArray[] = $role->ident;
        }
        Session::set('user.permission', $permissionsArray);
        
        return $permissionsArray;
    }
    
    /**
     * Get role of current user
     * @return type
     */
    public function getPermission()
    {
        
        return $this->getPermissionMember();
                  
    }
}