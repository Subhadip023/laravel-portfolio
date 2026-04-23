<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin');

Route::get('/admin/blogs', function () {
    return view('admin.blogs.index');
})->name('admin.blogs.index');

Route::get('/admin/blogs/create', function () {
    return view('admin.blogs.create');
})->name('admin.blogs.create');

