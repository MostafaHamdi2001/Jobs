<?php
namespace App\Jobs;

use App\Models\Product;
use App\Models\Color;
use App\Mail\ProductCreatedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessProductCreation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function handle()
    {
        $colorIds = Color::pluck('id')->toArray();
        $this->product->colors()->sync($colorIds);

        Mail::to(config('mail.from.address'))
            ->send(new ProductCreatedMail($this->product));
    }
}