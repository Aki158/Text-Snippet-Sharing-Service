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
            'column_name' => 'url'
        ]
    ];

    public function createRowData(): array
    {
        return [
            // newSnippet.htmlの入力情報をもとに設定する
        ];
    }
}