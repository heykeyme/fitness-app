<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('membership_plan_id')->constrained();
            $table->foreignId('payment_method_id')->constrained();
            $table->foreignId('status_id')->constrained('status_types');
            $table->dropForeign(['subscription_id']);
            $table->dropColumn('subscription_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['membership_plan_id']);
            $table->dropColumn('membership_plan_id');
            $table->dropForeign(['payment_method_id']);
            $table->dropColumn('payment_method_id');
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
            $table->foreignId('subscription_id')->constrained();
        });
    }
}
