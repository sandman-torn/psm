<?php

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
        Schema::table('users', function (Blueprint $table) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('ic_no')->unique()->after('email'); // unique & store as string
                $table->string('position')->after('ic_no');
                $table->string('department')->after('position');
                $table->string('unit')->nullable()->after('department');
                $table->string('phone_no')->after('unit');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['ic_no', 'position', 'department', 'unit', 'phone_no']);
        });
    }
};
