<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users'    => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'manager' => [
            'agreements'  => 'c,r,u,d',
            'communities' => 'c,r,u,d',
            'coupons'     => 'c,r,u,d',
            'groups'      => 'c,r,u,d',
            'invoices'    => 'c,r,u,d',
            'language'    => 'c,r,u,d',
            'tours'       => 'c,r,u,d',
            'users'       => 'c,r,u,d'
        ],
        'admin'   => [
            'agreements'  => 'c,r,u',
            'communities' => 'c,r,u',
            'coupons'     => 'c,r,u',
            'groups'      => 'c,r,u',
            'invoices'    => 'c,r,u',
            'language'    => 'r',
            'tours'       => 'c,r,u',
            'users'       => 'c,r,u'
        ],
        'teacher' => [
            'agreements'  => 'r',
            'communities' => 'c,r,u',
            'coupons'     => 'r',
            'groups'      => 'c,r,u',
            'invoices'    => 'r',
            'language'    => 'r',
            'tours'       => 'c,r,u',
            'users'       => 'r'
        ],
        'agent' => [
            'agreements'  => 'r',
            'communities' => 'c,r,u',
            'coupons'     => 'r',
            'groups'      => 'c,r,u',
            'invoices'    => 'r',
            'language'    => 'r',
            'tours'       => 'c,r,u',
            'users'       => 'r'
        ],
        'user'    => [
            'agreements'  => 'r',
            'communities' => 'r',
            'coupons'     => 'r',
            'groups'      => 'r',
            'invoices'    => 'c,r',
            'language'    => 'r',
            'tours'       => 'r',
            'users'       => 'r'
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
