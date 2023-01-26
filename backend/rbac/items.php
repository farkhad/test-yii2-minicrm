<?php

return [
    'usersList' => [
        'type' => 2,
        'description' => 'View user list',
    ],
    'usersEdit' => [
        'type' => 2,
        'description' => 'Edit users',
    ],
    'Менеджер' => [
        'type' => 1,
        'children' => [
            'usersList',
        ],
    ],
    'Администратор' => [
        'type' => 1,
        'children' => [
            'usersEdit',
            'Менеджер',
        ],
    ],
];
