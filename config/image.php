<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',


    'originalFolder' => 'original',
    'mediumFolder' => '800',
    'avatarFolder' => '150',
    'smallFolder' => '60',
    'path' => 'uploads',

    'avatar' => 'guest_user.png'

);
