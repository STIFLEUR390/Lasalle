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
        'icon' => 'door-open ',
    ],
    'Manage courses' => [
        'permission' => 'manage course',
        'route' => 'courses',
        'icon' => 'book-open',
    ],
    'Manage departments' => [
        'permission' => 'manage course',
        'route' => 'departments',
        'icon' => 'building',
    ],
    'Manage faculties' => [
        'permission' => 'manage faculty',
        'route' => 'faculties',
        'icon' => 'graduation-cap',//university, book, school, graduation-cap,  user-cog
    ],
    'Manage schedules' => [
        'permission' => 'manage schedule',
        'icon' => 'clock',
        'children' => [
            [
                'permission' => 'manage schedule',
                'route' => 'schedules.index',
                'name' => 'Manage schedules'
            ],
            [
                'permission' => 'manage schedule',
                'route' => 'schedules.create',
                'name' => 'Add schedule'
            ],
        ]
    ],
    'Profile' => [
        'permission' => 'base',
        'route' => 'profile',
        'icon' => 'user',
    ],
    'App setting' => [
        'permission' => 'manage department',
        'route' => 'settings',
        'icon' => 'cogs',
    ],
];
