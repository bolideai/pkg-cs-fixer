<?php

namespace Bolideai\CsFixer;

use Bolideai\CsFixer\Console\Commands\ApplyFixer;
use Illuminate\Support\ServiceProvider;

class CsFixerServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->commands([
            ApplyFixer::class,
        ]);
    }
}
