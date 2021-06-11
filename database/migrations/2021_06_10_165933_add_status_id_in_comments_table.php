<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusIdInCommentsTable extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->foreignId('status_id')->after('idea_id')->constrained();
        });

        \App\Models\Comment::where(fn($query) => $query->whereNull('status_id')->orWhere('status_id', ''))
            ->each(fn(\App\Models\Comment $comment) => $comment->update(['status_id' => 1]));
    }

    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('status_id');
        });
    }
}
