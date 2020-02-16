<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePullRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pull_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pr_id');
            $table->string('title');
            $table->string('url')->nullable();
            $table->text('content')->nullable();
            $table->timestamp('pr_created_at')->nullable();
            $table->timestamp('pr_merged_at')->nullable();
            $table->string('author_name')->nullable();
            $table->string('author_photo')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pull_requests');
    }
}
