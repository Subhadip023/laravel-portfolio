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

Route::get('/blog', function (\Illuminate\Http\Request $request) {
    $query = \App\Models\Blog::where('status', '1');
    
    if ($request->has('id')) {
        $query->where('category_id', $request->id);
    }
    
    $blogs = $query->latest()->get();
    $categories = \App\Models\Category::all();
    
    return view('blog.index', compact('blogs', 'categories'));
})->name('blog.index');

Route::get('/blog/{blog}', function (\App\Models\Blog $blog) {
    // Optionally check if published: if ($blog->status != '1') abort(404);
    return view('blog.show', compact('blog'));
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

    Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/categories', [\App\Http\Controllers\CategoryController::class, 'store'])->name('admin.categories.store');
    Route::put('/categories/{category}', [\App\Http\Controllers\CategoryController::class, 'update'])->name('admin.categories.update');

    Route::get('/tags', [\App\Http\Controllers\TagController::class, 'index'])->name('admin.tags.index');
    Route::post('/tags', [\App\Http\Controllers\TagController::class, 'store'])->name('admin.tags.store');
    Route::put('/tags/{tag}', [\App\Http\Controllers\TagController::class, 'update'])->name('admin.tags.update');
});





require __DIR__ . '/auth.php';
