<?php
use App\Post;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/createUser', function () {
   $user = \App\User::create(['name'=>'Tuan', 'email'=>'vantuan@gmail.com', 'password'=>bcrypt('123')]);
   return $user;
});

Route::get('user/{id}/createpost', function ($id){
   $user = \App\User::findOrFail($id);
//    $post = new \App\Post(['title'=>'Python']);

   $post = new Post();
   $post->title = 'Python';

   return $user->posts()->save($post);
});

Route::get('post/update', function () {
   $post = \App\Post::where('id', 2);   //where('id','=',2)
   return $post->update(['title'=>'Javascript']);
});



Route::get('readpost', function () {
   return \App\Post::all();
});

Route::get('readpost/{id}', function ($id) {
    $post = \App\Post::findOrFail($id);
    return $post;
    // $user = \App\User::findOrFail($id);
    // return $user->posts;
});

Route::get('user/{id}/post', function ($id) {
    $user = \App\User::findOrFail($id);

    // dd($user->posts);

    foreach ($user->posts as $post) {
        echo $post->title . "<br>";
    }

    // return $user->posts;

});

Route::get('user/{id}/updatepost', function ($id) {
    $user = \App\User::findOrFail($id);
//    return $user->posts()->where('id', 2)->update(['title'=>'Javascript Update']);
    // return $user->posts()->whereId(2)->update(['title'=>'Javascript Update']);
    return $user->posts()->where('title','Python')->update(['title'=>'Python Update']);

});

Route::get('user/{id}/postupdate', function($id){
    $user = \App\User::findOrFail($id);
    $post = $user->posts->where('title','ASP');
    // dd($post);
    foreach ($post as $p) {
        $p->title = 'Python';
        $p->save();
    }
    // return $post[0];
});

Route::get('user/{id}/delete', function ($id) {
    $user = \App\User::findOrFail($id);
    return $user->posts()->delete();
});








