<?php

namespace Database\Migrations;

use Database\SchemaMigration;

class CreatePasteTable implements SchemaMigration
{
    public function up(): array
    {
        return [
            "CREATE TABLE snippet (
                id INT PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(255) NOT NULL,
                syntax VARCHAR(255) NOT NULL,
                expiration VARCHAR(255) NOT NULL,
                url VARCHAR(255) NOT NULL,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
            )"
        ];
    }

    public function down(): array
    {
        return [
            "DROP TABLE snippet"
        ];
    }
}