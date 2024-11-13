<?php

namespace App\Services;


use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\StripeClient;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PaymentService
{
    private StripeClient $stripeClient;
    private $params;
    private UrlGeneratorInterface $urlGenerator;
    private EntityManagerInterface $entityManager;
    private CalculateTotalAmountService $amountService;

    public function __construct(
        CalculateTotalAmountService $amountService,
        EntityManagerInterface $entityManager,
        ParameterBagInterface $params,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->amountService = $amountService;
        $this->entityManager = $entityManager;
        $this->params = $params;
        $this->urlGenerator = $urlGenerator;
        $key = $this->params->get('app.secretStripe');
        $this->stripeClient = new StripeClient($key);
    }
    public function createCheckoutSession($Commande)
    {
        $productsStripe = [];
        $items = $Commande['items'];
        $currency = $this->params->get('app.currency');
        foreach ($items as $itemData) {
            $id = explode('/', $itemData['service']);
            $service = $this->entityManager->getRepository(Service::class)->find((int) end($id));
            if (!$service) {
                throw new \InvalidArgumentException('Service not found for item');
            }
            $productsStripe[] = [
                'price_data' => [
                    'currency' => $currency,
                    'unit_amount' => $service->getPrice() * 100,
                    'product_data' => [
                        'name' => $service->getName(),
                    ],
                ],
                'quantity' => $itemData['quantity'],
            ];
        }
        try {
            $checkout_session = $this->stripeClient->checkout->sessions->create([
                'payment_method_types' => ['card'],
                'line_items' => $productsStripe,
                'mode' => 'payment',
                'success_url' => $this->urlGenerator->generate('api_payment_success', [], UrlGeneratorInterface::ABSOLUTE_URL),
                'cancel_url' => $this->urlGenerator->generate('api_payment_cancel', [], UrlGeneratorInterface::ABSOLUTE_URL),
            ]);

            return ['id' => $checkout_session->id];
        } catch (ApiErrorException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
/* 
$checkout_session = $this->stripeClient->checkout->sessions->create([
        //     // 'line_items' => [
        //     //     [
        //     //         # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
        //     //         'price' => '{{PRICE_ID}}',
        //     //         'quantity' => 1,
        //     //     ]
        //     // ],
        //     'line_items' => $line_items,
        //     'mode' => 'payment',
        //     'success_url' => $YOUR_DOMAIN . '/success.html',
        //     'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
        // ]);
   
     
        

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



// require_once '../vendor/autoload.php';
// require_once '../secrets.php';

// \Stripe\Stripe::setApiKey($stripeSecretKey);
// header('Content-Type: application/json');

// $YOUR_DOMAIN = 'http://localhost:4242';

// $checkout_session = \Stripe\Checkout\Session::create([
//   'line_items' => [[
//     # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
//     'price' => '{{PRICE_ID}}',
//     'quantity' => 1,
//   ]],
//   'mode' => 'payment',
//   'success_url' => $YOUR_DOMAIN . '/success.html',
//   'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
// ]);

// header("HTTP/1.1 303 See Other");
// header("Location: " . $checkout_session->url);