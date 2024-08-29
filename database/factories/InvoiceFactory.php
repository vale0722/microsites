<?php

namespace Database\Factories;

use App\Constants\Currency;
use App\Models\Import;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $now = Carbon::now();

        return [
            'reference' => $now->format('ymd').'-'.strtoupper(Str::random(6)),
            'amount' => 1000,
            'currency' => Currency::COP->name,
            'customer_name' => fake()->name(),
            'dni' => fake()->randomNumber(7),
            'description' => fake()->sentence(),
            'created_at' => $now->toDateTimeString(),
            'expired_at' => $now->addMonth()->toDateTimeString(),
            'import_id' => Import::factory(),
        ];
    }
}
