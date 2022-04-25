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
            [
                'active' => 'teacher_grade',
                'permission' => 'manage teacher grade',
                'route' => 'teachers.grade',
                'name' => 'Add grade',
            ],
            [
                'active' => 'teacher_status',
                'permission' => 'manage teacher status',
                'route' => 'teachers.status',
                'name' => 'Add status',
            ],
        ]
    ],
    'Manage rooms' => [
        'permission' => 'manage room',
        'route' => 'rooms',
        'icon' => 'school',
    ],
    'Manage courses' => [
        'permission' => 'manage course',
        'route' => 'courses',
        'icon' => 'book',
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
