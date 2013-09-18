<?php

use Minifier\MinFilter;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class AssetMinifyCommand
extends AssetCommand
{
    protected $name = "asset:minify";

    protected $description = "Minifies multiple resource files.";

    public function fire()
    {
        $type    = $this->argument("type");
        $input   = $this->argument("input");
        $output  = $this->option("output");
        $filters = [];

        if ($type == "css")
        {
            $filters[] = new MinFilter("css");
        }

        if ($type == "js")
        {
            $filters[] = new MinFilter("js");
        }

        $combined = $this->getCollection($input, $filters)->dump();

        if ($output)
        {
            $this->line("<info>Successfully minified</info> <comment>" . $input . "</comment> <info>to</info> <comment>" . $output . "</comment><info>.</info>");
            $this->setOutput($output, $combined);
        }
        else
        {
            $this->line($combined);
        }
    }

    protected function getArguments()
    {
        return [
            ["type", InputArgument::REQUIRED, "Type of code being minified."],
            ["input", InputArgument::REQUIRED, "Comma-delimited names of files to concatenate."]
        ];
    }

    protected function getOptions()
    {
        return [
            ["output", null, InputOption::VALUE_OPTIONAL, "The optional path to save to.", null]
        ];
    }
}