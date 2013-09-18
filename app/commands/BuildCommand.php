<?php

use Illuminate\Console\Command;

class BuildCommand
extends Command
{
    protected $name = "build";

    protected $description = "Builds combined/minified resource files.";

    public function fire()
    {
        $sections = Config::get("asset");

        foreach ($sections as $section => $assets)
        {
            foreach ($assets as $output => $input)
            {
                if (!is_string($output))
                {
                    continue;
                }

                if (!is_array($input))
                {
                    $input = [$input];
                }

                $input = join(",", $input);

                $options = [
                    "--output" => $output,
                    "input"    => $input
                ];

                if (ends_with($output, ".min.css"))
                {
                    $options["type"] = "css";
                    $this->call("asset:minify", $options);
                }
                else if (ends_with($output, ".min.js"))
                {
                    $options["type"] = "js";
                    $this->call("asset:minify", $options);
                }
                else
                {
                    $this->call("asset:combine", $options);
                }
            }
        }
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