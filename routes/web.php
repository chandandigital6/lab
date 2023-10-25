<?php

use App\Http\Controllers\BoxesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LanguageController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\PluginController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\TrafficsController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\LabinstrumentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\QuoteEnquiryController;
use App\Http\Controllers\SlotsController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\VenderController;
use App\Models\Language;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

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

Route::middleware(['splade'])->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/language/{code}', function ($code) {
        $language = Language::where('code', $code)->first();
        if ($language) {
            Session::put('locale', $code);
        }
        return redirect()->back();
    })->name('switch-language');

    Route::middleware(['guest', 'checkUserRegistration'])->group(function () {
        Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
        Route::post('/register', [RegisteredUserController::class, 'store']);
    });

    Route::get('/', function () {
        return view('welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    });

    Route::prefix('dashboard')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::resource('user', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('languages', LanguageController::class);
        Route::get('traffics', [TrafficsController::class, 'index'])->name('traffics.index');
        Route::get('traffics/logs', [TrafficsController::class, 'logs'])->name('traffics.logs');
        Route::get('error-reports', [TrafficsController::class, 'error_reports'])->name('traffics.error-reports');
        Route::get('error-reports/{report}', [TrafficsController::class, 'error_report'])->name('traffics.error-report');

        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->name('index');
            Route::put('/update', [SettingController::class, 'update'])->name('update');
        });

        Route::prefix('plugins')->name('plugins.')->group(function () {
            Route::get('/', [PluginController::class, 'index'])->name('index');
            Route::get('/install', [PluginController::class, 'create'])->name('create');
            Route::post('/install', [PluginController::class, 'store'])->name('store');
            Route::post('/{plugin}/activate', [PluginController::class, 'activate'])->name('activate');
            Route::post('/{plugin}/deactivate', [PluginController::class, 'deactivate'])->name('deactivate');
            Route::post('/{plugin}/delete', [PluginController::class, 'delete'])->name('delete');
        });
    });

    Route::get('labinstrument/index', [LabinstrumentController::class, 'index'])->name('labInstrument.index');
    Route::get('labinstrument/create', [LabinstrumentController::class, 'create'])->name('labInstrument.create');
    Route::post('labinstrument/store', [LabinstrumentController::class, 'store'])->name('labInstrument.store');
    Route::get('labinstrument/edit/{labInstrument}', [LabinstrumentController::class, 'edit'])->name('labInstrument.edit');
    Route::put('labinstrument/update/{labInstrument}', [LabinstrumentController::class, 'update'])->name('labInstrument.update');

    Route::get('labinstrument/delete/{labInstrument}', [LabinstrumentController::class, 'delete'])->name('labInstrument.delete');


    //vender


    Route::get('vender/index', [VenderController::class, 'index'])->name('vender.index');
    Route::get('vender/create', [VenderController::class, 'create'])->name('vender.create');
    Route::post('vender/store', [VenderController::class, 'store'])->name('vender.store');
    Route::get('vender/edit/{vender}', [VenderController::class, 'edit'])->name('vender.edit');
    Route::put('vender/update{vender}', [VenderController::class, 'update'])->name('vender.update');
    Route::get('vender/delete/{vender}', [VenderController::class, 'delete'])->name('vender.delete');

    //quote
    Route::get('quote/index', [QuoteController::class, 'index'])->name('quote.index');
    Route::get('quote/create', [QuoteController::class, 'create'])->name('quote.create');

    Route::post('quote/store', [QuoteController::class, 'store'])->name('quote.store');

    Route::get('quote/edit/{quote}', [QuoteController::class, 'edit'])->name('quote.edit');

    Route::put('quote/update/{quote}', [QuoteController::class, 'update'])->name('quote.update');
    Route::get('quote/delete/{quote}', [QuoteController::class, 'delete'])->name('quote.delete');


    //quote Enquiry

    Route::get('enquiry/index',[QuoteEnquiryController::class,'index'])->name('enquiry-quote.index');
    Route::get('enquiry/create',[QuoteEnquiryController::class,'create'])->name('enquiry-quote.create');
    Route::post('enquiry/store',[QuoteEnquiryController::class,'store'])->name('enquiry-quote.store');
    Route::get('enquiry/edit/{quotEnquiry}',[QuoteEnquiryController::class,'edit'])->name('enquiry-quote.edit');
    Route::put('enquiry/update/{quotEnquiry}',[QuoteEnquiryController::class,'update'])->name('enquiry-quote.update');
    Route::get('enquiry/delete/{quotEnquiry}',[QuoteEnquiryController::class,'delete'])->name('enquiry-quote.delete');



    //storage
    Route::get('storage/index',[StorageController::class,'index'])->name('storage.index');
    Route::get('/storage/show/{storage}', [StorageController::class, 'showStorageWithBoxes'])->name('storage.show');
    Route::get('storage/create',[StorageController::class,'create'])->name('storage.create');
    Route::post('storage/store',[StorageController::class,'store'])->name('storage.store');
    Route::get('storage/edit/{storage}',[StorageController::class,'edit'])->name('storage.edit');
    Route::put('storage/update/{storage}',[StorageController::class,'update'])->name('storage.update');
    Route::get('storage/delete/{storage}',[StorageController::class,'delete'])->name('storage.delete');



    // boxes
    Route::get('boxes/show/{box}', [BoxesController::class, 'showBoxesWithslot'])->name('boxes.show');
    Route::get('boxes/index',[BoxesController::class,'index'])->name('boxes.index');
    Route::get('boxes/create',[BoxesController::class,'create'])->name('boxes.create');
    Route::post('boxes/store',[BoxesController::class,'store'])->name('boxes.store');

    Route::get('boxes/edit/{box}',[BoxesController::class,'edit'])->name('boxes.edit');
    Route::put('boxes/update{box}',[BoxesController::class,'update'])->name('boxes.update');

    Route::get('boxes/delete/{box}',[BoxesController::class,'delete'])->name('boxes.delete');

    //slots

    Route::get('slot/index',[SlotsController::class,'index'])->name('slot.index');
    Route::get('slot/create',[SlotsController::class,'create'])->name('slot.create');
    Route::post('slot/store',[SlotsController::class,'store'])->name('slot.store');
    Route::get('slot/store/edit/{slot}',[SlotsController::class,'edit'])->name('slot.edit');
    Route::get('slot/store/show/{slot}',[SlotsController::class,'show'])->name('slot.show');
    Route::put('slot/update/{slot}',[SlotsController::class,'update'])->name('slot.update');
    Route::get('slot/delete/{slot}',[SlotsController::class,'delete'])->name('slot.delete');


    //item
    Route::get('item/index',[ItemsController::class,'index'])->name('item.index');
    Route::get('item/create',[ItemsController::class,'create'])->name('item.create');
    Route::post('item/store',[ItemsController::class,'store'])->name('item.store');
    Route::get('item/edit/{item}',[ItemsController::class,'edit'])->name('item.edit');
    Route::put('item/update/{item}',[ItemsController::class,'update'])->name('item.update');
    Route::get('item/delete/{item}',[ItemsController::class,'delete'])->name('item.delete');


    // project

    Route::get('project/index',[ProjectController::class,'index'])->name('project.index');
    Route::get('project/create',[ProjectController::class,'create'])->name('project.create');
    Route::post('project/store',[ProjectController::class,'store'])->name('project.store');
    Route::get('project/edit/{project}',[ProjectController::class,'edit'])->name('project.edit');
    Route::put('project/update/{project}',[ProjectController::class,'update'])->name('project.update');
    Route::get('project/delete/{project}',[ProjectController::class,'delete'])->name('project.delete');
   Route::get('project/pdf',[ProjectController::class,'pdfDownload'])->name('project.pdf');

});
