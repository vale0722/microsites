<?php

namespace App\Services\Payments;

use App\Contracts\PaymentGateway;
use App\Contracts\PaymentService as PaymentServiceContract;
use App\Models\Payment;

class PaymentService implements PaymentServiceContract
{
    public function __construct(
        protected Payment $payment,
        protected PaymentGateway $gateway,
    ) {
    }

    public function create(array $buyer): PaymentResponse
    {
        $response = $this->gateway->prepare()
            ->buyer($buyer)
            ->payment($this->payment)
            ->process();

        $this->payment->update([
            'process_identifier' => $response->processIdentifier,
        ]);

        return $response;
    }

    public function query(): Payment
    {
        $response = $this->gateway->prepare()
            ->get($this->payment);

        return tap($this->payment)->update([
            'status' => $response->status,
        ]);
    }
}
