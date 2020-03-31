<?php

use App\User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/search',function(Request $request){

    $query = $request->get('query');
    $users = User::where('username','like','%'.$query.'%')->with('profile')->get();
    return response()->json($users);
});
