<?php

return [
    'Dashboard' => [
        'role' => 'Admin|Super Admin|Invite',
        'route' => 'dashboard',
        'icon' => 'tachometer-alt',
    ],
    'Manage teachers' => [
        'role' => 'Admin|Super Admin|Invite',
        // 'route' => 'teachers.index',
        'icon' => 'chalkboard-teacher',
        'children' => [
            [
                'role' => 'Admin|Super Admin|Invite',
                'route' => 'teachers.index',
                'name' => 'Manage teachers'
            ],
            [
                'role' => 'Admin|Super Admin',
                'route' => 'teachers.create',
                'name' => 'Add teacher'
            ],
            [
                'active' => 'teacher_grade',
                'role' => 'Admin|Super Admin',
                'route' => 'teachers.grade',
                'name' => 'Add grade',
            ],
            [
                'active' => 'teacher_status',
                'role' => 'Admin|Super Admin',
                'route' => 'teachers.status',
                'name' => 'Add status',
            ],
        ]
    ],
    'Manage rooms' => [
        'role' => 'Admin|Super Admin|Invite',
        'route' => 'rooms',
        'icon' => 'door-open ',
    ],
    'Manage courses' => [
        'role' => 'Admin|Super Admin|Invite',
        'route' => 'courses',
        'icon' => 'book-open',
    ],
    'Manage departments' => [
        'role' => 'Admin|Super Admin|Invite',
        'route' => 'departments',
        'icon' => 'building',
    ],
    'Manage faculties' => [
        'role' => 'Admin|Super Admin|Invite',
        'route' => 'faculties',
        'icon' => 'graduation-cap',//university, book, school, graduation-cap,  user-cog
    ],
    'Manage schedules' => [
        'role' => 'Admin|Super Admin|Invite',
        'icon' => 'clock',
        'children' => [
            [
                'role' => 'Admin|Super Admin|Invite',
                'route' => 'schedules.index',
                'name' => 'Manage schedules'
            ],
            [
                'role' => 'Super Admin',
                'route' => 'schedules.create',
                'name' => 'Add schedule'
            ],
            [
                'active' => 'schedule_status',
                'role' => 'Super Admin',
                'route' => 'schedules.status',
                'name' => 'Update status'
            ],
        ]
    ],
    'Manage users' => [
        'role' => 'Invite|Super Admin|Admin',
        'icon' => 'users',
        'children' => [
            [
                'role' => 'Invite|Super Admin|Admin',
                'route' => 'users.index',
                'name' => 'Manage users'
            ],
            [
                'role' => 'Super Admin',
                'route' => 'users.create',
                'name' => 'Add user'
            ],
        ]
    ],
    'Profile' => [
        'role' => 'Admin|Super Admin|Invite',
        'route' => 'profile',
        'icon' => 'user',
    ],
    'App setting' => [
        'role' => 'Super Admin',
        'route' => 'settings',
        'icon' => 'cogs',
    ],
];
