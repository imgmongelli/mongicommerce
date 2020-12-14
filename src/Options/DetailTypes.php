<?php


namespace Mongi\Mongicommerce\Options;


class DetailTypes
{

    /**
     * @return array
     */
    public static function all()
    {
        return [
            1 => 'checkbox',
            2 => 'text',
            3 => 'number',
            4 => 'textarea',
            5 => 'radio',
        ];
    }


}
