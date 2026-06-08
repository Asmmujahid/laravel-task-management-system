<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/

// ================= ADMIN =================
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TeamController as AdminTeamController;
use App\Http\Controllers\Admin\TaskController as AdminTaskController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\TaskSubmissionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ReportController;

// ================= TEAM LEAD =================
use App\Http\Controllers\TeamLead\TeamLeadController;
use App\Http\Controllers\TeamLead\TaskController as TeamLeadTaskController;
use App\Http\Controllers\TeamLead\TeamController as TeamLeadTeamController;
use App\Http\Controllers\TeamLead\CategoryController as TeamLeadCategoryController;
use App\Http\Controllers\TeamLead\ProgressController;
use App\Http\Controllers\TeamLead\SubmissionController;

// ================= TEAM MEMBER =================
use App\Http\Controllers\TeamMember\TeamMemberController;
use App\Http\Controllers\TeamMember\TaskController as TeamMemberTaskController;
use App\Http\Controllers\TeamMember\ProfileController;
use App\Http\Controllers\TeamMember\CommentFileController;
// ================= AUTH =================
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PasswordResetController;

// ================= NOTIFICATIONS =================
use App\Http\Controllers\Notification\NotificationController;

/*
|--------------------------------------------------------------------------
| PUBLIC WEBSITE PAGES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home.index');
})->name('home');

Route::view('/about', 'home.about')->name('about');

Route::view('/contact', 'home.contact')->name('contact');


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

     Route::get('/register', function () {
        return redirect()->route('home', [
            'form' => 'register'
        ]);
    })->name('register.form');

    Route::post('/register', [RegisterController::class, 'register'])
        ->name('register');

            Route::get('/login', function () {
        return redirect()->route('home', [
            'form' => 'login'
        ]);
    })->name('login.form');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login');
});

Route::post('/logout', [LogoutController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| PASSWORD RESET
|--------------------------------------------------------------------------
*/

Route::get('/forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])
    ->name('password.email');

Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/reset-password', [PasswordResetController::class, 'reset'])
    ->name('password.update');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('teams', AdminTeamController::class);
        Route::resource('tasks', AdminTaskController::class);
        Route::resource('categories', AdminCategoryController::class);

      Route::get('/reports', [ReportController::class, 'index'])
    ->name('reports');

       Route::get('/task-submissions', [TaskSubmissionController::class, 'index'])
            ->name('task.submissions');

        Route::post('/task-submissions/{id}/status', [TaskSubmissionController::class, 'updateStatus'])
    ->name('task.submissions.status');

          Route::get('/task-submissions/edit/{id}', [TaskSubmissionController::class, 'edit'])
        ->name('task.submissions.edit');

    Route::put('/task-submissions/update/{id}', [TaskSubmissionController::class, 'update'])
        ->name('task.submissions.update');

    Route::delete('/task-submissions/delete/{id}', [TaskSubmissionController::class, 'delete'])
        ->name('task.submissions.delete');
    
      Route::get('/settings', [SettingController::class, 'index'])
            ->name('settings.index');

        Route::post('/settings/update', [SettingController::class, 'update'])
            ->name('settings.update');

    });

/*
|--------------------------------------------------------------------------
| TEAM LEAD ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:team_lead'])
    ->prefix('team_lead')
    ->name('team_lead.')
    ->group(function () {

        Route::get('/dashboard', [TeamLeadController::class, 'dashboard'])
            ->name('dashboard');

        // Teams
        Route::get('/teams', [TeamLeadTeamController::class, 'index'])
            ->name('teams.index');

        Route::get('/teams/create', [TeamLeadTeamController::class, 'create'])
            ->name('teams.create');

        Route::post('/teams', [TeamLeadTeamController::class, 'store'])
            ->name('teams.store');

        Route::get('/teams/{id}/edit', [TeamLeadTeamController::class, 'edit'])
            ->name('teams.edit');

        Route::put('/teams/{id}', [TeamLeadTeamController::class, 'update'])
            ->name('teams.update');

        Route::delete('/teams/{id}', [TeamLeadTeamController::class, 'destroy'])
            ->name('teams.destroy');

        Route::delete('/teams/member/{id}', [TeamLeadTeamController::class, 'removeMember'])
            ->name('teams.removeMember');

        // Tasks
        Route::resource('tasks', TeamLeadTaskController::class);

        Route::get('/tasks/{id}/assign', [TeamLeadTaskController::class, 'assignForm'])
            ->name('tasks.assign.form');

        Route::post('/tasks/{id}/assign', [TeamLeadTaskController::class, 'assignToTeam'])
            ->name('tasks.assign');

        // Categories
        Route::resource('categories', TeamLeadCategoryController::class);

        // Progress
        Route::get('/progress', [ProgressController::class, 'index'])
            ->name('progress');

     
        /*
        |--------------------------------------------------------------------------
        | SUBMISSIONS
        |--------------------------------------------------------------------------
        */

          Route::get('/submissions', [SubmissionController::class,'index'])
        ->name('submissions');

    Route::post('/submissions/review/{id}', [SubmissionController::class,'review'])
        ->name('submissions.review');


        Route::get('/submissions/edit/{id}', [SubmissionController::class, 'edit'])
            ->name('submissions.edit');

        Route::put('/submissions/update/{id}', [SubmissionController::class, 'update'])
            ->name('submissions.update');

    

    Route::post('/submissions/final-submit/{id}', [SubmissionController::class,'finalSubmit'])
        ->name('submissions.final.submit');

        Route::delete('/submissions/delete/{id}', [SubmissionController::class, 'delete'])
            ->name('submissions.delete');

    
        
    });

/*
|--------------------------------------------------------------------------
| TEAM MEMBER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:team_member'])
    ->prefix('team_member')
    ->name('team_member.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [TeamMemberController::class, 'dashboard'])
            ->name('dashboard');

        // Tasks
        Route::get('/tasks', [TeamMemberTaskController::class, 'index'])
            ->name('tasks');

        Route::post('/tasks/{id}/status', [TeamMemberTaskController::class, 'updateStatus'])
            ->name('tasks.status');

          Route::get('/comments-files', [CommentFileController::class,'index'])
            ->name('comments.files');

        Route::post('/comments-files', [CommentFileController::class,'store'])
         ->name('comments.files.store');

          // EDIT COMMENT
        Route::get('/comments/{id}/edit', [CommentFileController::class, 'editComment'])
            ->name('comments.edit');

        // UPDATE COMMENT
        Route::put('/comments/{id}', [CommentFileController::class, 'updateComment'])
            ->name('comments.update');

        // DELETE COMMENT
        Route::delete('/comments/{id}', [CommentFileController::class, 'deleteComment'])
            ->name('comments.delete');

        // DELETE FILE
        Route::delete('/files/{id}', [CommentFileController::class, 'deleteFile'])
            ->name('files.delete');


        // Profile
        Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::put('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');
    });

/*
|--------------------------------------------------------------------------
| NOTIFICATIONS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

   Route::post('/notifications/read/{id}',
    [NotificationController::class,'markAsRead'])
    ->name('notifications.read');

    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.readAll');

    Route::delete('/notifications/delete/{id}', [NotificationController::class, 'destroy'])
        ->name('notifications.delete');
});

/*
|--------------------------------------------------------------------------
| ERROR PAGES
|--------------------------------------------------------------------------
*/

Route::view('/403', 'errors.403');
Route::view('/404', 'errors.404');
Route::view('/500', 'errors.500');