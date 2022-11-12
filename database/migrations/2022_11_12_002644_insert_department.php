<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("INSERT INTO `departments` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
        (1, 'admin_room_911', 'Room manager 911', '2021-01-27 05:22:27', '2021-01-27 07:53:03'),
        ");
    }

    // INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES (NULL, 'Lope', 'Lope@mail.com', NULL, SHA1('123456'), '1', NULL, NULL, NULL);
   
};
