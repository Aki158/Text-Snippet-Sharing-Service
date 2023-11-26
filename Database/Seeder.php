<?php

namespace Database;

interface Seeder
{
    public function seed(): void;

    public function createRowData(): array;
}