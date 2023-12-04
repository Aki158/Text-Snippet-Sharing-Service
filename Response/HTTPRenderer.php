<?php

namespace Response;

interface HTTPRenderer {
    public function getFields(): array;
    public function getContent(): string;
}
