<?php

namespace Tests\Feature\Payments;

use App\Constants\Currency;
use App\Constants\DocumentTypes;
use App\Constants\PaymentGateway;
use App\Constants\PaymentStatus;
use App\Models\Category;
use App\Models\Site;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class StorePaymentTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function itStoresPaymentSuccessfully(): void
    {
        $responseData = [
            'status' => [
                'status' => 'OK',
                'reason' => 'PC',
                'message' => 'Respuesta falsa',
                'date' => '2021-11-30T15:08:27-05:00',
            ],
            'requestId' => 1,
            'processUrl' => 'https://checkout-co.placetopay.com/session/1/cc9b8690b1f7228c78b759ce27d7e80a',
        ];

        Http::fake(fn (Request $request) => Http::response($responseData, 200));

        $site = Site::factory()->for(Category::factory()->create())->create();
        $user = User::factory()->create();

        $data = [
            'description' => fake()->sentence(),
            'amount' => 10000,
            'site_id' => $site->id,
            'currency' => Currency::USD->name,
            'name' => 'John',
            'last_name' => 'Doe',
            'email' => fake()->freeEmail,
            'document_number' => 12123123123,
            'document_type' => DocumentTypes::CC->name,
            'gateway' => PaymentGateway::PLACETOPAY->value,
        ];

        $response = $this->post(route('payments.store'), $data);

        $response->assertSessionHasNoErrors()
            ->assertRedirect($responseData['processUrl']);

        $this->assertDatabaseHas('payments', [
            'user_id' => $user->id,
            'site_id' => $site->id,
            'description' => $data['description'],
            'amount' => 10000,
            'gateway' => PaymentGateway::PLACETOPAY->value,
            'status' => PaymentStatus::PENDING->value,
            'process_identifier' => $responseData['requestId'],
        ]);
    }
}
