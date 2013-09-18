<?php

use Illuminate\Console\Command;

class EnvironmentGetCommand
extends EnvironmentCommand
{
    protected $name = "environment:get";

    protected $description = "Gets the current host and environment.";

    public function fire()
    {
        $this->line("<comment>Host:</comment> <info>" . $this->getHost() . "</info>");
        $this->line("<comment>Environment:</comment> <info>" . $this->getEnvironment() . "</info>");
    }

    protected function getArguments()
    {
        return [];
    }

    protected function getOptions()
    {
        return [];
    }
}