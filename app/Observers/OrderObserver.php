<?php


namespace App\Observers;

use App\Order;

class OrderObserver
{
    public function updated(Order $order)
    {
        if ($order->status==20) {
            // отправляем уведомления
            $order->sendMails();
        }
    }
}