<?php

return [
    'Dashboard' => [
        'permission' => 'base',
        'route' => 'dashboard',
        'icon' => 'tachometer-alt',
    ],
    'Manage teachers' => [
        'permission' => 'manage teacher',
        // 'route' => 'teachers.index',
        'icon' => 'chalkboard-teacher',
        'children' => [
            [
                'permission' => 'manage teacher',
                'route' => 'teachers.index',
                'name' => 'Manage teachers'
            ],
            [
                'permission' => 'manage teacher',
                'route' => 'teachers.create',
                'name' => 'Add teacher'
            ],
        ]
    ],
    'Manage rooms' => [
        'permission' => 'manage room',
        'route' => 'rooms',
        'icon' => 'school',
    ],
    'Profile' => [
        'permission' => 'base',
        'route' => 'profile',
        'icon' => 'user',
    ],
    'App setting' => [
        'permission' => 'manage setting',
        'route' => 'settings',
        'icon' => 'cogs',
    ],
];
