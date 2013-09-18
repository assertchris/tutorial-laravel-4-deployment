<?php

use Illuminate\Console\Command;

class EnvironmentCommand
extends Command
{
    protected $name = "environment";

    protected $description = "Provides help when using the environment commands.";

    public function fire()
    {
        $this->line("<comment>environment:get</comment> <info>gets the current host and environment.</info>");
        $this->line("<comment>environment:set</comment> <info>adds the current host name to the provided environment.</info>");
        $this->line("<comment>environment:remove</comment> <info>removes the current host name from the provided environment.</info>");
    }

    protected function getArguments()
    {
        return [];
    }

    protected function getOptions()
    {
        return [];
    }

    protected function getHost()
    {
        return gethostname();
    }

    protected function getEnvironment()
    {
        return App::environment();
    }

    protected function getPath()
    {
        return app_path() . "/config/environment.php";
    }

    protected function getConfig()
    {
        $environments = require $this->getPath();

        if (!is_array($environments))
        {
            $environments = [];
        }

        return $environments;
    }

    protected function setConfig($config)
    {
        $code = "<?php\n\nreturn [";

        foreach ($config as $environment => $hosts)
        {
            $code .= "\n    \"" . $environment . "\" => [";

            foreach ($hosts as $host)
            {
                $code .= "\n        \"" . $host . "\",";
            }

            $code = trim($code, ",");
            $code .= "\n    ],";
        }

        $code = trim($code, ",");
        File::put($this->getPath(), $code . "\n];");
    }
}