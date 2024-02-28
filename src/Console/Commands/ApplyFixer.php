<?php

namespace Bolideai\CsFixer\Console\Commands;

use Illuminate\Console\Command;

class ApplyFixer extends Command
{
    private string $fixerPath = './vendor/bin/php-cs-fixer';

    private string $rules;

    private array $defaultFolders = [
        'app',
        'tests',
        'config',
        'database',
        'routes',
    ];

    protected $signature = 'bolide:cs-fix
        {folders? : Checked folders.}
    ';

    protected $description = 'Run PHP CS Fixer';

    public function __construct()
    {
        parent::__construct();

        $this->rules = json_encode(config('cs-fixer'));
    }

    public function handle()
    {
        $folders = $this->argument('folders')
            ? $this->argument('folders')
            : implode(',', $this->defaultFolders);

        $this->info('************');

        foreach (explode(',', $folders) as $folder) {
            $this->execFixer($folder);
        }

        $this->info('************');
        $this->info(PHP_EOL);
    }

    private function execFixer(string $folder)
    {
        if (! is_dir($folder)) {
            return $this->warn("The directory does not exist: {$folder}");
        }

        $result = exec($this->fixerPath . " fix $folder/ --verbose --show-progress=bar --using-cache=no --rules='{$this->rules}'");

        $this->info("Folder {$folder}: " . $result);
    }
}
