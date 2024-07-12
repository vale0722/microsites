<?php

namespace Tests\Unit;

use App\Constants\DocumentTypes;
use App\Constants\PaymentGateway as PaymentGateways;
use App\Contracts\PaymentGateway;
use App\Contracts\PaymentService as PaymentServiceContract;
use App\Models\Payment;
use App\Services\Payments\Gateways\PlacetoPayGateway;
use App\Services\Payments\PaymentResponse;
use App\Services\Payments\PaymentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Mocks\PlacetoPayGatewayMock;
use Tests\TestCase;

class PaymentServiceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function itProcessPaymentSuccessfullyUsingContainer(): void
    {
        $payment = Payment::factory()->create();

        $data = [
            'name' => 'John',
            'last_name' => 'Doe',
            'email' => fake()->freeEmail,
            'document_number' => 12123123123,
            'document_type' => DocumentTypes::CC->name,
        ];

        $this->app->bind(PaymentGateway::class, fn () => new PlacetoPayGatewayMock(function () {
            return new PaymentResponse(1, 'https://google.com');
        }));

        /** @var PaymentService $paymentService */
        $paymentService = app(PaymentServiceContract::class, ['payment' => $payment, 'gateway' => PaymentGateways::PLACETOPAY->value]);
        $response = $paymentService->create($data);

        $this->assertEquals(1, $response->processIdentifier);
        $this->assertEquals('https://google.com', $response->url);
    }

    /**
     * Mocks: Used to verify interactions between objects.
     *
     * @test
     */
    public function itProcessPaymentSuccessfullyUsingMocks(): void
    {
        $payment = Payment::factory()->create();

        $data = [
            'name' => 'John',
            'last_name' => 'Doe',
            'email' => fake()->freeEmail,
            'document_number' => 12123123123,
            'document_type' => DocumentTypes::CC->name,
        ];

        $placetopay = $this->createMock(PlacetoPayGateway::class);
        $placetopay->expects($this->once())
            ->method('prepare')
            ->willReturnSelf();

        $placetopay->expects($this->once())
            ->method('buyer')
            ->with($data)
            ->willReturnSelf();

        $placetopay->expects($this->once())
            ->method('payment')
            ->with($payment)
            ->willReturnSelf();

        $placetopay->method('process')
            ->willReturn(new PaymentResponse(1, 'https://placetopay.com'));

        $paymentService = new PaymentService($payment, $placetopay);
        $paymentService->create($data);
    }

    /**
     * Stubs: Used to return predetermined responses.
     *
     * @test
     */
    public function itProcessPaymentSuccessfullyUsingStubs(): void
    {
        $payment = Payment::factory()->create();

        $data = [
            'name' => 'John',
            'last_name' => 'Doe',
            'email' => fake()->freeEmail,
            'document_number' => 12123123123,
            'document_type' => DocumentTypes::CC->name,
        ];

        $placetopay = $this->createStub(PlacetoPayGateway::class);
        $placetopay->method('prepare')
            ->willReturnSelf();

        $placetopay->method('buyer')
            ->willReturnSelf();

        $placetopay->method('payment')
            ->willReturnSelf();

        $placetopay->method('process')
            ->willReturn(new PaymentResponse(1111, 'https://placetopay.com'));

        $paymentService = new PaymentService($payment, $placetopay);
        $response = $paymentService->create($data);

        $this->assertEquals(1111, $response->processIdentifier);
        $this->assertEquals('https://placetopay.com', $response->url);
    }
}
