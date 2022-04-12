<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\FormNumberConroller;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\CashAppController;
use App\Http\Controllers\Cashier\CashierController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FrontendSettingController;


use App\Http\Controllers\NotificationController;

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
Route::get('clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');

});
//front route
Route::get('/', function () {
    return view('welcome');
});
Route::get('/game/{x}', [FormNumberConroller::class, 'go'])->name('fire.go');
//formtest route
Route::get('/ohana',function()
{
   return view('test'); 
});
Route::get('/test1',function()
{
   return view('test2'); 
});


Route::post('add/form', [FormController::class, 'store'])->name('forms.stores');
Route::post('saveForm', [FormNumberConroller::class, 'store'])->name('forms.saveForm');
Route::post('saveNote', [FormNumberConroller::class, 'saveNote'])->name('forms.saveNote');
Route::post('checkCaptcha', [FormController::class, 'checkCaptcha'])->name('checkCaptcha');
Route::get('success', function () {
    return view('success');
});
Route::get('formsuccess', function () {
    return view('formsuccess');
});


//admin route
// Auth::routes();

Auth::routes([

  'register' => false, // Register Routes...

  'reset' => false, // Reset Password Routes...

  'verify' => false, // Email Verification Routes...

]);
// Route::get('admin/form/create', [FormController::class, 'create'])->name('forms.create');
Route::post('admin/update/form/{id}', [FormController::class, 'update'])->name('update.form');
Route::post('admin/destroy/form/{id}', [FormController::class, 'destroy'])->name('form.destroy');

Route::resource('forms', FormController::class);
Route::get('forms/edit/{id}', [FormController::class, 'edit'])->name('forms.edit');
Route::post('saveNoteForm', [FormController::class, 'saveNote'])->name('forms.saveNoteForm');
Route::get('forms/destroy/{id}', [FormController::class, 'destroy'])->name('forms.destroy');


// Route::get('/new-home', [App\Http\Controllers\HomeController::class, 'new-index'])->name('new-home');
Route::resource('/imageupload',ImageController::class);
Route::get('/show-image',[HomeController::class,'showImage'])->name('show.images');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/days', [App\Http\Controllers\HomeController::class, 'day'])->name('day');
Route::get('/home/yesterday', [App\Http\Controllers\HomeController::class, 'yesterday'])->name('yesterday');
Route::get('/home/tommorow', [App\Http\Controllers\HomeController::class, 'tommorow'])->name('tommorow');
Route::get('/home/image-upload',[App\Http\Controllers\HomeController::class,'imageUpload'])->name('image-upload');

Route::get('/home/colab', [App\Http\Controllers\HomeController::class, 'colab'])->name('colab');
Route::get('colab/destroy/{id}', [FormNumberConroller::class, 'destroy'])->name('colab.destroy');
Route::post('colab/update/', [FormNumberConroller::class, 'update'])->name('colab.update');

Route::get('/deleted-players',[App\Http\Controllers\HomeController::class, 'deletedPlayers'])->name('deleted.players');
Route::get('players/restore/{id}', [FormController::class, 'restorePlayers'])->name('forms.restore');
Route::get('players/fdestroy/{id}', [FormController::class, 'forceDeletePlayers'])->name('forms.fdestroy');

Route::get('/dashboard', [App\Http\Controllers\NewHomeController::class, 'dashboard'])->name('dashboard');
Route::post('/change-color', [App\Http\Controllers\NewHomeController::class, 'changeColor'])->name('change-color');
Route::get('/gamers', [App\Http\Controllers\NewHomeController::class, 'gamers'])->name('gamers');
Route::get('/gamers/edit/{id}', [App\Http\Controllers\NewHomeController::class, 'gamerEdit'])->name('gamerEdit');
Route::post('/gamers/update/{id}', [App\Http\Controllers\NewHomeController::class, 'gamerUpdate'])->name('gamerUpdate');
Route::get('/gamers/destroy/{id}', [App\Http\Controllers\NewHomeController::class, 'gamerDestroy'])->name('gamerDestroy');
Route::get('/inactive-players/{id}', [App\Http\Controllers\NewHomeController::class, 'inactivePlayers'])->name('inactive-players');

Route::post('/gamers/update-balance', [App\Http\Controllers\NewHomeController::class, 'gamerUpdateBalance'])->name('gamerUpdateBalance');



