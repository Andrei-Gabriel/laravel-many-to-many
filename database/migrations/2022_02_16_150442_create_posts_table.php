<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creazione colonne della tabella in PHPMyAdmin
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("title", 100);
            // Slug per una questione di CEO
            $table->string("slug", 110)->unique();
            $table->text("content");
            $table->boolean("published")->default(false);
            $table->timestamps();
            // ```powershell``` php artisan migrate per eseguire le migrations
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
