<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddPullRequestsTableIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pull_requests', function (Blueprint $table) {
            $table->index(['author_name'],'index_author_name');
            $table->index(['pr_id'],'index_pr_id');
            $table->index(['pr_merged_at'],'index_pr_merged_at');
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
            $table->dropIndex('index_author_name');
            $table->dropIndex('index_pr_id');
            $table->dropIndex('index_pr_merged_at');
        });
    }
}
