<?php

return [

    'cards'=>[
        [
            'name'=>'Podaci o nalogu',
            'icon'=>'bi bi-person-circle',
            'route'=>'profile-required.edit',
        ],
        [
            'name'=>'Licni podaci',
            'icon'=>'bi bi-person',
            'route'=>'profile-personal.edit',
        ],
        [
            'name'=>'Lozinka',
            'icon'=>'bi bi-lock',
            'route'=>'profile-password.edit',
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
