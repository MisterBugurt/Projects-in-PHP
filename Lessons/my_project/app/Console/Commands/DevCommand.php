<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DevCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'develop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command some develops';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $var = 11111;
        return $var;
    }
}
