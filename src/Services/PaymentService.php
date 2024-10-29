<?php

namespace App\Services;

use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Stripe;
use Stripe\StripeClient;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PaymentService
{
    private StripeClient $stripeClient;
    private $params;


    public function __construct(
        private CalculateTotalAmountService $amountService,
        private EntityManagerInterface $entityManager,
        ParameterBagInterface $params
    ) {
        $this->params = $params;
        $key = $this->params->get('app.secretStripe');
        $this->stripeClient = new StripeClient($key);
    }
    public function execute($Commande)
    {
        /*
                $productsStripe = [];
                $items = $Commande['items'];
                $currency = $this->params->get('app.currency');
                // $amount = $this->amountService->calculateTotalAmount($items);
                // $currency = 'eur';
                // $metadata = [
                //     'commandes' => json_encode($Commande),
                // ];
                // $YOUR_DOMAIN = 'https://localhost:8001';

                $domain = $_SERVER['HTTP_HOST'];
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
                    // $line_items[] = ['id' => $service->getId(), 'price' => $service->getPrice(), 'quantity' => $itemData['quantity']];
                }
                //dd($productsStripe);
                // Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);
                $checkout_session = $this->stripeClient->checkout->sessions->create([
                    'payment_method_types' => ['card'],
                    'line_items' => $productsStripe,
                    'mode' => 'payment',
                    // 'success_url' => $_SERVER['HTTP_HOST'] . 'success',
                    // 'cancel_url' => $_SERVER['HTTP_HOST'] . 'cancel',
                ]);
                dd($checkout_session);
                return $checkout_session;
                */
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