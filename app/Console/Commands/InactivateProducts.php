<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Carbon\Carbon;

class InactivateProducts extends Command
{
    protected $signature = 'products:inactivate-old';
    protected $description = 'Checks products and sets them to inactive if needed.';

    public function handle()
    {
        $inactivatedCount = Product::where('active', true)
            ->where('updated_at', '<', Carbon::now()->subDays(30))
            ->update(['active' => false]);

        $this->info("Successfully set {$inactivatedCount} products to inactive.");
        
        return Command::SUCCESS;
    }
}