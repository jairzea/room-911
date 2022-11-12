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
        DB::statement("INSERT INTO `department` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
        (1, 'Logistic', 'Departmen logistic 1', '2021-01-27 05:22:27', '2021-01-27 07:53:03'),
        (2, 'Logistic 2', 'Departmen logistic 2', '2021-01-27 05:23:15', '2021-01-27 07:44:51'),
        ");
    }
};
