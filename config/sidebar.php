<?php

return [
    [
        'title' => 'general',
        'items' => [
            ['label' => 'dashboard', 'icon' => 'Home-dashboard', 'url' => '/'],
            ['label' => 'profile', 'icon_fa' => 'fa-solid fa-user', 'route' => 'profile.index'],

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
            ['label' => 'Customize Appearance', 'icon_fa' => 'fa-solid fa-image', 'route' => 'settings.index'],
        ],
    ],
    [
        'title' => 'Warehouses',
        'items' => [
            ['label' => 'Warehouses List', 'icon_fa' => 'fa-solid fa-warehouse', 'route' => 'warehouses.index', 'parmitions' => ['can' => 'view-warehouses'],],
        ],
    ],
    [
        'title' => 'Doctors',
        'items' => [
            ['label' => 'Doctors List', 'icon_fa' => 'fa-solid fa-user-md', 'route' => 'doctors.index', 'parmitions' => ['can' => 'view-doctors'],],
        ],
    ],



    [
        'title' => 'information',
        'items' => [
            [
                'label' => 'the information',
                'icon_fa' => 'fa-solid fa-info',
                'parmitions' => ['can' => 'create-users'],
                'children' => [
                    ['label' => 'Cities List', 'icon_fa' => 'fa-solid fa-city', 'route' => 'cities.index', 'parmitions' => ['can' => 'view-cities'],],
                    ['label' => 'Areas List', 'icon_fa' => 'fa-solid fa-map-marker-alt', 'route' => 'areas.index', 'parmitions' => ['can' => 'view-areas'],],
                    ['label' => 'Specialization List', 'icon_fa' => 'fa-solid fa-graduation-cap', 'route' => 'specializations.index', 'parmitions' => ['can' => 'view-specializations'],],
                    ['label' => 'Classification List', 'icon_fa' => 'fa-solid fa-graduation-cap', 'route' => 'classifications.index', 'parmitions' => ['can' => 'view-classifications'],],
                ]
            ],

        ],
    ],
    [
        'title' => 'Files',
        'parmitions' => ['can' => 'view-files'],

        'items' => [
            ['label' => 'Files List', 'icon_fa' => 'fa-solid fa-file', 'route' => 'files.index', 'parmitions' => ['can' => 'view-files'],],
        ],
    ],
];