Route::get('/spinner', [App\Http\Controllers\NewHomeController::class, 'spinner'])->name('spinner');
Route::get('/table', [App\Http\Controllers\NewHomeController::class, 'table'])->name('table');
Route::post('/table-loadBalance', [App\Http\Controllers\NewHomeController::class, 'tableUpdate'])->name('tableUpdate');
Route::post('/table-loadCashBalance', [App\Http\Controllers\NewHomeController::class, 'loadCashBalance'])->name('loadCashBalance');
Route::post('/table-referBalance', [App\Http\Controllers\NewHomeController::class, 'referBalance'])->name('referBalance');
Route::post('/table-redeemBalance', [App\Http\Controllers\NewHomeController::class, 'redeemBalance'])->name('redeemBalance');
Route::post('/table-tipBalance', [App\Http\Controllers\NewHomeController::class, 'tipBalance'])->name('tipBalance');
Route::post('/add-user', [App\Http\Controllers\NewHomeController::class, 'addUser'])->name('addUser');
Route::post('/user-history', [App\Http\Controllers\NewHomeController::class, 'userHistory'])->name('user-history');
Route::get('/all-history', [App\Http\Controllers\NewHomeController::class, 'allHistory1'])->name('all-history');
Route::get('/all-history1', [App\Http\Controllers\NewHomeController::class, 'allHistory'])->name('all-history1');
Route::get('/todays-history', [App\Http\Controllers\NewHomeController::class, 'todaysHistory'])->name('todays-history');
Route::post('/filter-user-history', [App\Http\Controllers\NewHomeController::class, 'filterUserHistory'])->name('filter-user-history');
Route::post('/filter-all-history', [App\Http\Controllers\NewHomeController::class, 'filterAllHistory'])->name('filter-all-history');
Route::get('/gamers/restore/{id}', [App\Http\Controllers\NewHomeController::class, 'gamerRestore'])->name('gamerRestore');
Route::get('/undo-history', [App\Http\Controllers\NewHomeController::class, 'undoHistory'])->name('undo-history');
Route::get('/undo-table/{id}', [App\Http\Controllers\NewHomeController::class, 'undoTable'])->name('undo-table');
Route::post('/export', [App\Http\Controllers\NewHomeController::class, 'export'])->name('export');
Route::post('/remove-form-game', [App\Http\Controllers\NewHomeController::class, 'removeFormGame'])->name('remove-form-game');

// Route::get('/all-history1', [App\Http\Controllers\NewHomeController::class, 'allHistory1'])->name('all-history1');
Route::get('/games', [App\Http\Controllers\NewHomeController::class, 'games'])->name('games');
Route::get('/games/edit/{id}', [App\Http\Controllers\NewHomeController::class, 'gameEdit'])->name('gameEdit');
Route::post('/games/update/{id}', [App\Http\Controllers\NewHomeController::class, 'gameUpdate'])->name('gameUpdate');
Route::get('/games/destroy/{id}', [App\Http\Controllers\NewHomeController::class, 'gameDestroy'])->name('gameDestroy');
Route::post('/games/store/', [App\Http\Controllers\NewHomeController::class, 'gameStore'])->name('gameStore');
Route::post('/games/images/store/', [App\Http\Controllers\NewHomeController::class, 'gameImageStore'])->name('gameImageStore');

Route::get('/gamers-games', [App\Http\Controllers\NewHomeController::class, 'gamerGames'])->name('gamerGames');


Route::get('/user-spinner', [App\Http\Controllers\NewHomeController::class, 'userSpinner'])->name('userSpinner');
Route::get('/report', [App\Http\Controllers\NewHomeController::class, 'report'])->name('report');

Route::get('/dashboard/colab', [App\Http\Controllers\NewHomeController::class, 'colab'])->name('dashboard.colab');
Route::get('/dashboard/colab/edit/{id}', [App\Http\Controllers\NewHomeController::class, 'editColab'])->name('dashboardColab.edit');
Route::get('/dashboard/colab/destroy/{id}', [App\Http\Controllers\NewHomeController::class, 'destroyColab'])->name('dashboardColab.destroy');
Route::post('/dashboard/colab/update/', [App\Http\Controllers\NewHomeController::class, 'updateColab'])->name('dashboardColab.update');
Route::get('/profile', [App\Http\Controllers\NewHomeController::class, 'profile'])->name('profile');



Route::get('send-mail', function () {

    $details = [
        'title' => 'Mail from ',
        'body' => 'This is for testing email using smtp'
    ];

    \Mail::to('Prasundahal@gmail.com')->send(new \App\Mail\MyTestMail($details));

    dd("Email is Sent.");
});
// Route::redirect('/fire/{x}', 'http://firekirin.xyz:8580/index.html');

