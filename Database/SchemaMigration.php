<?php

namespace Database;

interface SchemaMigration
{
    public function up(): array;
    public function down(): array;
}