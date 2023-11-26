<?php

namespace Database\Migrations;

use Database\SchemaMigration;

class CreateComputerPartsTable1 implements SchemaMigration
{
    public function up(): array
    {
        return [
            "CREATE TABLE computer_parts (
                id INT PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(255) NOT NULL,
                type VARCHAR(50) NOT NULL,
                brand VARCHAR(255) NOT NULL,
                model_number VARCHAR(100),
                release_date DATE,
                description TEXT,
                performance_score INT,
                market_price DECIMAL(12, 2),
                rsm DECIMAL(12, 2),
                power_consumptionw FLOAT,
                lengthm DOUBLE,
                widthm DOUBLE,
                heightm DOUBLE,
                lifespan INT,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )"
        ];
    }

    public function down(): array
    {
        return [
            "DROP TABLE computer_parts"
        ];
    }
}