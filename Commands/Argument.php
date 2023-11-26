<?php

namespace Commands;

// debug_memo
// Argumentクラスは、Migrate.phpで使用されている
// (new Argument('rollback'))->
// description('Roll backwards. An integer n may also be provided to rollback n times.')->
// required(false)->
// allowAsShort(true)

class Argument
{
    private string $argument;
    private string $description = '';
    private bool $required = true;
    private bool $allowAsShort = false;
    public function __construct(string $argument){
        $this->argument = $argument;
    }

    public function getArgument(): string{
        return $this->argument;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function description(string $description): Argument
    {
        $this->description = $description;
        return $this;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function required(bool $required): Argument
    {
        $this->required = $required;
        return $this;
    }

    public function isShortAllowed(): bool
    {
        return $this->allowAsShort;
    }

    public function allowAsShort(bool $allowAsShort): Argument
    {
        $this->allowAsShort = $allowAsShort;
        return $this;
    }
}