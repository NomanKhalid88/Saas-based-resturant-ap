<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Notifications\ProductCreatedNotification;

class SendProductCreatedNotification implements ShouldQueue
{

    public function __construct(public $product) {}

    public function handle()
    {
        $user = auth()->user();

        $user->notify(new SendProductCreatedNotification($this->product));
    }
}
