<?php
namespace App\Validations;


Class User
{
    /**
     * Add rule to check validate
     * Defined Rule Syntax follow from http://laravel.com/docs/5.1/validation#manually-creating-validators
     * @var type 
     */
    public static $rules = [
                            'name' => 'required',
                            'email' => 'required|unique:users|email',
                            'password' => 'required|min:6|same:repassword',
                            'repassword' => 'required',
            ];
    
    
}