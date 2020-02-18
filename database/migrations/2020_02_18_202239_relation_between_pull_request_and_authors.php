<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelationBetweenPullRequestAndAuthors extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pull_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id')->nullable()->after('content');
            $table->foreign('author_id')->references('id')->on('pull_request_authors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pull_requests', function (Blueprint $table) {
            $table->dropColumn('author_id');
        });
    }
}
