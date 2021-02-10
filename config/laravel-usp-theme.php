<?php

$submenu1 =  [
    [
        'text' => '<i class="fas fa-plus-square"></i> Agendar Trabalho Acadêmico',
        'url'  => '/agendamentos/create',
    ],
    [
        'text' => '<i class="fas fa-list-alt"></i> Listar Trabalhos Acadêmicos',
        'url'  => '/agendamentos',
    ],
];

$menu = [
    [
        'text'    => '<i class="fas fa-home"></i> Dashboard',
        'url' => config('app.url') . '/dashboard',
        'can' => 'LOGADO',
    ],
    [
        'text'    => '<i class="fas fa-calendar-alt"></i> Agendamentos',
        'submenu' => $submenu1,
        'can' => 'LOGADO',
    ],
];

$right_menu = [
    [
        'text' => '<i class="fas fa-cog"></i>',
        'title' => 'Configurações',
        'target' => '_blank',
        'url' => config('app.url') . '/configs',
        'align' => 'right',
        'can' => 'ADMIN',
    ],
    [
        'text' => '<i class="fas fa-user-shield"></i>',
        'title' => 'Admin',
        'target' => '_blank',
        'url' => config('app.url') . '/login_admin',
        'align' => 'right',
        'can' => 'ADMIN',
    ],
];

# dashboard_url renomeado para app_url
# USPTHEME_SKIN deve ser colocado no .env da aplicação 

return [
    'title' => config('app.name'),
    'skin' => env('USP_THEME_SKIN', 'uspdev'),
    'app_url' => config('app.url'),
    'logout_method' => 'GET',
    'logout_url' => config('app.url') . '/logout',
    'login_url' => config('app.url') . '/login',
    'menu' => $menu,
    'right_menu' => $right_menu,
];
