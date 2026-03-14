<?php

return [

    'cards'=>[
        [
            'name'=>'Podaci o nalogu',
            'icon'=>'bi bi-person',
            'route'=>'profile-required.index',
        ],
        [
            'name'=>'Licni podaci',
            'icon'=>'bi bi-person',
            'route'=>'profile-personal.index',
        ],
        [
            'name'=>'Lozinka',
            'icon'=>'bi bi-asterisk',
            'route'=>'profile-password.index',
        ],
        [
            'name'=>'Poruzbine',
            'icon'=>'bi bi-list-ol',
            'route'=>'profile-orders.index',
        ],
        [
            'name'=>'Istorija porudzbina',
            'icon'=>'bi bi-book',
            'route'=>'profile-orders-history.index',
        ],
        [
            'name'=>'Brisanje naloga',
            'icon'=>'bi bi-trash',
            'route'=>'profile-delete.index',
        ],


    ]

];
