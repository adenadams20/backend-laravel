<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            // Modifier description si existante
            if (Schema::hasColumn('hotels', 'description')) {
                $table->text('description')->nullable()->change();
            }

            // Ajouter les colonnes seulement si elles n'existent pas
            if (!Schema::hasColumn('hotels', 'address')) {
                $table->string('address')->nullable();
            }

            if (!Schema::hasColumn('hotels', 'email')) {
                $table->string('email')->nullable();
            }

            if (!Schema::hasColumn('hotels', 'phone')) {
                $table->string('phone')->nullable();
            }

            if (!Schema::hasColumn('hotels', 'price')) {
                $table->decimal('price', 10, 2)->nullable();
            } else {
                $table->decimal('price', 10, 2)->nullable()->change();
            }

            if (!Schema::hasColumn('hotels', 'currency')) {
                $table->string('currency', 5)->nullable();
            } else {
                $table->string('currency', 5)->nullable()->change();
            }

            // Ajouter image si elle n'existe pas
            if (!Schema::hasColumn('hotels', 'image')) {
                $table->string('image')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            if (Schema::hasColumn('hotels', 'address')) {
                $table->dropColumn('address');
            }

            if (Schema::hasColumn('hotels', 'email')) {
                $table->dropColumn('email');
            }

            if (Schema::hasColumn('hotels', 'phone')) {
                $table->dropColumn('phone');
            }

            if (Schema::hasColumn('hotels', 'price')) {
                $table->dropColumn('price');
            }

            if (Schema::hasColumn('hotels', 'currency')) {
                $table->dropColumn('currency');
            }

            if (Schema::hasColumn('hotels', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
};
