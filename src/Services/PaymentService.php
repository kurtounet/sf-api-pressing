<?php

namespace App\Services;



use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PaymentService
{
    /*
    private StripeClient $stripeClient;

    public function __construct(string $stripeSecretKey)
    {
        $this->stripeClient = new StripeClient($stripeSecretKey);
    }

    public function createPaymentIntent(float $amount, string $currency = 'eur', array $metadata = []): JsonResponse
    {
        try {
            $paymentIntent = $this->stripeClient->paymentIntents->create([
                'amount' => intval($amount * 100), // Stripe attend un montant en centimes
                'currency' => $currency,
                'metadata' => $metadata,
            ]);

            return new JsonResponse(['clientSecret' => $paymentIntent->client_secret], Response::HTTP_OK);
        } catch (ApiErrorException $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function retrievePaymentIntent(string $paymentIntentId): JsonResponse
    {
        try {
            $paymentIntent = $this->stripeClient->paymentIntents->retrieve($paymentIntentId);
            return new JsonResponse($paymentIntent, Response::HTTP_OK);
        } catch (ApiErrorException $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
        */
}
