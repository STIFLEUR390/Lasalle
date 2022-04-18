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
    'All teachers' => [
        'permission' => 'manage teacher',
        'route' => 'teachers',
        'icon' => 'chalkboard-teacher',
    ],
];
