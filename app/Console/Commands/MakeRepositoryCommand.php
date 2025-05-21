<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class MakeRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Repository , Interface and Service from A Given Model Name';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        // convert it to model convential name
        $model = Str::studly($name);
        $fileSystem = new Filesystem;

        $interfaceFilePath = app_path("Repositories/Interfaces/{$model}RepositoryInterface.php");
        $repoFilePath = app_path("Repositories/{$model}Repository.php");

        if(!file_exists(app_path("Repositories/Interfaces"))){
            $fileSystem->makeDirectory(app_path("Repositories/Interfaces"),0775,true);
        };

        $interfaceStub = $fileSystem->get(app_path("Stubs/repository.interface.stub"));
        $repoStub = $fileSystem->get(app_path("Stubs/repository.stub"));

        $interfaceContent = str_replace("{{ model }}",$model,$interfaceStub);
        $repoContent = str_replace("{{ model }}",$model,$repoStub);
        $repoContent = str_replace("camelCase",Str::camel($model),$repoContent);


        
        $fileSystem->put($interfaceFilePath,$interfaceContent);
        $fileSystem->put($repoFilePath,$repoContent);

        if(!file_exists(app_path("Services"))){
            $fileSystem->makeDirectory(app_path("Services"));
        };

        $serviceFilePath = app_path("Services/{$model}Service.php");

        $serviceStub = $fileSystem->get(app_path("Stubs/service.stub"));
        $serviceContent = str_replace("{{ model }}",$model,$serviceStub);
        $fileSystem->put($serviceFilePath,$serviceContent);

        $this->info("Repository , Interface and Service Created Successfully");
    }
}
