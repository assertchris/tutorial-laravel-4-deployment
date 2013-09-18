<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class EnvironmentRemoveCommand
extends EnvironmentCommand
{
    protected $name = "environment:remove";

    protected $description = "Removes the current host name from the provided environment.";

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

        foreach ($config[$environment] as $index => $item)
        {
            if ($item == $use)
            {
                unset($config[$environment][$index]);
            }
        }

        $this->setConfig($config);

        $this->line("<info>Removed</info> <comment>" . $use . "</comment> <info>from</info> <comment>" . $environment . "</comment> <info>environment.</info>");
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