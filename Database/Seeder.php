<?php

namespace Database;

interface Seeder
{
    public function seed(string $name, string $syntax, string $expiration, string $url): void;

    public function createRowData(string $name, string $syntax, string $expiration, string $url): array;
}