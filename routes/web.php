<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;


use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Role;
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

// Authentication and Google OAuth Routes
Route::get('auth/google', [AuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/callback', [AuthController::class, 'callbackGoogle'])->name('google.callback');

// Login and Logout Routes
Route::get('/login', [PagesController::class, 'Login'])->name('login')->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Default redirect to login
Route::get('/', function () {
    return redirect('/login');
});

Route::prefix('DataOrder')->group(function () {
    Route::get('/', [PagesController::class, 'DataOrder'])->name('DataOrder');
    Route::get('/AddAttendence', [PagesController::class, 'AddAttendence'])->name('AddAttendence');
    Route::get('/EditAttendence', [PagesController::class, 'EditAttendence'])->name('EditAttendence');
});
Route::prefix('DeliveryOrder')->group(function () {
    Route::get('/', [PagesController::class, 'DeliveryOrder'])->name('DeliveryOrder');
    Route::get('/DetailOrder/{orderId}', [PagesController::class, 'DetailOrder'])->name('DetailOrder');
    Route::post('/assign-driver', [CRUDController::class, 'assignDriver'])->name('assign.driver');
    Route::get('/DetailDelivery/{orderId}', [PagesController::class, 'DetailDelivery'])->name('DetailDelivery');
    Route::post('/acceptOrder/{orderId}', [CrudController::class, 'acceptOrder'])->name('acceptOrder');
    Route::post('/finishDelivery/{orderId}', [CrudController::class, 'finishDelivery'])->name('finishDelivery');

});
Route::get('', [PagesController::class, 'dashboard'])->name('dashboard');
Route::get('/SelectPosition', [PagesController::class, 'SelectPosition'])->name('SelectPosition');
Route::post('/SelectedPosition', [CrudController::class, 'SelectedPosition'])->name('SelectedPosition');
Route::get('/SelectUnit', [PagesController::class, 'SelectUnit'])->name('SelectUnit');
Route::post('/SelectedUnit', [CrudController::class, 'SelectedUnit'])->name('SelectedUnit');
Route::get('/SelectRegion', [PagesController::class, 'SelectRegion'])->name('SelectRegion');
Route::post('/SelectedRegion', [CrudController::class, 'SelectedRegion'])->name('SelectedRegion');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



Route::prefix('Point')->group(function () {
    Route::get('/', [PagesController::class, 'Point'])->name('Point');
    Route::get('/PointActivity', [PagesController::class, 'PointActivity'])->name('PointActivity');
    Route::get('/PointDetail/{orderId}', [PagesController::class, 'PointDetail'])->name('PointDetail');
    Route::get('/AddPointActivity/{orderId}', [PagesController::class, 'AddPointActivity'])->name('AddPointActivity');
    Route::post('/submit-activity', [CRUDController::class, 'processActivityForm'])->name('processActivityForm');
});

Route::prefix('DataUser')->group(function () {
    Route::get('/', [PagesController::class, 'DataUser'])->name('DataUser');
    Route::get('/DetailUser', [PagesController::class, 'DetailUser'])->name('DetailUser');
    Route::get('/AddUser', [PagesController::class, 'AddUser'])->name('AddUser');
    Route::get('/EditUser/{id}', [PagesController::class, 'EditUser'])->name('EditUser');
    Route::post('/EditedUser/{id}', [CrudController::class, 'EditedUser'])->name('EditedUser');
    Route::get('/DeletedUser/{id}', [CrudController::class, 'DeletedUser'])->name('DeletedUser');
});

// Authenticated Routes
Route::middleware(['auth','checkrole'])->group(function () {
        Route::get('/dashboard', [PagesController::class, 'dashboard'])->name('dashboard');
        Route::resource('leads', LeadController::class);

        // Leads Management
        Route::post('/leads/{lead}/approve', [LeadController::class, 'approve'])->name('leads.approve');
        Route::post('/leads/{lead}/disapprove', [LeadController::class, 'disapprove'])->name('leads.disapprove');
        Route::get('/lead-approvals', [LeadController::class, 'approvalIndex'])->name('lead.approvals.index');
        Route::post('/leads/ocr-ktp', [LeadController::class, 'ocrKtp'])->name('leads.ocr-ktp');
        


        

        // User management
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        // Permissions and Roles
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/roles/{id}/edit-permissions', [RoleController::class, 'editPermissions'])->name('roles.edit_permissions');
        Route::put('/roles/{id}/update-permissions', [RoleController::class, 'updatePermissions'])->name('roles.update_permissions');
        Route::get('permissions/create', [RoleController::class, 'createPermission'])->name('permissions.create');
        Route::post('permissions/store', [RoleController::class, 'storePermission'])->name('permissions.store');

        // Customer Management Routes
        Route::prefix('customers')->name('customers.')->group(function () {
            Route::get('/', [CustomerController::class, 'index'])->name('index');
            Route::get('/{customer_id}', [CustomerController::class, 'show'])->name('show');
            Route::get('/{customer_id}/edit', [CustomerController::class, 'edit'])->name('edit');
            Route::put('/{customer_id}', [CustomerController::class, 'update'])->name('update');
            Route::delete('/{customer_id}', [CustomerController::class, 'destroy'])->name('destroy');
        });

        // Items and Product
        Route::resource('products', ProductController::class);
        Route::resource('items', ItemController::class);
        Route::post('/items', [ItemController::class, 'store'])->name('items.store');
        Route::get('items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');
        Route::put('items/{item}', [ItemController::class, 'update'])->name('items.update');

        // Route group for orders
        Route::prefix('orders')->name('orders.')->middleware(['auth'])->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');  // List all orders
            Route::get('create', [OrderController::class, 'create'])->name('create');  // Display form to create a new order
            Route::post('/', [OrderController::class, 'store'])->name('store');  // Store new order
            Route::get('{order}', [OrderController::class, 'show'])->name('show');  // Display a specific order
            Route::get('{order}/edit', [OrderController::class, 'edit'])->name('edit');  // Display form to edit an order
            Route::put('{order}', [OrderController::class, 'update'])->name('update');  // Update order
            Route::delete('{order}', [OrderController::class, 'destroy'])->name('destroy');  // Delete an order
        });
        Route::get('/api/customers/{customer}', [CustomerController::class, 'getDetails']);

 
    
});



