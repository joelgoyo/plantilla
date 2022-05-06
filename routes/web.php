<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppsController;
use App\Http\Controllers\UserInterfaceController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ComponentsController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\PageLayoutController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\KycController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\LiquidactionController;
use App\Http\Controllers\ResetPasswordController;

use App\Http\Controllers\TreController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\InversionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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

// Main Page Route
// Route::get('/', [DashboardController::class,'dashboardEcommerce'])->name('dashboard-ecommerce')->middleware('verified');

Route::middleware('auth')->group(function () {
    Route::middleware('verified')->group(function () {

        //RUTAS ADMIN
        Route::middleware('admin')->group(function () {
            //GENEALOGY
            Route::prefix('red')->group(function () {
                Route::get('/buscar', [TreController::class, 'buscar'])->name('red.buscar');
                Route::post('/buscar', [TreController::class, 'search'])->name('red.search');
            });
            //MARKET
            Route::group(['prefix' => 'market'], function () {
                Route::post('/cambiarStatus', [TiendaController::class, 'cambiar_status'])->name('cambiarStatus');
            });

            //RENTABILIDAD
            Route::get('/rentabilidad', [InversionController::class, 'rentabilidad'])->name('rentabilidad');
            Route::post('/rentabilidad/porcentaje', [InversionController::class, 'porcentajeRentabilidad'])->name('porcentajeRentabilidad');
            Route::get('/rentabilidad/pagar', [InversionController::class, 'pagarRentabilidad'])->name('pagarRentabilidad');
            Route::get('/rentabilidadSumCapital', [InversionController::class, 'rentabilidadSumCapital'])->name('rentabilidadSumCapital');

            //USERS
            Route::prefix('user')->group(function () {
                Route::get('user-list', [UserController::class, 'listUser'])->name('user.list-user');
                Route::post('/user/{user}/start', [UserController::class, 'start'])->name('user.start');
            });
 
            //EDUCATIONS
            Route::prefix('education')->group(function () {

                Route::get('/', [EducationController::class, 'index'])->name('education.index');
                Route::get('/create', [EducationController::class, 'create'])->name('education.create');
                Route::post('/', [EducationController::class, 'store'])->name('education.store');
                Route::post('/categorie', [EducationController::class, 'CreateCategorie'])->name('education.categorie');
            });

            //ROUTE PARA LA LISTA DE KYC
            Route::get('kyc-list', [kycController::class, 'index'])->name('index.kyc');
            Route::post('cambiarStatusKyc', [KycController::class, 'cambiarStatusKyc'])->name('cambiarStatusKyc');
        });

        //RUTA PARA CREAR LA KYC
        Route::post('kyc-store', [KycController::class, 'store'])->name('kyc.store');
        //Ruta PARA ACTUALIZAR UNA KYC
        Route::post('kyc-update', [KycController::class, 'update'])->name('kyc.update');

        //EDUCATIONS USER
        Route::prefix('education')->group(function () {
            Route::get('/', [EducationController::class, 'index'])->name('education.componentUser.index');
        });

        //WALLET
         Route::get('admin/wallet', [LiquidactionController::class, 'indexAdmin'])->name('ComponentsAdmin.wallet');
        //Bono Cartera
        Route::get('/bonoCartera', [WalletController::class, 'bonoCartera'])->name('bonoCartera');

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

        // Red de usuario
        Route::prefix('red')->group(function () {
            // Ruta para ver la lista de usuarios
            //Route::get('users/{network}', [TreController::class, 'indexNewtwork'])->name('genealogy_list_network');
            // Ruta para visualizar el arbol o la matriz
            Route::get('/unilevel', [TreController::class, 'index'])->name('red.unilevel');
            // Ruta para visualizar el arbol o la matriz de un usuario en especifico
            Route::get('/{id}', [TreController::class, 'moretree'])->name('genealogy_type_id');
        });

        Route::get('/impersonate/stop', [UserController::class, 'stop'])->name('impersonate.stop');

        //TIENDA
        Route::prefix('market')->group(function () {
            Route::get('/', [TiendaController::class, 'index'])->name('shop');
            Route::post('/', [TiendaController::class, 'procesarOrden'])->name('shop.proccess');
            Route::post('/reactivacion', [TiendaController::class, 'reactivacion'])->name
            ('reactivacion');
            Route::post('/ipn', [TiendaController::class, 'ipn'])->name('shop.ipn');
            Route::post('/reactivacionSaldo', [TiendaController::class, 'reactivacionSaldo'])->name('reactivacionSaldo');
            Route::get('/getStatus', [TiendaController::class, 'getStatus'])->name('getStatus');
            Route::post('/transaction', [TiendaController::class, 'transaction'])->name('shop.transaction');
        });

        Route::get('/ordenes', [ReportController::class, 'ordenes'])->name('ordenes.index');
        Route::get('inversiones', [BusinessController::class, 'inversiones'])->name('business.invest');
        Route::get('wallet', [LiquidactionController::class, 'index'])->name('wallet.index');
        //Ruta para actualizar una wallet
        Route::post('wallet-uedit', [WalletController::class, 'edit'])->name('wallet.edit');
        Route::get('/comisiones', [WalletController::class, 'comisiones'])->name('reports.comision');
        Route::get('menuRentabilidad', [BusinessController::class, 'rentabilidad'])->name('business.rentabilidad');

        //Route Retiros
        Route::get('/withdraw', [LiquidactionController::class, 'withdraw'])->name('business.withdraw');
        Route::post('/withdraw-capital', [LiquidactionController::class, 'withdrawCapital'])->name('business.withdraw-capital');
        Route::post('/procesar-retiro-capital', [LiquidactionController::class, 'procesarRetiroCapital'])->name('settlement.procesarRetiroCapital');
        Route::post('/confirmarRetiro', [LiquidactionController::class, 'sendCodeEmail'])->name('settlement.sendCodeEmail');
        Route::post('/process', [LiquidactionController::class, 'procesarLiquidacion'])->name('settlement.process');
        Route::get('/retiros', [LiquidactionController::class, 'retiros'])->name('retiros');
        Route::get('/solicitud-retiros', [LiquidactionController::class, 'solicitudesRetiros'])->name('solicitudesRetiros');
        Route::get('/sendCodeRetiro', [LiquidactionController::class, 'sendCodeRetiro'])->name('settlement.sendCodeRetiro');
        Route::get('/liquidaciones/porGenerar', [LiquidactionController::class, 'porGenerar'])->name('liquidaciones.porGenerar');
        Route::get('/liquidaciones/realizadas', [LiquidactionController::class, 'realizadas'])->name('liquidaciones.realizadas');
        Route::get('/liquidaciones/pendientes', [LiquidactionController::class, 'pendientes'])->name('liquidaciones.pendientes');
        //MONTO DEL BONO A PAGAR
        Route::get('/liquidaciones/montoBono', [LiquidactionController::class, 'montoBono'])->name('liquidaciones.montoBono');

        Route::get('/retiros/retiro-capital', [InversionController::class, 'retiroCapital'])->name('retiros.retiro-capital'); //->middleware('primerosCincoDias');
        Route::post('/retiros/generar', [InversionController::class, 'generarLiquidacion'])->name('liquidaciones.generar');
        Route::post('/retiros/cambiar-status', [LiquidactionController::class, 'cambiarStatus'])->name('retiros.cambiarStatus');

        Route::post('/notificacionesLeidas', [UserController::class, 'notificacionesLeidas'])->name('user.notificacionesLeidas');
    });
});




