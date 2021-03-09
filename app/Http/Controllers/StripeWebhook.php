<?php


namespace App\Http\Controllers;
use App\User;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class StripeWebhook extends CashierController
{

    public function handleInvoicePaymentSucceeded($payload)
    {
        $user = new User();
        $user->name ='Tahir';
        $user->email="tahir@gmail.com";
        $user->password="202020202";
        $user->save();
        // Handle The Event
    }
}
