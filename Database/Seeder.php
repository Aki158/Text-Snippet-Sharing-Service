<?php

namespace Database;

interface Seeder
{
    public function seed(string $name, string $syntax, string $expiration, string $path, string $code): void;

    public function createRowData(string $name, string $syntax, string $expiration, string $path, string $code): array;
}