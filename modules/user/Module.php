<?php
/**
 * Created by PhpStorm.
 * User: awt
 * Date: 06/12/2017
 * Time: 3:42 PM
 */

namespace user;

class Module
{
    public function getConfig()
    {
        return [
            'route' =>[
                'default' => 'login'
            ]
        ];
    }
}