Auth::routes(['verify' => true]);
//Route::post('/reset-password', [ResetPasswordController::class, 'updatePassword'])->name('updatePassword');
/* Route Dashboards */
Route::group(['prefix' => 'dashboard'], function () {
    Route::get('analytics', [DashboardController::class, 'dashboardAnalytics'])->name('dashboard-analytics');
    Route::get('ecommerce', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard-ecommerce');
});
/* Route Dashboards */

/* Route Apps */
Route::group(['prefix' => 'app'], function () {
    Route::get('email', [AppsController::class, 'emailApp'])->name('app-email');
    Route::get('chat', [AppsController::class, 'chatApp'])->name('app-chat');
    Route::get('todo', [AppsController::class, 'todoApp'])->name('app-todo');
    Route::get('calendar', [AppsController::class, 'calendarApp'])->name('app-calendar');
    Route::get('kanban', [AppsController::class, 'kanbanApp'])->name('app-kanban');
    Route::get('invoice/list', [AppsController::class, 'invoice_list'])->name('app-invoice-list');
    Route::get('invoice/preview', [AppsController::class, 'invoice_preview'])->name('app-invoice-preview');
    Route::get('invoice/edit', [AppsController::class, 'invoice_edit'])->name('app-invoice-edit');
    Route::get('invoice/add', [AppsController::class, 'invoice_add'])->name('app-invoice-add');
    Route::get('invoice/print', [AppsController::class, 'invoice_print'])->name('app-invoice-print');
    Route::get('ecommerce/shop', [AppsController::class, 'ecommerce_shop'])->name('app-ecommerce-shop');
    Route::get('ecommerce/details', [AppsController::class, 'ecommerce_details'])->name('app-ecommerce-details');
    Route::get('ecommerce/wishlist', [AppsController::class, 'ecommerce_wishlist'])->name('app-ecommerce-wishlist');
    Route::get('ecommerce/checkout', [AppsController::class, 'ecommerce_checkout'])->name('app-ecommerce-checkout');
    Route::get('file-manager', [AppsController::class, 'file_manager'])->name('app-file-manager');
    Route::get('user/list', [AppsController::class, 'user_list'])->name('app-user-list');
    Route::get('user/view', [AppsController::class, 'user_view'])->name('app-user-view');
    Route::get('user/edit', [AppsController::class, 'user_edit'])->name('app-user-edit');
});
/* Route Apps */

/* Route UI */
Route::group(['prefix' => 'ui'], function () {
    Route::get('typography', [UserInterfaceController::class, 'typography'])->name('ui-typography');
});
/* Route UI */

Route::get('profile', [UserController::class, 'profile'])->name('profile.profile');
Route::post('update', [UserController::class, 'update'])->name('profile.update');
Route::post('contacto-update', [UserController::class, 'updateContacto'])->name('contacto.update');
Route::post('contraseña-update', [UserController::class, 'passwordUpdate'])->name('contraseña.update');
Route::post('photo-update', [UserController::class, 'photoUpdate'])->name('photo.update');

Route::get('kyc', [UserController::class, 'kyc'])->name('profile.kyc');


//Ruta para crear Pin
Route::post('wallet-code', [WalletController::class, 'walletCode'])->name('wallet.code');
//Ruta para seleccionar una wallet
Route::post('wallet-option', [WalletController::class, 'walletOption'])->name('wallet.option');

Route::get('finanzas', [UserController::class, 'finanzas'])->name('financial.finanzas');


/* Route Icons */
Route::group(['prefix' => 'icons'], function () {
    Route::get('feather', [UserInterfaceController::class, 'icons_feather'])->name('icons-feather');
});
/* Route Icons */


//Ruta de los Tickets
Route::group(['prefix' => 'tickets'], function () {
    Route::get('ticket-create', [TicketsController::class, 'create'])->name('ticket.create');
    Route::post('ticket-store', [TicketsController::class, 'store'])->name('ticket.store');

    // Para el usuario
    Route::get('ticket-edit-user/{id}', [TicketsController::class, 'editUser'])->name('ticket.edit-user');
    Route::patch('ticket-update-user/{id}', [TicketsController::class, 'updateUser'])->name('ticket.update-user');
    Route::get('ticket-list-user', [TicketsController::class, 'listUser'])->name('ticket.list-user');
    Route::get('ticket-show-user/{id}', [TicketsController::class, 'showUser'])->name('ticket.show-user');

    // Para el Admin
    Route::get('ticket-edit-admin/{id}', [TicketsController::class, 'editAdmin'])->name('ticket.edit-admin');
    Route::patch('ticket-update-admin/{id}', [TicketsController::class, 'updateAdmin'])->name('ticket.update-admin');
    Route::get('ticket-list-admin', [TicketsController::class, 'listAdmin'])->name('ticket.list-admin');
    Route::get('ticket-show-admin/{id}',  [TicketsController::class, 'showAdmin'])->name('ticket.show-admin');
});




/* Route Cards */
Route::group(['prefix' => 'card'], function () {
    Route::get('basic', [CardsController::class, 'card_basic'])->name('card-basic');
    Route::get('advance', [CardsController::class, 'card_advance'])->name('card-advance');
    Route::get('statistics', [CardsController::class, 'card_statistics'])->name('card-statistics');
    Route::get('analytics', [CardsController::class, 'card_analytics'])->name('card-analytics');
    Route::get('actions', [CardsController::class, 'card_actions'])->name('card-actions');
});
/* Route Cards */

/* Route Components */
Route::group(['prefix' => 'component'], function () {
    Route::get('accordion', [ComponentsController::class, 'accordion'])->name('component-accordion');
    Route::get('alert', [ComponentsController::class, 'alert'])->name('component-alert');
    Route::get('avatar', [ComponentsController::class, 'avatar'])->name('component-avatar');
    Route::get('badges', [ComponentsController::class, 'badges'])->name('component-badges');
    Route::get('breadcrumbs', [ComponentsController::class, 'breadcrumbs'])->name('component-breadcrumbs');
    Route::get('buttons', [ComponentsController::class, 'buttons'])->name('component-buttons');
    Route::get('carousel', [ComponentsController::class, 'carousel'])->name('component-carousel');
    Route::get('collapse', [ComponentsController::class, 'collapse'])->name('component-collapse');
    Route::get('divider', [ComponentsController::class, 'divider'])->name('component-divider');
    Route::get('dropdowns', [ComponentsController::class, 'dropdowns'])->name('component-dropdowns');
    Route::get('list-group', [ComponentsController::class, 'list_group'])->name('component-list-group');
    Route::get('modals', [ComponentsController::class, 'modals'])->name('component-modals');
    Route::get('pagination', [ComponentsController::class, 'pagination'])->name('component-pagination');
    Route::get('navs', [ComponentsController::class, 'navs'])->name('component-navs');
    Route::get('offcanvas', [ComponentsController::class, 'offcanvas'])->name('component-offcanvas');
    Route::get('tabs', [ComponentsController::class, 'tabs'])->name('component-tabs');
    Route::get('timeline', [ComponentsController::class, 'timeline'])->name('component-timeline');
    Route::get('pills', [ComponentsController::class, 'pills'])->name('component-pills');
    Route::get('tooltips', [ComponentsController::class, 'tooltips'])->name('component-tooltips');
    Route::get('popovers', [ComponentsController::class, 'popovers'])->name('component-popovers');
    Route::get('pill-badges', [ComponentsController::class, 'pill_badges'])->name('component-pill-badges');
    Route::get('progress', [ComponentsController::class, 'progress'])->name('component-progress');
    Route::get('spinner', [ComponentsController::class, 'spinner'])->name('component-spinner');
    Route::get('toast', [ComponentsController::class, 'toast'])->name('component-bs-toast');
});
/* Route Components */

/* Route Extensions */
Route::group(['prefix' => 'ext-component'], function () {
    Route::get('sweet-alerts', [ExtensionController::class, 'sweet_alert'])->name('ext-component-sweet-alerts');
    Route::get('block-ui', [ExtensionController::class, 'block_ui'])->name('ext-component-block-ui');
    Route::get('toastr', [ExtensionController::class, 'toastr'])->name('ext-component-toastr');
    Route::get('sliders', [ExtensionController::class, 'sliders'])->name('ext-component-sliders');
    Route::get('drag-drop', [ExtensionController::class, 'drag_drop'])->name('ext-component-drag-drop');
    Route::get('tour', [ExtensionController::class, 'tour'])->name('ext-component-tour');
    Route::get('clipboard', [ExtensionController::class, 'clipboard'])->name('ext-component-clipboard');
    Route::get('plyr', [ExtensionController::class, 'plyr'])->name('ext-component-plyr');
    Route::get('context-menu', [ExtensionController::class, 'context_menu'])->name('ext-component-context-menu');
    Route::get('swiper', [ExtensionController::class, 'swiper'])->name('ext-component-swiper');
    Route::get('tree', [ExtensionController::class, 'tree'])->name('ext-component-tree');
    Route::get('ratings', [ExtensionController::class, 'ratings'])->name('ext-component-ratings');
    Route::get('locale', [ExtensionController::class, 'locale'])->name('ext-component-locale');
});
/* Route Extensions */

/* Route Page Layouts */
Route::group(['prefix' => 'page-layouts'], function () {
    Route::get('collapsed-menu', [PageLayoutController::class, 'layout_collapsed_menu'])->name('layout-collapsed-menu');
    Route::get('full', [PageLayoutController::class, 'layout_full'])->name('layout-full');
    Route::get('without-menu', [PageLayoutController::class, 'layout_without_menu'])->name('layout-without-menu');
    Route::get('empty', [PageLayoutController::class, 'layout_empty'])->name('layout-empty');
    Route::get('blank', [PageLayoutController::class, 'layout_blank'])->name('layout-blank');
});
/* Route Page Layouts */

/* Route Forms */
Route::group(['prefix' => 'form'], function () {
    Route::get('input', [FormsController::class, 'input'])->name('form-input');
    Route::get('input-groups', [FormsController::class, 'input_groups'])->name('form-input-groups');
    Route::get('input-mask', [FormsController::class, 'input_mask'])->name('form-input-mask');
    Route::get('textarea', [FormsController::class, 'textarea'])->name('form-textarea');
    Route::get('checkbox', [FormsController::class, 'checkbox'])->name('form-checkbox');
    Route::get('radio', [FormsController::class, 'radio'])->name('form-radio');
    Route::get('switch', [FormsController::class, 'switch'])->name('form-switch');
    Route::get('select', [FormsController::class, 'select'])->name('form-select');
    Route::get('number-input', [FormsController::class, 'number_input'])->name('form-number-input');
    Route::get('file-uploader', [FormsController::class, 'file_uploader'])->name('form-file-uploader');
    Route::get('quill-editor', [FormsController::class, 'quill_editor'])->name('form-quill-editor');
    Route::get('date-time-picker', [FormsController::class, 'date_time_picker'])->name('form-date-time-picker');
    Route::get('layout', [FormsController::class, 'layouts'])->name('form-layout');
    Route::get('wizard', [FormsController::class, 'wizard'])->name('form-wizard');
    Route::get('validation', [FormsController::class, 'validation'])->name('form-validation');
    Route::get('repeater', [FormsController::class, 'form_repeater'])->name('form-repeater');
});
/* Route Forms */

/* Route Tables */
Route::group(['prefix' => 'table'], function () {
    Route::get('', [TableController::class, 'table'])->name('table');
    Route::get('datatable/basic', [TableController::class, 'datatable_basic'])->name('datatable-basic');
    Route::get('datatable/advance', [TableController::class, 'datatable_advance'])->name('datatable-advance');
});
/* Route Tables */

/* Route Pages */
Route::group(['prefix' => 'page'], function () {
    Route::get('account-settings', [PagesController::class, 'account_settings'])->name('page-account-settings');
    Route::get('profile', [PagesController::class, 'profile'])->name('page-profile');
    Route::get('faq', [PagesController::class, 'faq'])->name('page-faq');
    Route::get('knowledge-base', [PagesController::class, 'knowledge_base'])->name('page-knowledge-base');
    Route::get('knowledge-base/category', [PagesController::class, 'kb_category']);
    Route::get('knowledge-base/category/question', [PagesController::class, 'kb_question']);
    Route::get('pricing', [PagesController::class, 'pricing'])->name('page-pricing');
    Route::get('blog/list', [PagesController::class, 'blog_list'])->name('page-blog-list');
    Route::get('blog/detail', [PagesController::class, 'blog_detail'])->name('page-blog-detail');
    Route::get('blog/edit', [PagesController::class, 'blog_edit'])->name('page-blog-edit');

    // Miscellaneous Pages With Page Prefix
    Route::get('coming-soon', [MiscellaneousController::class, 'coming_soon'])->name('misc-coming-soon');
    Route::get('not-authorized', [MiscellaneousController::class, 'not_authorized'])->name('misc-not-authorized');
    Route::get('maintenance', [MiscellaneousController::class, 'maintenance'])->name('misc-maintenance');
});
/* Route Pages */
Route::get('/error', [MiscellaneousController::class, 'error'])->name('error');

/* Route Authentication Pages */
Route::group(['prefix' => 'auth'], function () {
    Route::get('login-v1', [AuthenticationController::class, 'login_v1'])->name('auth-login-v1');
    Route::get('login-v2', [AuthenticationController::class, 'login_v2'])->name('auth-login-v2');
    Route::get('register-v1', [AuthenticationController::class, 'register_v1'])->name('auth-register-v1');
    Route::get('register-v2', [AuthenticationController::class, 'register_v2'])->name('auth-register-v2');
    Route::get('forgot-password-v1', [AuthenticationController::class, 'forgot_password_v1'])->name('auth-forgot-password-v1');
    Route::get('forgot-password-v2', [AuthenticationController::class, 'forgot_password_v2'])->name('auth-forgot-password-v2');
    Route::get('reset-password-v1', [AuthenticationController::class, 'reset_password_v1'])->name('auth-reset-password-v1');
    Route::get('reset-password-v2', [AuthenticationController::class, 'reset_password_v2'])->name('auth-reset-password-v2');
    Route::get('lock-screen', [AuthenticationController::class, 'lock_screen'])->name('auth-lock_screen');
    Route::get('verify', [AuthenticationController::class, 'verify'])->name('auth.verify');
    
    Route::get('verify-account', [UserController::class, 'verifyAccount'])->name('verify-account');
    Route::get('verified-email', [UserController::class, 'verifiedEmail'])->name('verified-email');
});
/* Route Authentication Pages */
Route::get('verified-reset', [AuthenticationController::class, 'verify_v2'])->name('auth.verified-reset');
/* Route Charts */
Route::group(['prefix' => 'chart'], function () {
    Route::get('apex', [ChartsController::class, 'apex'])->name('chart-apex');
    Route::get('chartjs', [ChartsController::class, 'chartjs'])->name('chart-chartjs');
    Route::get('echarts', [ChartsController::class, 'echarts'])->name('chart-echarts');
});
/* Route Charts */

// map leaflet
Route::get('/maps/leaflet', [ChartsController::class, 'maps_leaflet'])->name('map-leaflet');

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);


