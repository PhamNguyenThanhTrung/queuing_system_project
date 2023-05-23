<?php

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeTraitCommand extends Command
{
    protected $signature = 'make:trait {name}';

    protected $description = 'Create a new trait';

    public function handle()
    {
        $name = $this->argument('name');
        $filename = $name . '.php';

        $path = app_path('Traits') . '/' . $filename;

        if (File::exists($path)) {
            $this->error('Trait already exists!');
            return;
        }

        File::put($path, "<?php\n\nnamespace App\Traits;\n\trait $name\n{\n    // Code here\n}");

        $this->info('Trait created successfully!');
    }
}

