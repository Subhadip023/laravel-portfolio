<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/blog', function () {
    return view('blog.index');
})->name('blog.index');

Route::get('/blog/{id}', function ($id) {
    return view('blog.show', ['id' => $id]);
})->name('blog.show');

Route::get('/designs', function () {
    return view('designs');
})->name('designs');

Route::get('/projects', function () {
    return view('projects');
})->name('projects');


// admin routes 

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin');

    Route::get('/blogs', [\App\Http\Controllers\BlogController::class, 'index'])->name('admin.blogs.index');
    Route::get('/blogs/create', [\App\Http\Controllers\BlogController::class, 'create'])->name('admin.blogs.create');
    Route::post('/blogs', [\App\Http\Controllers\BlogController::class, 'store'])->name('admin.blogs.store');
});





require __DIR__ . '/auth.php';
