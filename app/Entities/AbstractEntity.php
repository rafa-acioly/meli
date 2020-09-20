<?php


namespace App\Entities;


class AbstractEntity
{
    public function __construct($parameters = null)
    {
        if(!$parameters) {
            return;
        }

        if($parameters instanceof \stdClass) {
            $parameters = get_object_vars($parameters);
        }

        $this->fill($parameters);
    }

    /**
     * Fill entity with parameters data
     *
     * @param  array  $parameters  Entity parameters
     */
    public function fill(array $parameters)
    {
        foreach($parameters as $property => $value) {
            if(property_exists($this, $property)) {
                $this->$property = $value;

                // Apply mutator
                $mutator = 'set' . ucfirst(static::convertToCamelCase($property));

                if(method_exists($this, $mutator)) {
                    call_user_func_array(array($this, $mutator), [$value]);
                }
            }
        }
    }

    /**
     * Convert string to CamelCase
     *
     * @param   string  $str  Snake case string
     * @return  string  Camel case string
     */
    protected static function convertToCamelCase(string $str): string
    {
        $callback = function($match) {
            return strtoupper($match[2]);
        };

        return lcfirst(preg_replace_callback('/(^|_)([a-z])/', $callback, $str));
    }
}
