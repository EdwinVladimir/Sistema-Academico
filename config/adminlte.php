<?php

//echo Session::get('usuario');

$_SESSION['usuario'] = 'usuario';

return [

    /* 
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'SG Académico',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<strong>SG Académico</strong>',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'AdminLTE',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'bg-gradient-dark',
    'classes_auth_header' => 'bg-gradient-dark',
    'classes_auth_body' => 'bg-gradient-dark',
    'classes_auth_footer' => 'text-center',
    'classes_auth_icon' => 'fa-fw text-light',
    'classes_auth_btn' => 'btn-flat btn-light',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 100,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => '/home',
    'logout_url' => 'logout',
    'login_url' => '/login',
    'register_url' => '/register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        [
            'text' => ' ',
            'search' => false,
            'topnav' => false,
        ],

        [
            'id'      => 'seguridad',
            'text'    => 'SEGURIDAD',
            'url'     => '#',
            'submenu' => [
            
                [
                    'id'   => 'usuario',
                    'text' => 'Usuarios',
                    'url'  => 'usuario',
                    'icon' => 'fas fa-fw fa-user-shield',
                ],

                [
                    'text' => 'Cambiar Pasword',
                    'url'  => 'password',
                    'icon' => 'fas fa-fw fa-key',
                ]
            ],
        ],

      

        [
            'id'      => 'personal',
            'text'    => 'PERSONAL',
            'url'     => '#',
            'submenu' => [
                [
                    'id'   => 'personal_estudiantes',
                    'text' => 'Estudiantes',
                    'url'  => 'estudiantes',
                    'icon' => 'fas fa-fw fa-address-card',
                ],

                [
                    'id'   => 'personal_docentes',
                    'text' => 'Docentes',
                    'url'  => 'docentes',
                    'icon' => 'fas fa-fw fa-chalkboard-teacher',
                ],

            ],
        ],
            [
                'id'      => 'academico',
                'text'    => 'ACADÉMICO',
                'url'     => '#',
                'submenu' => [

                [
                    'id'   => 'porcentaje_notas',
                    'text' => 'Porcentajes Notas',
                    'url'  => 'porcentajes',
                    'icon' => 'fas fa-fw fa-check-square',
                ],

                [
                    'id'   => 'academico_periodo',
                    'text' => 'Periodos',
                    'url'  => 'periodos',
                    'icon' => 'fas fa-fw fa-check-square',
                ],
        
                [
                    'id'   => 'academico_asignacion',
                    'text' => 'Asignación Docente',
                    'url'  => 'asignadoc',
                    'icon' => 'fas fa-fw fa-clock',
                ],
                
                [
                    'id'   => 'academico_matricula',
                    'text' => 'Matriculación',
                    'url'  => 'matriculacion',
                    'icon' => 'fas fa-fw fa-book',
                ],

                [
                    'id'   => 'academico_plan',
                    'text' => 'Plan de Evaluación',
                    'url'  => 'actividades',
                    'icon' => 'fas fa-fw fa-book-open',
                ],

                [
                    'id'   => 'academico_evaluacion',
                    'text' => 'Registrar Evaluación',
                    'url'  => 'evaluaciones',
                    'icon' => 'fas fa-fw fa-book-reader',
                ], 
                
            ],
        ],

   
    [
            'id'      => 'gestion',
            'text'    => 'GESTIÓN CURSO',
            'url'     => '#',
            'submenu' => [
     
            [   
                'id'   => 'gestion_aula',
                'text' => 'Aula',
                'url'  => 'aula',
                'icon' => 'fas fa-fw fa-shapes',
            ],   

                
            [   
                'id'   => 'gestion_seccion',
                'text' => 'Sección',
                'url'  => 'seccion',
                'icon' => 'fas fa-fw fa-microscope',
            ],
            
            [   
                'id'   => 'gestion_materia',
                'text' => 'Materias',
                'url'  => 'materias',
                'icon' => 'fas fa-fw fa-book-medical',
            ],
                
            [   
                'id'   => 'gestion_curso',
                'text' => 'Cursos',
                'url'  => 'cursos',
                'icon' => 'fas fa-fw fa-bookmark',
            ],
            [
                'id'   => 'miscelaneo_tipo_curso',
                'text' => 'Tipo Curso',
                'url'  => 'tipocurso',
                'icon' => 'fas fa-fw fa-globe',
            ],

          
        ],
    ],
        
    [
        'id'      => 'reporte',
        'text'    => 'REPORTES',
        'url'     => '#',
        'submenu' => [
            [
                'id'   => 'reporte_matricula',
                'text' => 'Matrículas',
                'url'  => 'reporte/matriculas',
                'icon' => 'fas fa-fw fa-clipboard',
            ],

            [        
                'id'   => 'reporte_registro_notas',
                'text' => 'Registro de notas docente',
                'url'  => 'reporte/registro-notas',
                'icon' => 'fas fa-fw fa-columns',
            ],
            [        
                'id'   => 'reporte_mis_notas',
                'text' => 'Mis notas estudiante',
                'url'  => 'reporte/notas',
                'icon' => 'fas fa-fw fa-columns',
            ],
            [        
                'id'   => 'reporte_curso',
                'text' => 'Calificaciones Curso',
                'url'  => 'reporte/cursos',
                'icon' => 'fas fa-fw fa-columns',
            ],
            [
                'id'   => 'reporte_aptitud_alumno',
                'text' => 'Aptitudes Cursos',
                'url'  => 'reporte/aptitud-curso',
                'icon' => 'fas fa-fw fa-columns'
            ],
            [
                'id'   => 'reporte_aptitud_docente',
                'text' => 'Aptitudes Materias',
                'url'  => 'reporte/aptitud-materia',
                'icon' => 'fas fa-fw fa-columns'
            ],
            [
                'id'   => 'reporte_historial_estudiante',
                'text' => 'Historial Estudiantes',
                'url'  => 'reporte/historial-estudiante',
                'icon' => 'fas fa-fw fa-columns',
            ],
            [
                'id'   => 'reporte_historial_docente',
                'text' => 'Historial Docente',
                'url'  => 'reporte/historial-docente',
                'icon' => 'fas fa-fw fa-columns',
            ],
            [
                'id'   => 'reporte_configuration_footer',
                'text' => 'Conf. Pie Reporte',
                'url'  => 'reporte/configurar-footer',
                'icon' => 'fas fa-cog',
            ],
            
        ],
    ],

    [
        'id'      => 'miscelaneo',
        'text'    => 'MISCELANEOS',
        'url'     => '#',
        'submenu' => [

        [
            'id'   => 'miscelaneo_reparto',
            'text' => 'Reparto',
            'url'  => 'reparto',
            'icon' => 'fas fa-fw fa-trophy',
        ],

        [
            'id'   => 'miscelaneo_especialidad',
            'text' => 'Especialidad',
            'url'  => 'especialidad',
            'icon' => 'fas fa-fw fa-images',
        ],

        [
            'id'   => 'miscelaneo_grado',
            'text' => 'Tipo de Grado',
            'url'  => 'tipogrado',
            'icon' => 'fas fa-fw fa-award',
        ],

    

        [
            'id'   => 'miscelaneo_eje_curso',
            'text' => 'Eje del Curso',
            'url'  => 'ejecurso',
            'icon' => 'fas fa-fw fa-eject',
        ],

        [
            'id'   => 'miscelaneo_tipo_sangre',
            'text' => 'Tipo de Sangre',
            'url'  => 'tiposangre',
            'icon' => 'fas fa-fw fa-plus-circle',
        ],

    ],
],
[
    'id'      => 'analisis_datos',
    'text'    => 'ANALÍS DE DATOS',
    'url'     => '#',
    'submenu' => [
        [
            'id'   => 'analisis_cursos',
            'text' => 'Cursos Notas',
            'url'  => '/analisis-de-datos-cursos',
            'icon' => 'fab fa-think-peaks',    
        ],

        [
            'id'   => 'analisis_cursos_rango',
            'text' => 'Cursos Rangos',
            'url'  => '/analisis-de-datos-cursos-rangos',
            'icon' => 'fas fa-external-link-alt',   
        ],

    ],
],




        [
            'text'    => 'SALIR',
            'url'         => '/logout',
            'icon'        => 'far fa-fw fa-times-circle',
            'label_color' => 'success',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    */

    'livewire' => false,
];
