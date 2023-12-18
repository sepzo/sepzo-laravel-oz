<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Models\User; // Import the User model

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
 

Route::get('/', function () {


    $userId = session('userId'); // Retrieve the user ID from the session 
    if ($userId) {

        $userController = new UserController();
        $profileContent = $userController->showUserProfile($userId);
        return view('welcome', ['profileContent' => $profileContent]);
    } else {
        $totalUsers = User::count(); // Fetch the total number of users
        return view('welcome', compact('totalUsers'));
    } 

})->name('home');

Route::get('/api/users', [UserController::class, 'getPaginatedUsers']);


Route::get('/users/{userId}', [UserController::class, 'showUserProfile'])->name('user.profile');

Route::get('/users', [UserController::class, 'index'])->name('user.index');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/edit', [UserController::class, 'edit'])->name('user.edit');

Route::put('/update', [UserController::class, 'update'])->name('user.update');



Route::middleware(['guest'])->group(function () {

    Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');

    Route::post('/register', [UserController::class, 'register'])->name('register.store'); 

    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');

    Route::post('/login',[UserController::class, 'login'])->name('postLogin');
});