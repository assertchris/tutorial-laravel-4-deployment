<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class DistributeCommand
extends Command
{
    protected $name = "distribute";

    protected $description = "Distributes changes to a target.";

    public function fire()
    {
        $host   = $this->argument("host");
        $target = $this->option("target");

        if (!$target)
        {
            $target = "../distribution";
        }

        $url  = Config::get("host." . $host . ".url");
        $path = Config::get("host." . $host . ".path");

        $command = "rsync --verbose --progress --stats --compress --recursive --times --perms -e ssh " . $target . "/ " . $url . ":" . $path . "/";
        $escaped = escapeshellcmd($command);

        $this->line("<info>Synchronizing distribution files to</info> <comment>" . $host . " (" . $url . ")</comment><info>.</info>");

        exec($escaped, $output);

        foreach ($output as $line)
        {
            if (starts_with($line, "Number of files transferred"))
            {
                $parts = explode(":", $line);
                $this->line("<comment>" . trim($parts[1]) . "</comment> <info>files transferred.</info>");
            }

            if (starts_with($line, "Total transferred file size"))
            {
                $parts = explode(":", $line);
                $this->line("<comment>" . trim($parts[1]) . "</comment> <info>transferred.</info>");
            }
        }
    }

    protected function getArguments()
    {
        return [
            ["host", InputArgument::REQUIRED, "The name of the host to synchronise distribution files to."]
        ];
    }

    protected function getOptions()
    {
        return [
            ["target", null, InputOption::VALUE_OPTIONAL, "The target path for the distribution folder.", null]
        ];
    }
}