// Admin specific routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::delete('/leads/{lead}', [LeadController::class, 'destroy'])->name('leads.destroy');
});

//TESTING ROUTES
Route::get('/pending-role', function () {
    return view('notifications.pending-role');
})->name('pending-role');


// EMAIL SEND ROUTE
// Route::post('/send-email', [EmailController::class, 'sendEmail'])->name('send.email');
// Route::get('/email-form', [EmailController::class, 'showForm'])->name('email.form');

Route::get('/send-test-email', function () {
    Mail::to('mail.tomsan@gmail.com')->send(new TestEmail());
    return 'Email has been sent!';
});

Route::get('test-role/{role_id}', function ($role_id) {
    return Role::find($role_id);
});



    // IGNORE START

    Route::prefix('ManageCourses')->group(function () {
        Route::get('/', [PagesController::class, 'ManageCourses'])->name('ManageCourses');
        Route::get('/AddCategoryCourses', [PagesController::class, 'AddCategoryCourses'])->name('AddCategoryCourses');
        Route::get('/EditCategoryCourses/{id}', [PagesController::class, 'EditCategoryCourses'])->name('EditCategoryCourses');
        Route::post('/EditedCategoryCourses/{id}', [CrudController::class, 'EditedCategoryCourses'])->name('EditedCategoryCourses');
        Route::post('/AddedCategoryCourses', [CrudController::class, 'AddedCategoryCourses'])->name('AddedCategoryCourses');
        Route::get('/DeleteCategoryCourses/{id}', [CrudController::class, 'DeleteCategoryCourses'])->name('DeleteCategoryCourses');
    });
        Route::prefix('ManageAttendence')->group(function () {
        Route::get('/', [PagesController::class, 'ManageAttendence'])->name('ManageAttendence');
        Route::get('/AddAttendence', [PagesController::class, 'AddAttendence'])->name('AddAttendence');
        Route::get('/EditAttendence', [PagesController::class, 'EditAttendence'])->name('EditAttendence');
    });
        Route::prefix('ManageEnrollment')->group(function () {
        Route::get('/', [PagesController::class, 'ManageEnrollment'])->name('ManageEnrollment');
        Route::get('/AddEnrollment', [PagesController::class, 'AddEnrollment'])->name('AddEnrollment');
        Route::get('/EditEnrollment/{id}', [PagesController::class, 'EditEnrollment'])->name('EditEnrollment');
        Route::post('/EditedEnrollment/{id}', [CrudController::class, 'EditedEnrollment'])->name('EditedEnrollment');
        Route::post('/AddedEnrollment', [CrudController::class, 'AddedEnrollment'])->name('AddedEnrollment');
        Route::get('/DeleteEnrollment/{id}', [CrudController::class, 'DeleteEnrollment'])->name('DeleteEnrollment');
    });
        Route::prefix('ManageQuiz')->group(function () {
        Route::get('/', [PagesController::class, 'ManageQuiz'])->name('ManageQuiz');
        Route::get('/AddQuiz', [PagesController::class, 'AddQuiz'])->name('AddQuiz');
        Route::post('/AddedQuiz', [CrudController::class, 'AddedQuiz'])->name('AddedQuiz');

        Route::prefix('{courses}')->group(function () {
            Route::get('/', [PagesController::class, 'Quiz'])->name('Quiz');
            Route::get('/AddQuizDetail', [PagesController::class, 'AddQuizDetail'])->name('AddQuizDetail');
            Route::get('/EditQuiz/{id}', [PagesController::class, 'EditQuiz'])->name('EditQuiz');
            Route::post('/EditedQuiz/{id}', [CrudController::class, 'EditedQuiz'])->name('EditedQuiz');
            Route::post('/AddedQuizDetail', [CrudController::class, 'AddedQuizDetail'])->name('AddedQuizDetail');
            Route::get('/DeleteQuiz/{id}', [CrudController::class, 'DeleteQuizDetail'])->name('DeleteQuizDetail');
            Route::get('/DeleteQuiz/{id}', [CrudController::class, 'DeleteQuiz'])->name('DeleteQuiz');
            
            Route::prefix('QuizDetail/{id}')->group(function () {
                Route::get('/', [PagesController::class, 'QuizDetail'])->name('QuizDetail');
                Route::get('/AddQuestion', [PagesController::class, 'AddQuestion'])->name('AddQuestion');
                Route::post('/AddedQuestion', [CrudController::class, 'AddedQuestion'])->name('AddedQuestion');
                
                Route::prefix('')->group(function () {
                    Route::get('/EditQuizDetail/{QuestionID}', [PagesController::class, 'EditQuizDetail'])->name('EditQuizDetail');
                    Route::post('/EditedQuizDetail/{QuestionID}', [CrudController::class, 'EditedQuizDetail'])->name('EditedQuizDetail');
                    Route::get('/DeleteQuestion/{QuestionID}', [CrudController::class, 'DeleteQuestion'])->name('DeleteQuestion');
                    Route::get('/DeleteOption/{OptionID}', [CrudController::class, 'DeleteOption'])->name('DeleteOption');
                });
            });
        });
    });

    Route::prefix('ManageEnrollment')->group(function () {
        Route::get('/', [PagesController::class, 'ManageEnrollment'])->name('ManageEnrollment');
        Route::get('/AddEnrollment', [PagesController::class, 'AddEnrollment'])->name('AddEnrollment');
        Route::get('/EditEnrollment/{id}', [PagesController::class, 'EditEnrollment'])->name('EditEnrollment');
        Route::post('/EditedEnrollment/{id}', [CrudController::class, 'EditedEnrollment'])->name('EditedEnrollment');
        Route::post('/AddedEnrollment', [CrudController::class, 'AddedEnrollment'])->name('AddedEnrollment');
        Route::get('/DeleteEnrollment/{id}', [CrudController::class, 'DeleteEnrollment'])->name('DeleteEnrollment');

        Route::prefix('{category}')->group(function () {
            Route::get('', [PagesController::class, 'DetailEnrollment'])->name('DetailEnrollment');
            Route::get('/AddDetailEnrollment', [PagesController::class, 'AddDetailEnrollment'])->name('AddDetailEnrollment');
            Route::get('/EditDetailEnrollment/{id}', [PagesController::class, 'EditDetailEnrollment'])->name('EditDetailEnrollment');
            Route::post('/AddedDetailEnrollment', [CrudController::class, 'AddedDetailEnrollment'])->name('AddedDetailEnrollment');
            Route::get('/DeleteDetailEnrollment/{id}', [CrudController::class, 'DeleteDetailEnrollment'])->name('DeleteDetailEnrollment');
            Route::post('/EditedDetailEnrollment/{id}', [CrudController::class, 'EditedDetailEnrollment'])->name('EditedDetailEnrollment');
        });
    });

        Route::prefix('DataUser')->group(function () {
        Route::get('/', [PagesController::class, 'DataUser'])->name('DataUser');
        Route::get('/DetailUser', [PagesController::class, 'DetailUser'])->name('DetailUser');
        Route::get('/AddUser', [PagesController::class, 'AddUser'])->name('AddUser');
        Route::get('/EditUser/{id}', [PagesController::class, 'EditUser'])->name('EditUser');
        Route::post('/EditedUser/{id}', [CrudController::class, 'EditedUser'])->name('EditedUser');
        Route::get('/DeletedUser/{id}', [CrudController::class, 'DeletedUser'])->name('DeletedUser');
    });

    // IGNORE END



