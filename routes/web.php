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
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\QuoteEnquiryController;
use App\Http\Controllers\SlotsController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\VenderController;
use App\Http\Controllers\SelectCategoryController;
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

    Route::prefix('labinstrument')->name('labInstrument.')->group(function () {
        Route::get('index', [LabinstrumentController::class, 'index'])->middleware('permission:read instruments')->name('index');
        Route::get('create', [LabinstrumentController::class, 'create'])->middleware('permission:create instruments')->name('create');
        Route::post('store', [LabinstrumentController::class, 'store'])->name('store');
        Route::get('edit/{labInstrument}', [LabinstrumentController::class, 'edit'])->name('edit');
        Route::put('update/{labInstrument}', [LabinstrumentController::class, 'update'])->name('update');

        Route::get('delete/{labInstrument}', [LabinstrumentController::class, 'delete'])->name('delete');
    });

    //vender

    Route::prefix('vender')->name('vender.')->group(function () {
        Route::get('index', [VenderController::class, 'index'])->name('index');
        Route::get('create', [VenderController::class, 'create'])->name('create');
        Route::post('store', [VenderController::class, 'store'])->name('store');
        Route::get('edit/{vender}', [VenderController::class, 'edit'])->name('edit');
        Route::put('update{vender}', [VenderController::class, 'update'])->name('update');
        Route::get('delete/{vender}', [VenderController::class, 'delete'])->name('delete');
    });

    //quote
    Route::prefix('quote')->name('quote.')->group(function () {
        Route::get('index', [QuoteController::class, 'index'])->name('index');
        Route::get('create', [QuoteController::class, 'create'])->name('create');
        Route::post('store', [QuoteController::class, 'store'])->name('store');
        Route::get('edit/{quote}', [QuoteController::class, 'edit'])->name('edit');
        Route::put('update/{quote}', [QuoteController::class, 'update'])->name('update');
        Route::get('delete/{quote}', [QuoteController::class, 'delete'])->name('delete');
    });


    //quote Enquiry
    Route::prefix('enquiry')->name('enquiry-quote.')->group(function () {
        Route::get('index', [QuoteEnquiryController::class, 'index'])->name('index');
        Route::get('create', [QuoteEnquiryController::class, 'create'])->name('create');
        Route::post('store', [QuoteEnquiryController::class, 'store'])->name('store');
        Route::get('edit/{quotEnquiry}', [QuoteEnquiryController::class, 'edit'])->name('edit');
        Route::put('update/{quotEnquiry}', [QuoteEnquiryController::class, 'update'])->name('update');
        Route::get('delete/{quotEnquiry}', [QuoteEnquiryController::class, 'delete'])->name('delete');
    });


    //storage
    Route::prefix('storage')->name('storage.')->group(function () {
        Route::get('index', [StorageController::class, 'index'])->name('index');
        Route::get('show/{storage}', [StorageController::class, 'showStorageWithBoxes'])->name('show');
        Route::get('create', [StorageController::class, 'create'])->name('create');
        Route::post('store', [StorageController::class, 'store'])->name('store');
        Route::get('edit/{storage}', [StorageController::class, 'edit'])->name('edit');
        Route::put('update/{storage}', [StorageController::class, 'update'])->name('update');
        Route::get('delete/{storage}', [StorageController::class, 'delete'])->name('delete');
    });

    // boxes
    Route::prefix('boxes')->name('boxes.')->group(function () {
        Route::get('show/{box}', [BoxesController::class, 'showBoxesWithslot'])->name('show');
        Route::get('index', [BoxesController::class, 'index'])->name('index');
        Route::get('create', [BoxesController::class, 'create'])->name('create');
        Route::post('store', [BoxesController::class, 'store'])->name('store');
        Route::get('edit/{box}', [BoxesController::class, 'edit'])->name('edit');
        Route::put('update{box}', [BoxesController::class, 'update'])->name('update');
        Route::get('delete/{box}', [BoxesController::class, 'delete'])->name('delete');
    });


    //slots
    Route::prefix('slot')->name('slot.')->group(function () {
        Route::get('index', [SlotsController::class, 'index'])->name('index');
        Route::get('create', [SlotsController::class, 'create'])->name('create');
        Route::post('store', [SlotsController::class, 'store'])->name('store');
        Route::get('store/edit/{slot}', [SlotsController::class, 'edit'])->name('edit');
        Route::get('store/show/{slot}', [SlotsController::class, 'show'])->name('show');
        Route::put('update/{slot}', [SlotsController::class, 'update'])->name('update');
        Route::get('delete/{slot}', [SlotsController::class, 'delete'])->name('delete');
    });


    //item
    Route::prefix('item')->name('item.')->group(function () {
        Route::get('index', [ItemsController::class, 'index'])->name('index');
        Route::get('create', [ItemsController::class, 'create'])->name('create');
        Route::post('store', [ItemsController::class, 'store'])->name('store');
        Route::get('edit/{item}', [ItemsController::class, 'edit'])->name('edit');
        Route::put('update/{item}', [ItemsController::class, 'update'])->name('update');
        Route::get('delete/{item}', [ItemsController::class, 'delete'])->name('delete');
    });


    // project
    Route::prefix('project')->name('project.')->group(function () {
        Route::get('index', [ProjectController::class, 'index'])->name('index');
        Route::get('create', [ProjectController::class, 'create'])->name('create');
        Route::post('store', [ProjectController::class, 'store'])->name('store');
        Route::get('edit/{project}', [ProjectController::class, 'edit'])->name('edit');
        Route::put('update/{project}', [ProjectController::class, 'update'])->name('update');
        Route::get('delete/{project}', [ProjectController::class, 'delete'])->name('delete');
        Route::get('pdf', [ProjectController::class, 'pdfDownload'])->name('pdf');
    });

    // Product Category
    Route::prefix('product')->name('product-category.')->group(function () {
        Route::get('index', [ProductCategoryController::class, 'index'])->name('index');
        Route::get('create', [ProductCategoryController::class, 'create'])->name('create');
        Route::post('store', [ProductCategoryController::class, 'store'])->name('store');
        Route::get('edit/{productCategory}', [ProductCategoryController::class, 'edit'])->name('edit');
        Route::put('update/{productCategory}', [ProductCategoryController::class, 'update'])->name('update');
        Route::get('delete/{productCategory}', [ProductCategoryController::class, 'delete'])->name('delete');
    });

    Route::prefix('selectCategory')->name('selectCategory.')->group(function () {
        Route::get('index', [SelectCategoryController::class, 'index'])->name('index');
        Route::get('create', [SelectCategoryController::class, 'create'])->name('create');
        Route::post('store', [SelectCategoryController::class, 'store'])->name('store');
        Route::get('edit/{selectCategory}', [SelectCategoryController::class, 'edit'])->name('edit');
        Route::put('update/{selectCategory}', [SelectCategoryController::class, 'update'])->name('update');
        Route::get('delete/{selectCategory}', [SelectCategoryController::class, 'delete'])->name('delete');
    });
});
