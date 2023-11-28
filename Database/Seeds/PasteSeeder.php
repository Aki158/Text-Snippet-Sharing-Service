<?php

namespace Database\Seeds;

use Database\AbstractSeeder;

class PasteSeeder extends AbstractSeeder {

    protected ?string $tableName = 'snippet';

    protected array $tableColumns = [
        [
            'data_type' => 'string',
            'column_name' => 'name'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'syntax'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'expiration'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'path'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'code'
        ]   
    ];

    public function createRowData(string $name, string $syntax, string $expiration, string $path, string $code): array
    {
        return [
            [
                $name,
                $syntax,
                $expiration,
                $path,
                $code
            ]
        ];
    }
}