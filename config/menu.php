<?php

return [
    'Dashboard' => [
        'permission' => 'base',
        'route' => 'dashboard',
        'icon' => 'tachometer-alt',
    ],
    'Profile' => [
        'permission' => 'base',
        'route' => 'profile',
        'icon' => 'user',
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
];
