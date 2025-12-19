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
            ['label' => 'Customize Appearance', 'icon_fa' => 'fa-solid fa-image', 'route' => 'settings.index', ],
            ['label' => 'Monthly Periods', 'icon_fa' => 'fa-solid fa-calendar', 'route' => 'visitPeriods.index', 'parmitions' => ['can' => 'view-visit_periods'],],
            ['label' => 'Doctor Visits', 'icon_fa' => 'fa-solid fa-calendar', 'route' => 'doctorVisits.index', 'parmitions' => ['can' => 'view-doctor_visits'],],
            ['label' => 'Create Doctor Visits', 'icon_fa' => 'fa-solid fa-calendar', 'route' => 'doctorVisits.create', 'parmitions' => ['can' => 'create-doctor_visits'],],
        ],
    ],
    [
        'title' => 'Operations',
        'items' => [
            ['label' => 'Warehouses List', 'icon_fa' => 'fa-solid fa-warehouse', 'route' => 'warehouses.index', 'parmitions' => ['can' => 'view-warehouses'],],


            ['label' => 'Stores List', 'icon_fa' => 'fa-solid fa-store', 'route' => 'representativeStores.index', 'parmitions' => ['can' => 'view-representative_stores'],],
            ['label' => 'My storehouse', 'icon_fa' => 'fa-solid fa-store', 'route' => 'representativeStores.onlyshow', 'parmitions' => ['can' => 'show-representative_stores'],],
            ['label' => 'Doctors List', 'icon_fa' => 'fa-solid fa-user-md', 'route' => 'doctors.index', 'parmitions' => ['can' => 'view-doctors'],],
            [
                'label' => 'Products List',
                'icon_fa' => 'fa-solid fa-box',
                'parmitions' => ['can' => 'create-products'],
                'children' => [
                    ['label' => 'Create Product', 'icon_fa' => 'fa-solid fa-pills', 'route' => 'products.create', 'parmitions' => ['can' => 'create-products'],],
                    ['label' => 'List of medications', 'icon_fa' => 'fa-solid fa-pills', 'route' => 'products.type.index',   'params' => ['type' => 'medicine'], 'parmitions' => ['can' => 'view-products'],],
                    ['label' => 'Gift List', 'icon_fa' => 'fa-solid fa-gift', 'route' => 'products.type.index',   'params' => ['type' => 'gift'], 'parmitions' => ['can' => 'view-products'],],

                ]
            ],
            [
                'label' => 'Orders List',
                'icon_fa' => 'fa-solid fa-file-invoice',
                'parmitions' => ['can' => 'create-invoices'],
                'children' => [

                    ['label' => 'Representative orders', 'icon_fa' => 'fa-solid fa-pills', 'route' => 'orders.index', 'parmitions' => ['can' => 'view-orders'],],
                    ['label' => 'Create an order from the warehouse', 'icon_fa' => 'fa-solid fa-pills', 'route' => 'orders.create', 'parmitions' => ['can' => 'create-orders'],],
                    ['label' => 'Create Invoice', 'icon_fa' => 'fa-solid fa-pills', 'route' => 'invoices.create', 'parmitions' => ['can' => 'create-invoices'],],
                    ['label' => 'List of invoices', 'icon_fa' => 'fa-solid fa-pills', 'route' => 'invoices.index',  'parmitions' => ['can' => 'view-invoices'],],

                ]
            ],


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
            ['label' => 'Create TreeProduct', 'icon_fa' => 'fa-solid fa-tree', 'route' => 'TreeProducts.upload', 'parmitions' => ['can' => 'create-files'],],
        ],
    ],
];
