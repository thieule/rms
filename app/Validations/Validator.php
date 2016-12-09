<?php
namespace App\Validations;

use Validator as Validation;
/**
 * Validator swapper
 * @author Thieu Le Quang <quangthieuagu@gmail.com>
 */
Class Validator extends Validation
{
    /**
     * Extend more rule
     * 
     */
    public static function extendRule()
    {
        /**
         * Extends rule for validation
         * for example foo rule
         */
        self::extend('foo', function($attribute, $value, $parameters) {
            return $value == 'foo';
        });
    }
    
}