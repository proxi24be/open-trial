<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_table', function (Blueprint $table) {
            $table->increments('jn_id');
            $table->string("jn_user");
            $table->string("jn_operation", 3);
            $table->string("jn_table");
            $table->integer("jn_pk");
            $table->string("jn_data", 8192);
            $table->integer("jn_json_schema_id");
            $table->timestamp("created_at");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('audit_table');
    }
}
