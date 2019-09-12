<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = ['client_email', 'partner_id', 'status'];

    const STATUSES = [
        0 => 'Новый',
        10 => 'Подтвержден',
        20 => 'Завершен',
    ];

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
}
