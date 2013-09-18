<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class EnvironmentSetCommand
extends EnvironmentCommand
{
    protected $name = "environment:set";

    protected $description = "Adds the current host name to the provided environment.";

    public function fire()
    {
        $host        = $this->getHost();
        $config      = $this->getConfig();
        $overwrite   = $this->option("host");
        $environment = $this->argument("environment");

        if (!isset($config[$environment]))
        {
            $config[$environment] = [];
        }

        $use = $host;

        if ($overwrite)
        {
            $use = $overwrite;
        }

        if (!in_array($use, $config[$environment]))
        {
            $config[$environment][] = $use;
        }

        $this->setConfig($config);

        $this->line("<info>Added</info> <comment>" . $use . "</comment> <info>to</info> <comment>" . $environment . "</comment> <info>environment.</info>");
    }

    protected function getArguments()
    {
        return [
            ["environment", InputArgument::REQUIRED, "The name of the environment to add the current host name to."]
        ];
    }

    protected function getOptions()
    {
        return [
            ["host", null, InputOption::VALUE_OPTIONAL, "The optional host to add to the environment.", null]
        ];
    }
}