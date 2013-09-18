<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class CleanCommand
extends Command
{
    protected $name = "clean";

    protected $description = "Removes development files from a distribution folder.";

    public function fire()
    {
        $target = $this->option("target");

        if (!$target)
        {
            $target = "../distribution";
        }

        $cleaned = Config::get("clean");

        foreach ($cleaned as $pattern)
        {
            $paths = File::glob($target . "/" . $pattern);

            foreach ($paths as $path)
            {
                if (File::isFile($path))
                {
                    File::delete($path);
                }

                if (File::isDirectory($path))
                {
                    File::deleteDirectory($path);
                }
            }

            $this->line("<info>Deleted all files/folders matching</info> <comment>" . $pattern . "</comment><info>.</info>");
        }
    }

    protected function getArguments()
    {
        return [];
    }

    protected function getOptions()
    {
        return [
            ["target", null, InputOption::VALUE_OPTIONAL, "The target path for the distribution folder.", null]
        ];
    }
}