Route::get('send-sms-notification', [NotificationController::class, 'sendSmsNotificaition']);
Route::get('send-sms', [NotificationController::class, 'sendSmsNotificaition'])->name('forms.sendsms');
Route::get('send-email-notification/{id}', [HomeController::class, 'sendemail'])->name('forms.sendmail');


Route::get('/admin/dashboard',[AdminController::class,'index'])->name('admin.index')->middleware('admin');
Route::get('cashier/dashboard',[CashierController::class,'index'])->name('cashier.index')->middleware('cashier');
Route::get('/logout',[AdminController::class,'logout'])->name('logout');
Route::get('/admin/login',[AdminController::class,'login'])->name('admin.login');
Route::get('/cashier/login',[CashierController::class,'login'])->name('cashier.login');
Route::get('/admin/credential',[AdminController::class,'getCredential'])->name('admin.credential')->middleware('admin');
Route::get('/admin/frontend',[AdminController::class,'getFrontend'])->name('admin.frontend')->middleware('admin');
Route::post('/admin/frontsetting',[FrontendSettingController::class,'storeGeneralSetting'])->name('admin.store.frontsetting')->middleware('admin');
Route::get('admin/image',[FrontendSettingController::class,'image'])->name('image')->middleware('admin');
Route::resource('/imageupload',ImageController::class);
Route::post('/changestatus',[ImageController::class,'updateStatus'])->name('image.update_status')->middleware('admin');

Route::get('/admin/colab', [App\Http\Controllers\HomeController::class, 'colab'])->name('colab')->middleware('admin');
Route::get('colab/edit/{id}', [FormNumberConroller::class, 'edit'])->name('colab.edit')->middleware('admin');
Route::get('colab/destroy/{id}', [FormNumberConroller::class, 'destroy'])->name('colab.destroy')->middleware('admin');
Route::post('colab/update/', [FormNumberConroller::class, 'update'])->name('colab.update')->middleware('admin');

Route::get('/admin/all_players', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.allplayers')->middleware('admin');
Route::get('/admin/show-image',[ImageController::class,'showImages'])->name('show.images')->middleware('admin');
Route::get('/table', [App\Http\Controllers\NewHomeController::class, 'table'])->name('table');
Route::post('/add-user', [App\Http\Controllers\NewHomeController::class, 'addUser'])->name('addUser');

Route::get('cashier/show_today',[CashierController::class,'showToday'])->name('cashier.showtoday');

Route::get('admin/games',[AdminController::class,'showGames'])->name('admin.games')->middleware('admin');
Route::get('admin/store-games',[AdminController::class,'storeAccount'])->name('store.games')->middleware('admin');
Route::post('admin/store-games',[AdminController::class,'storeGames'])->name('save.games')->middleware('admin');
Route::get('admin/edit-games/{id}',[AdminController::class,'editGames'])->name('edit.games')->middleware('admin');
Route::post('admin/update-games/{id}',[AdminController::class,'updateGames'])->name('update.games')->middleware('admin');
Route::post('/changegamestatus',[AdminController::class,'updateStatus'])->name('games.update_status')->middleware('admin');
Route::get('admin/del-games/{id}',[AdminController::class,'delGames'])->name('del.games')->middleware('admin');
Route::get('admin/trash-games',[AdminController::class,'trashGames'])->name('trash.games')->middleware('admin');
Route::get('admin/restore-games/{id}',[AdminController::class,'restoreGames'])->name('restore.games')->middleware('admin');
Route::get('admin/force-del-games/{id}',[AdminController::class,'forceDelGames'])->name('fdel.games')->middleware('admin');
Route::resource('admin/cashapp',CashAppController::class);
Route::get('admin/trash-cashapp',[CashAppController::class,'trashCashapp'])->name('trash.cashapp')->middleware('admin');
Route::get('admin/restore-cashapp/{id}',[CashAppController::class,'restoreCashapp'])->name('cashapp.restore')->middleware('admin');
Route::get('admin/force-del-cashapp/{id}',[CashAppController::class,'forceDelCashapp'])->name('cashapp.fdelete')->middleware('admin');
Route::get('admin/cashier-front',[AdminController::class,'showCashierFrontSetting'])->name('cashier.frontend');
Route::get('cashier/cashapp',[CashierController::class,'showCashApp'])->name('cashier.showcashapp');
Route::post('updateBalance',[CashierController::class,'updateCashAppBalance'])->name('cashier.updatebalance');
Route::post('admin/store-cashier-front',[AdminController::class,'storeCashierFront'])->name('cashier.store.frontsetting');

