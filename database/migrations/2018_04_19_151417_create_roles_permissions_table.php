<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Roles and permissions relation table
         */
        Schema::create('roles_permissions', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('permission_id')->unsigned();

            /*
             * Add Foreign/Unique/Index
             */
            $table->foreign('role_id', 'foreign_role')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');

            $table->foreign('permission_id', 'foreign_permission')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade');

            $table->unique(['role_id', 'permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles_permissions', function (Blueprint $table) {
            $table->dropForeign('foreign_role');
            $table->dropForeign('foreign_permission');
        });

        /*
         * Drop tables
         */
        Schema::dropIfExists('roles_permissions');
    }
}
