<?php

namespace Bolideai\CsFixer\Console\Commands;

use Illuminate\Console\Command;

class ApplyFixer extends Command
{
    private const FIXER = './vendor/bin/php-cs-fixer';

    protected $signature = 'bolide:cs-fix {--dry-run}';

    protected $description = 'Run PHP CS Fixer';

    public function handle()
    {
        $isDryRun = $this->option('dry-run');

        $additionalParameter = $isDryRun
            ? '--dry-run'
            : '';

        $func = $isDryRun
            ? 'shell_exec'
            : 'exec';

        $result = $func(self::FIXER . " fix $additionalParameter app/ tests/ config/ database/ routes/ --config=\"" . __DIR__ . '/../../resources/.php-cs-fixer.dist.php'. '"');

        $this->info($result);
    }
}
