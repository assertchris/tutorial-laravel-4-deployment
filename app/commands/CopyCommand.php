<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class CopyCommand
extends Command
{
    protected $name = "copy";

    protected $description = "Creates a distribution folder.";

    public function fire()
    {
        $target = $this->option("target");

        if (!$target)
        {
            $target = "../distribution";
        }

        File::copyDirectory("./", $target);
        $this->line("<info>Successfully copied source files to</info> <comment>" . realpath($target) . "</comment><info>.</info>");
    }

    protected function getArguments()
    {
        return [];
    }

    protected function getOptions()
    {
        return [
            ["target", null, InputOption::VALUE_OPTIONAL, "The optional path to save to.", null]
        ];
    }
}