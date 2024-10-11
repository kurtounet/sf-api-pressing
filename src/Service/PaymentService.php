<?php
/*
namespace App\Service;

use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentService
{
    private $secretKey;

    public function __construct(string $secretKey)
    {
        $this->secretKey = $secretKey;
        Stripe::setApiKey($this->secretKey);
    }

    public function createPaymentIntent(float $amount, string $currency = 'usd'): PaymentIntent
    {
        return PaymentIntent::create([
            'amount' => $amount * 100, // Montant en centimes
            'currency' => $currency,
        ]);
    }

    public function confirmPayment(string $paymentIntentId): PaymentIntent
    {
        $paymentIntent = PaymentIntent::retrieve($paymentIntentId);
        return $paymentIntent->confirm();
    }

    public function refundPayment(string $paymentIntentId)
    {
        $paymentIntent = PaymentIntent::retrieve($paymentIntentId);
        return $paymentIntent->cancel(); // Simule un remboursement
    }
}
*/