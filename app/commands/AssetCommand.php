<?php

use Assetic\Asset\AssetCollection;
use Assetic\Asset\FileAsset;
use Illuminate\Console\Command;

class AssetCommand
extends Command
{
    protected $name = "asset";

    protected $description = "Provides help when using the asset commands.";

    public function fire()
    {
        $this->line("<comment>asset:combine</comment> <info>combines multiple resource files.</info>");
        $this->line("<comment>asset:minify</comment> <info>minifies multiple resource files.</info>");
    }

    protected function getArguments()
    {
        return [];
    }

    protected function getOptions()
    {
        return [];
    }

    protected function getPath()
    {
        return public_path();
    }

    protected function getCollection($input, $filters = [])
    {
        $input      = explode(",", $input);
        $collection = new AssetCollection([], $filters);

        foreach ($input as $asset)
        {
            $collection->add(new FileAsset($this->getPath() . "/" . $asset));
        }

        return $collection;
    }

    protected function setOutput($path, $content)
    {
        return File::put($this->getPath() . "/" . $path, $content);
    }
}