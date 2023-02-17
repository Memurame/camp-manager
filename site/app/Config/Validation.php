<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        \Myth\Auth\Authentication\Passwords\ValidationRules::class
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

    public $anmeldungen = [
        'vorname' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Der Vorname muss angegeben werden.',
            ],
        ],
        'nachname' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Der Nachname muss angegeben werden.',
            ],
        ],
        'strasse' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Die Strasse muss angegeben werden',
            ],
        ],
        'plz' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Die PLZ muss angegeben werden',
            ],
        ],
        'ort' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Der Wohnort muss angegeben werden',
            ],
        ],
        'geb' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Das Geburtsdatum muss angegeben werden',
            ],
        ],
    ];




    public $zimmer = [
        'input_name' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Feld darf nicht leer sein',
            ],
        ],
        'input_capacity' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Feld darf nicht leer sein',
            ],
        ]
    ];
}
