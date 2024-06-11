<?php

use Database\Seeders\CategorySeeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\UserSeeder;
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
        $categorySeeder = new CategorySeeder();
        $userSeeder = new UserSeeder();
        $postSeeder = new PostSeeder();

        $userSeeder->run();
        $categorySeeder->run();
        $postSeeder->run();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
