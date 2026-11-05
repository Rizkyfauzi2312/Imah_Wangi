<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role')->default('customer');
            });
        }

        DB::table('users')->where('is_admin', true)->update(['role' => 'admin']);

        $columns = [
            'order_type'     => fn (Blueprint $t) => $t->string('order_type')->default('online'),
            'payment_method' => fn (Blueprint $t) => $t->string('payment_method')->nullable(),
            'amount_paid'    => fn (Blueprint $t) => $t->unsignedBigInteger('amount_paid')->nullable(),
            'change_amount'  => fn (Blueprint $t) => $t->unsignedBigInteger('change_amount')->nullable(),
            'customer_name'  => fn (Blueprint $t) => $t->string('customer_name')->nullable(),
        ];

        foreach ($columns as $name => $define) {
            if (!Schema::hasColumn('orders', $name)) {
                Schema::table('orders', function (Blueprint $table) use ($define) {
                    $define($table);
                });
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }
    }
};