<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HeroSettingController;
use App\Http\Controllers\SkillSettingController;
use App\Http\Controllers\IconController;
use App\Models\Icon;
use App\Models\Setting;
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
    $hero = [
        'name'           => Setting::get('hero_name', 'Subhadip'),
        'title'          => Setting::get('hero_title', 'Laravel Developer'),
        'bio'            => Setting::get('hero_bio', ''),
        'tagline'        => Setting::get('hero_tagline', ''),
        'email'          => Setting::get('hero_email', 'subhadip240420@gmail.com'),
        'projects_label' => Setting::get('hero_projects_label', 'View Projects'),
        'contact_label'  => Setting::get('hero_contact_label', 'Contact Me'),
    ];

    $defaultCategories = [
        ['name' => 'Backend Development',  'icon' => 'backend',  'items' => [['name'=>'PHP','pct'=>95],['name'=>'Laravel','pct'=>92],['name'=>'MySQL','pct'=>85],['name'=>'REST APIs','pct'=>88],['name'=>'SAML Auth','pct'=>75]]],
        ['name' => 'Frontend Development', 'icon' => 'frontend', 'items' => [['name'=>'HTML & CSS','pct'=>90],['name'=>'JavaScript','pct'=>78],['name'=>'Alpine.js','pct'=>70],['name'=>'Tailwind CSS','pct'=>88],['name'=>'Blade Templates','pct'=>95]]],
        ['name' => 'DevOps & Tooling',    'icon' => 'devops',   'items' => [['name'=>'Linux Server','pct'=>80],['name'=>'Git & GitHub','pct'=>88],['name'=>'AI Integration','pct'=>72],['name'=>'Docker (basics)','pct'=>60],['name'=>'Mentoring','pct'=>85]]],
    ];

    $rawCategories = Setting::get('skills_categories');
    $skillCategories = $rawCategories ? json_decode($rawCategories, true) : $defaultCategories;

    $rawTools = Setting::get('skills_tools', 'PHP,Laravel,MySQL,JavaScript,Tailwind CSS,Alpine.js,Linux,Git,GitHub,SAML Auth,Gen AI,REST API,Blade,Composer');
    $skillTools = array_filter(array_map('trim', explode(',', $rawTools)));

    // Load icons keyed by ID for fast lookup in blade
    $iconMap = Icon::all()->keyBy('id');

    return view('index', compact('hero', 'skillCategories', 'skillTools', 'iconMap'));
})->name('home');

Route::get('/blog', function (\Illuminate\Http\Request $request) {
    $query = \App\Models\Blog::where('status', '2');
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
    $designs = \App\Models\Design::with('tags')->where('status', '2')->latest()->get();
    return view('designs', compact('designs'));
})->name('designs');

Route::get('/projects', function () {
    $projects = \App\Models\Project::with('tags')->where('status', '2')->latest()->get();
    return view('projects', compact('projects'));
})->name('projects');

Route::get('/projects/{project}', function (\App\Models\Project $project) {
    if ($project->status != '2') abort(404);
    return view('projects.show', compact('project'));
})->name('projects.show');


// admin routes 

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin');

    Route::get('/blogs', [\App\Http\Controllers\BlogController::class, 'index'])->name('admin.blogs.index');
    Route::get('/blogs/create', [\App\Http\Controllers\BlogController::class, 'create'])->name('admin.blogs.create');
    Route::post('/blogs', [\App\Http\Controllers\BlogController::class, 'store'])->name('admin.blogs.store');
    Route::get('/blogs/{blog}/edit', [\App\Http\Controllers\BlogController::class, 'edit'])->name('admin.blogs.edit');
    Route::put('/blogs/{blog}', [\App\Http\Controllers\BlogController::class, 'update'])->name('admin.blogs.update');
    Route::delete('/blogs/{blog}', [\App\Http\Controllers\BlogController::class, 'destroy'])->name('admin.blogs.destroy');

    Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/categories', [\App\Http\Controllers\CategoryController::class, 'store'])->name('admin.categories.store');
    Route::put('/categories/{category}', [\App\Http\Controllers\CategoryController::class, 'update'])->name('admin.categories.update');

    Route::get('/tags', [\App\Http\Controllers\TagController::class, 'index'])->name('admin.tags.index');
    Route::post('/tags', [\App\Http\Controllers\TagController::class, 'store'])->name('admin.tags.store');
    Route::put('/tags/{tag}', [\App\Http\Controllers\TagController::class, 'update'])->name('admin.tags.update');

    Route::get('/designs', [\App\Http\Controllers\DesignController::class, 'index'])->name('admin.designs.index');
    Route::get('/designs/create', [\App\Http\Controllers\DesignController::class, 'create'])->name('admin.designs.create');
    Route::post('/designs', [\App\Http\Controllers\DesignController::class, 'store'])->name('admin.designs.store');
    Route::get('/designs/{design}/edit', [\App\Http\Controllers\DesignController::class, 'edit'])->name('admin.designs.edit');
    Route::put('/designs/{design}', [\App\Http\Controllers\DesignController::class, 'update'])->name('admin.designs.update');
    Route::delete('/designs/{design}', [\App\Http\Controllers\DesignController::class, 'destroy'])->name('admin.designs.destroy');

    Route::get('/projects', [\App\Http\Controllers\ProjectController::class, 'index'])->name('admin.projects.index');
    Route::get('/projects/create', [\App\Http\Controllers\ProjectController::class, 'create'])->name('admin.projects.create');
    Route::post('/projects', [\App\Http\Controllers\ProjectController::class, 'store'])->name('admin.projects.store');
    Route::get('/projects/{project}/edit', [\App\Http\Controllers\ProjectController::class, 'edit'])->name('admin.projects.edit');
    Route::put('/projects/{project}', [\App\Http\Controllers\ProjectController::class, 'update'])->name('admin.projects.update');
    Route::delete('/projects/{project}', [\App\Http\Controllers\ProjectController::class, 'destroy'])->name('admin.projects.destroy');

    // Hero Section Settings
    Route::get('/hero', [HeroSettingController::class, 'edit'])->name('admin.hero.edit');
    Route::put('/hero', [HeroSettingController::class, 'update'])->name('admin.hero.update');

    // Skills Settings
    Route::get('/skills', [SkillSettingController::class, 'edit'])->name('admin.skills.edit');
    Route::put('/skills', [SkillSettingController::class, 'update'])->name('admin.skills.update');

    // Icon Library
    Route::get('/icons', [IconController::class, 'index'])->name('admin.icons.index');
    Route::post('/icons', [IconController::class, 'store'])->name('admin.icons.store');
    Route::put('/icons/{icon}', [IconController::class, 'update'])->name('admin.icons.update');
    Route::delete('/icons/{icon}', [IconController::class, 'destroy'])->name('admin.icons.destroy');
});





require __DIR__ . '/auth.php';
