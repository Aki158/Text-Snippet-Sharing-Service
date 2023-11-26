<?php

namespace Database\Seeds;

use Faker\Factory;

use Database\AbstractSeeder;

class ComputerPartsSeeder extends AbstractSeeder {
    protected ?string $tableName = 'computer_parts';
    protected array $tableColumns = [
        [
            'data_type' => 'string',
            'column_name' => 'name'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'type'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'brand'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'model_number'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'release_date'
        ],
        [
            'data_type' => 'string',
            'column_name' => 'description'
        ],
        [
            'data_type' => 'int',
            'column_name' => 'performance_score'
        ],
        [
            'data_type' => 'float',
            'column_name' => 'market_price'
        ],
        [
            'data_type' => 'float',
            'column_name' => 'rsm'
        ],
        [
            'data_type' => 'float',
            'column_name' => 'power_consumptionw'
        ],
        [
            'data_type' => 'float',
            'column_name' => 'lengthm'
        ],
        [
            'data_type' => 'float',
            'column_name' => 'widthm'
        ],
        [
            'data_type' => 'float',
            'column_name' => 'heightm'
        ],
        [
            'data_type' => 'int',
            'column_name' => 'lifespan'
        ]
    ];

    public function createRowData(): array {
        $faker = Factory::create();
        $fake_rowdata_arr = [];

        for($i = 0;$i < 10000;$i++){
            $fake_rowdata_arr[$i] = [
                $faker->randomElement(['Ryzen 9 5900X', 'GeForce RTX 3080', 'Samsung 970 EVO SSD', 'Corsair Vengeance LPX 16GB']),
                $faker->randomElement(['CPU', 'GPU', 'SSD', 'RAM']),
                $faker->randomElement(['AMD', 'NVIDIA', 'Samsung', 'Corsair']),
                $faker->bothify('**********'),
                $faker->date(),
                $faker->sentence(),
                $faker->numberBetween(1, 100),
                $faker->randomFloat(null, 50, 1000),
                $faker->randomFloat(null, 0, 1),
                $faker->randomFloat(null, 100, 1000),
                $faker->randomFloat(null, 0, 1),
                $faker->randomFloat(null, 0, 1),
                $faker->randomFloat(null, 0, 1),
                $faker->numberBetween(1, 20)
            ];
        }
        return $fake_rowdata_arr;
    }
}
