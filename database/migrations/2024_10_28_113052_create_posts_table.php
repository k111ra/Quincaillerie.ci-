<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreatePostsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    $hasSlug = Schema::hasColumn('posts', 'slug');
    $hasDetails = Schema::hasColumn('posts', 'details');
    $hasDescription = Schema::hasColumn('posts', 'description');
    $hasUserId = Schema::hasColumn('posts', 'user_id');

    Schema::table('posts', function (Blueprint $table) use ($hasSlug, $hasDetails, $hasDescription, $hasUserId) {
      if (!$hasSlug) {
        $table->string('slug')->nullable();
      }
      if (!$hasDetails) {
        $table->text('details')->nullable();
      }
      if (!$hasDescription) {
        $table->text('description')->nullable();
      }
      if (!$hasUserId) {
        $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
      }
    });

    $columns = ['id', 'title'];
    if (Schema::hasColumn('posts', 'content')) {
      $columns[] = 'content';
    }

    foreach (DB::table('posts')->select($columns)->orderBy('id')->cursor() as $post) {
      $updates = [];
      if (!$post->slug) {
        $slug = Str::slug($post->title) ?: "post-{$post->id}";
        $updates['slug'] = "{$slug}-{$post->id}";
      }
      if (isset($post->content)) {
        if (!$post->details) {
          $updates['details'] = $post->content;
        }
        if (!$post->description) {
          $updates['description'] = $post->content;
        }
      }
      if ($updates) {
        DB::table('posts')->where('id', $post->id)->update($updates);
      }
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('posts', function (Blueprint $table) {
      $table->dropForeign(['user_id']);
      $table->dropColumn(['slug', 'details', 'description', 'user_id']);
    });
  }
}
