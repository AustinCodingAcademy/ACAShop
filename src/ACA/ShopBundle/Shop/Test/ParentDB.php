<?php

namespace ACA\ShopBundle\Shop\Test;

class ParentDB
{
    protected $id;


    /**
     * 1. How do we know who called this method? i.e. which child class?
     *
     * 2. How do we know the number and value of each of the child's properties?
     * Reflection
     */
    public function save()
    {

        $class = get_called_class();

        echo '$class='.$class;
        die();

        if (isset($this->id)) {

            //update query
        } else {

            //insert query
        }

    }

}