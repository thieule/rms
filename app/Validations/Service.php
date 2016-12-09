<?php
namespace App\Validations;

/**
 * Validator service
 * @author Thieu Le Quang <quangthieuagu@gmail.com>
 */
Class Service
{
    /**
     * Store service validator 
     * @var type 
     */
    public static $_validator;
    
    /**
     * Get validator serivce by name
     * @param type $name
     * @param type $data
     * @return type
     * @throws \Exception
     */
    public static function get($name, $data=[])
    {
        $validatorName = $name . serialize($data);
        if(!self::$_validator[$validatorName]) {
            
             $validatorClassName = '\App\Validations\\' . ucfirst($name);
            
             if(!class_exists($validatorClassName)) {
                 throw new \Exception('[Load validator] Validator "' . $name . '" is not exits!');
             }
             
             if(is_array($data) && count($data) > 0) { 
                 
                 self::$_validator[$validatorName] = Validator::make($data, $validatorClassName::$rules);
                 
             }  else {
                 throw new \Exception('[Load validator] Input data is invalid!');
             }
                 
             return  self::$_validator[$validatorName];
        }
        
        return self::$_validator[$validatorName];
       
    }
    
  
}