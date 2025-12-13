<?php

return [
    [
        'title' => 'general',
        'items' => [
            ['label' => 'dashboard', 'icon' => 'Home-dashboard', 'url' => '/'],
            ['label' => 'profile', 'icon' => 'Profile', 'route' => 'profile.index'],

            [
                'label' => 'users',
                'icon' => 'Profile',
                'parmitions' => ['can' => 'create-users'],
                'children' => [
                    ['label' => 'Users List', 'icon' => 'Users', 'route' => 'users.index', 'parmitions' => ['can' => 'view-users'],],
                    ['label' => 'Deleted Users', 'icon' => 'Delete', 'color' => 'red', 'route' => 'users.deleted', 'parmitions' => ['can' => 'delete-users'],],
                ]
            ],
            [
                'label' => 'roles',
                'icon' => 'Shield',
                'parmitions' => ['can' => 'create-roles'],
                'children' => [
                    ['label' => 'Roles List', 'icon' => 'Users', 'route' => 'roles.index', 'parmitions' => ['can' => 'view-roles'],],
                ]
            ],


        ],
    ],

    [
        'title' => 'Settings',
        'items' => [
            ['label' => 'Customize Appearance', 'icon' => 'Setting', 'route' => 'settings.index'],
        ],
    ],
];
