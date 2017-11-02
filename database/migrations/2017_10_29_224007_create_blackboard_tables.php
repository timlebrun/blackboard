<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlackboardTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('thumbnail_url')->nullable();
            $table->string('production_url')->nullable();
            $table->string('development_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('github_url')->nullable();
            $table->timestamps();
        });

        Schema::create('user_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('can_edit_project')->default(false);
            $table->boolean('can_create_ticket')->default(false);
            $table->boolean('can_delete_ticket')->default(false);
            $table->boolean('can_update_ticket')->default(false);
        });

        Schema::create('project_users', function (Blueprint $table) {
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('user_role_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('user_role_id')->references('id')->on('user_roles');
        });

        // Tickets stuff

        Schema::create('ticket_priorities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('level', false, true)->default(0);
            $table->string('color')->nullable();
        });

        Schema::create('ticket_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('color')->nullable();
        });

        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_id');
            $table->string('title');
            $table->unsignedInteger('priority_id');
            $table->timestamps();
            $table->timestamp('ending_at')->nullable();

            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('priority_id')->references('id')->on('ticket_priorities');
        });

        Schema::create('ticket_updates', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ticket_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('status_id');
            $table->text('content');
            $table->timestamps();

            $table->foreign('ticket_id')->references('id')->on('tickets');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('ticket_statuses');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_updates');
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('ticket_statuses');
        Schema::dropIfExists('ticket_priorities');
        Schema::dropIfExists('project_users');
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('projects');
    }
}
