<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Authentication\Service as Auth;
use Session;
use Mail;
/**
 * User Model class
 * @author Thieu Le Quang <quangthieuagu@gmail.com>
 */
class User extends Eloquent
{
   protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','email','password','active','email_confirm','remember_token','agency_entity_id','agency_parent_id','agency_name','agency_id','group_id','created_at','updated_at'];
    

   
   
}

