<?php
use Illuminate\Database\Migrations\Migration;

class UpdateFoodPlanner extends Migration
{
/**
 * Run the migrations.
 *
 * @return void
 */
    public function up()
    {
        Schema::table('food_planner', function ($table) {
            $table->text('today');
            $table->text('yesterday');

            $table->dropColumn('food_id');
            $table->dropColumn('amount');
        });
    }
/**
 * Reverse the migrations.
 *
 * @return void
 */
    public function down()
    {
        Schema::table('food_planner', function ($table) {
            $table->dropColumn('today');
            $table->dropColumn('yesterday');

            $table->integer('food_id');
            $table->integer('amount');
        });
    }
}
