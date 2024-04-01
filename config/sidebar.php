<?php 

// if the menu isnt a header (first level menu) or doesnt have a header then set header_name to false
// masih perlu ku kembangkan, terutama buat route_name dengan active_name nya ku ubah saja

return [
    [
        'title' => 'dashboard',
        'icon' => 'bx bx-home-circle',
        'route_name' => 'dashboard',
        'header_name' => false,
        'has_sub' => false
    ],
    [
        'title' => 'master data',
        'icon' => 'bx bx-dock-top',
        'route_name' => null,
        'header_name' => 'Admin Menu',
        'has_sub' => true,
        'sub_active_link' => [
            'guru.index','siswa.index','mapel.index','jadwal.index','jadwal.create'
        ],
        'submenu' => [
            [
                'title' => 'guru',
                'route_name' => 'guru.index'
            ],
            [
                'title' => 'siswa',
                'route_name' => 'siswa.index'
            ],
            [
                'title' => 'mapel',
                'route_name' => 'mapel.index'
            ],
            [
                'title' => 'jadwal mengajar',
                'route_name' => 'jadwal.create'
            ]
        ],
    ],
    [
        'title' => 'users',
        'icon' => 'bx bx-user',
        'route_name' => 'user.index',
        'header_name' => false,
        'has_sub' => false
    ],
];