Route::match(['get', 'post'], '/aprobarRetiro', [LiquidactionController::class, 'aprobarRetiro'])->name('settlement.aprobarRetiro');


Route::get('/filter', [EducationController::class, 'filter'])->name('education.filter');


Route::get('/bono-cartera', function ()
{
    Artisan::call('bono:cartera');
    return redirect()->back()->with('success', 'El cron bono:cartera corrio con exito');
})->name('bono.cartera');



Route::get('/start-cronRentabilidad', function () {
    Artisan::call('pagar:rentabilidad');
    return redirect()->back()->with('success', 'el cron pagar:rentabilidad corrio con exito');
})->name('bono.cronRentabilidad');


Route::get('/start-cronSumRentabilidad', function () {
    Artisan::call('capital:sumRentabilidad');
    return redirect()->back()->with('success', 'el cron capital:sumRentabilidad corrio con exito');
})->name('start.cronSumRentabilidad');


Route::get('/start-start:payrentabilidad', function () {
    Artisan::call('start:payrentabilidad');
    return redirect()->back()->with('success', 'el cron start:payrentabilidad corrio con exito');
})->name('start.payrentabilidad');

Route::get('/check-order', function () {
    Artisan::call('checkstatus:order');
    return redirect()->back()->with('success', 'el cron checkstatus:order corrio con exito');
})->name('check.order');
