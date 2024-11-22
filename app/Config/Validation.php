<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public array $signup = [
        'username' => [
            'rules'  => 'required|max_length[20]|min_length[4]',
            'errors' => [
                'required'  =>'Debes elegir un nombre de usuario',
                'min_length'=>'Nombre: se requieren al menos 4 caracteres',
                'max_length'=>'Nombre: se requieren como máximo 20 caracteres',
            ],
        ],
        'password' => [
            'rules'  => 'required|max_length[20]|min_length[4]',
            'errors' => [
                'required'  =>'Debes elegir una contraseña',
                'min_length'=>'Contraseña: se requieren al menos 4 caracteres',
                'max_length'=>'Contraseña: se requieren como máximo 20 caracteres',
            ],
        ],
        'email' => [
            'rules'  => 'required|max_length[40]|valid_email',
            'errors' => [
                'required'  =>'Debes elegir un correo',
                'min_length'=>'Correo: se requieren al menos 4 caracteres',
                'max_length'=>'Correo: se requieren como máximo 40 caracteres',
                'valid_email' => 'Por favor revisa que el correo sea una dirección válida.',
            ],
        ],
    ];
}
