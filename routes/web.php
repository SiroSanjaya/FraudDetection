<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('auth/google', [AuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/callback', [AuthController::class, 'callbackGoogle']);
Route::get('/login', [PagesController::class, 'Login'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('', [PagesController::class, 'dashboard'])->name('dashboard');
    Route::get('/SelectPosition', [PagesController::class, 'SelectPosition'])->name('SelectPosition');
    Route::post('/SelectedPosition', [CrudController::class, 'SelectedPosition'])->name('SelectedPosition');
    Route::get('/SelectUnit', [PagesController::class, 'SelectUnit'])->name('SelectUnit');
    Route::post('/SelectedUnit', [CrudController::class, 'SelectedUnit'])->name('SelectedUnit');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('ManageCourses')->group(function () {
        Route::get('/', [PagesController::class, 'ManageCourses'])->name('ManageCourses');
        Route::get('/AddCategoryCourses', [PagesController::class, 'AddCategoryCourses'])->name('AddCategoryCourses');
        Route::get('/EditCategoryCourses/{id}', [PagesController::class, 'EditCategoryCourses'])->name('EditCategoryCourses');
        Route::post('/EditedCategoryCourses/{id}', [CrudController::class, 'EditedCategoryCourses'])->name('EditedCategoryCourses');
        Route::post('/AddedCategoryCourses', [CrudController::class, 'AddedCategoryCourses'])->name('AddedCategoryCourses');
        Route::get('/DeleteCategoryCourses/{id}', [CrudController::class, 'DeleteCategoryCourses'])->name('DeleteCategoryCourses');

        Route::prefix('{category}')->group(function () {
            Route::get('', [PagesController::class, 'Courses'])->name('Courses');
            Route::get('/AddCourses', [PagesController::class, 'AddCourses'])->name('AddCourses');
            Route::get('/EditCourses/{id}', [PagesController::class, 'EditCourses'])->name('EditCourses');
            Route::post('/AddedCourses', [CrudController::class, 'AddedCourses'])->name('AddedCourses');
            Route::get('/DeleteCourses/{id}', [CrudController::class, 'DeleteCourses'])->name('DeleteCourses');
            Route::post('/EditedCourses/{id}', [CrudController::class, 'EditedCourses'])->name('EditedCourses');
        });
    });

    Route::prefix('ManageVideos')->group(function () {
        Route::get('/', [PagesController::class, 'ManageVideos'])->name('ManageVideos');
        Route::get('/AddVideos', [PagesController::class, 'AddVideos'])->name('AddVideos');
        Route::get('/EditVideos/{id}', [PagesController::class, 'EditVideos'])->name('EditVideos');
        Route::post('/AddedVideos', [CrudController::class, 'AddedVideos'])->name('AddedVideos');
        Route::post('/EditedVideos/{id}', [CrudController::class, 'EditedVideos'])->name('EditedVideos');
        Route::get('/DeleteVideos/{id}', [CrudController::class, 'DeleteVideos'])->name('DeleteVideos');

        Route::prefix('{courses}')->group(function () {
            Route::get('/', [PagesController::class, 'VideoDetail'])->name('VideoDetail');
            Route::get('/AddVideoDetail', [PagesController::class, 'AddVideoDetail'])->name('AddVideoDetail');
            Route::get('/EditVideoDetail/{id}', [PagesController::class, 'EditVideoDetail'])->name('EditVideoDetail');
            Route::post('/EditedVideoDetail/{id}', [CrudController::class, 'EditedVideoDetail'])->name('EditedVideoDetail');
            Route::post('/AddedVideoDetail', [CrudController::class, 'AddedVideoDetail'])->name('AddedVideoDetail');
            Route::get('/DeleteVideoDetail/{id}', [CrudController::class, 'DeleteVideoDetail'])->name('DeleteVideoDetail');
        });
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
        Route::get('/EditUser', [PagesController::class, 'EditUser'])->name('EditUser');
    });
    Route::prefix('ManageAttendence')->group(function () {
        Route::get('/', [PagesController::class, 'ManageAttendence'])->name('ManageAttendence');
        Route::get('/AddAttendence', [PagesController::class, 'AddAttendence'])->name('AddAttendence');
        Route::get('/EditAttendence', [PagesController::class, 'EditAttendence'])->name('EditAttendence');
    });
});
