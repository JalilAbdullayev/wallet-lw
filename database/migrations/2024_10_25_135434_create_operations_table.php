<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('operations', function(Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('amount');
            $table->string('type');
            $table->json('tags')->nullable();
            $table->foreignId('category_id')->constrained('subcategories');
            $table->foreignId('account_id')->constrained('accounts');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void {
        Schema::dropIfExists('operations');
    }
};
