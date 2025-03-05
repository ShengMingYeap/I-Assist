<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MemberController::class, 'getRegisteredByDateJoin'])->name('member-registered-date');
Route::get('/question-two', [MemberController::class, 'topTen'])->name('top-ten');
Route::get('/question-three', [MemberController::class, 'calRefer'])->name('calculate-referral');
Route::get('/question-four', [MemberController::class, 'countMemberPurchase'])->name('calculate-member-purchase');
Route::get('/question-five', [MemberController::class, 'familyTreeChart'])->name('family-tree-chart');
