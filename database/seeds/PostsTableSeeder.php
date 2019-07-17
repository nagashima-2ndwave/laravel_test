<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // データベースにテストデータを登録できる
        // posts tableを全件削除
        DB::table('posts')->truncate();
        // 3つのApp\Postインスタンスを作成
           factory(App\Post::class, 3)
            ->create()
            ->each(function ($post) {
                $comments = factory(App\Comment::class, 2)->make();
                $post->comments()->saveMany($comments);
           });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
