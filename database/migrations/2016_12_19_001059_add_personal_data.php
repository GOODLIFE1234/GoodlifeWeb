<?php

use Illuminate\Database\Migrations\Migration;

class AddPersonalData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profile', function ($table) {
            $table->double('challenge',10,2)->default(100);
            $table->double('percent',10,2)->default(10);
            $table->double('record',10,2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profile', function ($table) {
            $table->dropColumn('challenge');
            $table->dropColumn('percent');
            $table->dropColumn('record');
        });
    }
}
