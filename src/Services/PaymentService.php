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
 