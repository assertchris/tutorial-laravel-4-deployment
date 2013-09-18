<?php

/*
|--------------------------------------------------------------------------
| Register The Artisan Commands
|--------------------------------------------------------------------------
|
| Each available Artisan command must be registered with the console so
| that it is available to be called. We'll register every command so
| the console gets access to each of the command object instances.
|
*/

Artisan::add(new AssetCommand);
Artisan::add(new AssetCombineCommand);
Artisan::add(new AssetMinifyCommand);

Artisan::add(new BuildCommand);

Artisan::add(new CleanCommand);
Artisan::add(new CopyCommand);
Artisan::add(new DistributeCommand);

Artisan::add(new EnvironmentCommand);
Artisan::add(new EnvironmentGetCommand);
Artisan::add(new EnvironmentSetCommand);
Artisan::add(new EnvironmentRemoveCommand);

Artisan::add(new WatchCommand);