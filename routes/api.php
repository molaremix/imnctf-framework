<?php

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

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

Route::get('/', function (){
    return response()->json(['error' => 'absolutely TRUE', 'msg' => 'F*ck of']);
});


Route::get('/challenges', function (){
    CategoryResource::withoutWrapping();
    return CategoryResource::collection(Category::with('challenges')->get());
});

