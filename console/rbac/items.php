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
            'ticketsList',
            'ticketsEdit',
        ],
    ],
    'Администратор' => [
        'type' => 1,
        'children' => [
            'usersEdit',
            'Менеджер',
            'ticketsDelete',
        ],
    ],
    'ticketsList' => [
        'type' => 2,
        'description' => 'View ticket list',
    ],
    'ticketsEdit' => [
        'type' => 2,
        'description' => 'Edit tickets',
    ],
    'ticketsDelete' => [
        'type' => 2,
        'description' => 'Delete tickets',
    ],
];
