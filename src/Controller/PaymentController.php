<?php
/*
use App\Service\PaymentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PaymentController extends AbstractController
{
    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function createPayment(Request $request): JsonResponse
    {
        $amount = $request->get('amount');
        $currency = $request->get('currency', 'usd');

        try {
            $paymentIntent = $this->paymentService->createPaymentIntent($amount, $currency);
            return new JsonResponse(['clientSecret' => $paymentIntent->client_secret]);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }

    public function confirmPayment(Request $request): JsonResponse
    {
        $paymentIntentId = $request->get('paymentIntentId');

        try {
            $paymentIntent = $this->paymentService->confirmPayment($paymentIntentId);
            return new JsonResponse(['status' => $paymentIntent->status]);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }

    public function refundPayment(Request $request): JsonResponse
    {
        $paymentIntentId = $request->get('paymentIntentId');

        try {
            $this->paymentService->refundPayment($paymentIntentId);
            return new JsonResponse(['status' => 'Payment refunded']);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }
}
*/