<?php

use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function (Request $request) {
    return response('ok');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users_info', [APIController::class, 'get_users_info']);
Route::get('Debug', function () {
    $data = [];
    $data['website'] = 'Laravel-API';
    foreach (array_map('reset', \DB::select('SHOW TABLES')) as $table) {
        $data['tables'][]['table_name'] = $table;
        $data['tables'][sizeof($data['tables'])-1]['table_columns'] = \DB::getSchemaBuilder()->getColumnListing($table);
        $data['tables'][sizeof($data['tables'])-1]['table_rows'] = \DB::table($table)->get()->all();
    }
    return response()->json($data);
});
