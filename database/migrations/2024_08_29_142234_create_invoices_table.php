<?php

use App\Constants\Currency;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 40)->unique();
            $table->unsignedBigInteger('amount');
            $table->enum('currency', Currency::toArray());
            $table->string('customer_name', 100);
            $table->string('dni', 40);
            $table->string('description', 512);

            $table->foreignId('import_id');
            $table->foreign('import_id')
                ->references('id')
                ->on('imports');

            $table->date('expired_at');
            $table->date('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
