<?php

namespace App\Notifications;


use Illuminate\Notifications\Notification;

class ProductCreatedNotification extends Notification
{
    public function __construct(public $product) {}

    public function via($notifiable)
    {
        return ['database']; // or mail
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Product created: ' . $this->product->name,
        ];
    }
}
