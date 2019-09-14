<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Observers\OrderObserver;
use Illuminate\Support\Facades\Mail;

class Order extends Model
{
    //
    protected $fillable = ['client_email', 'partner_id', 'status'];

    const STATUSES = [
        0 => 'Новый',
        10 => 'Подтвержден',
        20 => 'Завершен',
    ];

    public static function boot()
    {
        Order::observe(OrderObserver::class);
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function totalSum()
    {
        $total = 0;
        foreach ($this->products as $product) {
            $total += ($product->price * $product->quantity);
        }
        return $total;
    }

    public function getProductsNamesAttribute()
    {
        $out = [];
        foreach ($this->products as $product) {
            $out[] = $product->product->name;
        }
        return join(', ', $out);
    }

    public function sendMails()
    {
        $emails = [];
        $emails[] = $this->partner->email;

        foreach ($this->products as $product) {
            $emails[] = $product->product->vendor->email;
        }

        $emails = array_unique($emails);

        foreach ($emails as $email) {
            $this->sendMail($email);
        }
    }

    public function sendMail(string $email)
    {
        $id = $this->id;
        Mail::send('orders.email', ['order' => $this], function ($message) use ($email, $id) {
            $message->from(env('MAIL_USERNAME', false));

            $message->to($email);

            $message->subject("Заказ №{$id} завершен");
        });
    }
}
