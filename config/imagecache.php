<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Name of route
    |--------------------------------------------------------------------------
    |
    | Enter the routes name to enable dynamic imagecache manipulation.
    | This handle will define the first part of the URI:
    | 
    | {route}/{template}/{filename}
    | 
    | Examples: "images", "img/cache"
    |
    */
   
    'route' => 'img/cache',

    /*
    |--------------------------------------------------------------------------
    | Storage paths
    |--------------------------------------------------------------------------
    |
    | The following paths will be searched for the image filename, submited 
    | by URI. 
    | 
    | Define as many directories as you like.
    |
    */
    
    'paths' => array(
        public_path('files')
    ),

    /*
    |--------------------------------------------------------------------------
    | Manipulation templates
    |--------------------------------------------------------------------------
    |
    | Here you may specify your own manipulation filter templates.
    | The keys of this array will define which templates 
    | are available in the URI:
    |
    | {route}/{template}/{filename}
    |
    | The values of this array will define which filter class
    | will be applied, by its fully qualified name.
    |
    */
   
    'templates' => array(
        'small' => 'Intervention\Image\Templates\Small',
        'medium' => 'Intervention\Image\Templates\Medium',
        'large' => 'Intervention\Image\Templates\Large',
        '60x60' => function($image) {
            return $image->fit(60, 60);
        },
        '183x183' => function($image) {
            return $image->fit(183, 183);
        },
        '49x47' => function($image) {
            return $image->fit(49, 47);
        },
        '350x634' => function($image) {
            return $image->fit(350, 634);
        },
        '129x143' => function($image) {
            return $image->fit(129, 143);
        },
        '124x145' => function($image) {
            return $image->fit(124, 145);
        },
        '220x220' => function($image) {
            return $image->fit(220, 220);
        },
        '645x385' => function($image) {
            return $image->fit(645, 385);
        },
        '80x88' => function($image) {
            return $image->fit(80, 88);
        },
        '91x91' => function($image) {
            return $image->fit(91, 91);
        },
        '142x139' => function($image) {
            return $image->fit(142, 139);
        },
        '103x103' => function($image) {
            return $image->fit(103, 103);
        },

        '852x598' => function($image) {
            return $image->fit(852, 598);
        },

        '580x276' => function($image) {
            return $image->fit(580, 276);
        },

        '326x215' => function($image) {
            return $image->fit(326, 215);
        },

        '520x296' => function($image) {
            return $image->fit(520, 296);
        },

        '276x157' => function($image) {
            return $image->fit(276, 157);
        },
        '261x210' => function($image) {
            return $image->fit(261, 210);
        },
        '119x99' => function($image) {
            return $image->fit(119, 99);
        },
        '125x199' => function($image) {
            return $image->fit(125, 199);
        },

        '432x311' => function($image) {
            return $image->fit(432, 311);
        },

        '324x183' => function($image) {
            return $image->fit(324, 183);
        },

        '120x120' => function($image) {
            return $image->fit(120, 120);
        },

    ),

    /*
    |--------------------------------------------------------------------------
    | Image Cache Lifetime
    |--------------------------------------------------------------------------
    |
    | Lifetime in minutes of the images handled by the imagecache route.
    |
    */
   
    'lifetime' => 43200,

);
