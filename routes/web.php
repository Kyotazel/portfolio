<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryMenuController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SkillController;
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


Route::get('/', [PublicController::class, 'index']);
Route::post('/contact-me', [PublicController::class, 'contact_me'])->name('contact-me');

Route::get('/service/{slug}', [PublicController::class, 'service_detail']);

Route::get('/portfolios', [PublicController::class, 'portfolios'])->name('portfolios');
Route::get('/portfolio/{slug}', [PublicController::class, 'portfolio_detail']);

Route::get('/blogs', [PublicController::class, 'blogs'])->name('blogs');
Route::get('/blog/{slug}', [PublicController::class, 'blog_detail']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/category-menu', [CategoryMenuController::class, 'index']);
    Route::post('/category-menu/store', [CategoryMenuController::class, 'store'])->name('category_menu.store');
    Route::post('/category-menu/edit', [CategoryMenuController::class, 'edit'])->name('category_menu.edit');
    Route::post('/category-menu/destroy', [CategoryMenuController::class, 'destroy'])->name('category_menu.destroy');
    Route::post('/category-menu/change', [CategoryMenuController::class, 'change'])->name('category_menu.change');

    Route::get('/menu', [MenuController::class, 'index']);
    Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store');
    Route::post('/menu/edit', [MenuController::class, 'edit'])->name('menu.edit');
    Route::post('/menu/destroy', [MenuController::class, 'destroy'])->name('menu.destroy');
    Route::post('/menu/change', [MenuController::class, 'change'])->name('menu.change');

    Route::get('/skill', [SkillController::class, 'index']);
    Route::post('/skill/store', [SkillController::class, 'store'])->name('skill.store');
    Route::post('/skill/edit', [SkillController::class, 'edit'])->name('skill.edit');
    Route::post('/skill/destroy', [SkillController::class, 'destroy'])->name('skill.destroy');

    Route::get('/education', [EducationController::class, 'index']);
    Route::post('/education/store', [EducationController::class, 'store'])->name('education.store');
    Route::post('/education/edit', [EducationController::class, 'edit'])->name('education.edit');
    Route::post('/education/destroy', [EducationController::class, 'destroy'])->name('education.destroy');

    Route::get('/experience', [ExperienceController::class, 'index']);
    Route::post('/experience/store', [ExperienceController::class, 'store'])->name('experience.store');
    Route::post('/experience/edit', [ExperienceController::class, 'edit'])->name('experience.edit');
    Route::post('/experience/destroy', [ExperienceController::class, 'destroy'])->name('experience.destroy');

    Route::get('/service', [ServiceController::class, 'index']);
    Route::get('/service/create', [ServiceController::class, 'create']);
    Route::post('/service/store', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/service/edit/{slug}', [ServiceController::class, 'edit'])->name('service.edit');
    Route::post('/service/destroy', [ServiceController::class, 'destroy'])->name('service.destroy');

    Route::get('/portfolio', [PortfolioController::class, 'index']);
    Route::get('/portfolio/create', [PortfolioController::class, 'create']);
    Route::post('/portfolio/store', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::get('/portfolio/edit/{slug}', [PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::post('/portfolio/destroy', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');

    Route::get('/blog', [BlogController::class, 'index']);
    Route::get('/blog/create', [BlogController::class, 'create']);
    Route::post('/blog/store', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/edit/{slug}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('/blog/destroy', [BlogController::class, 'destroy'])->name('blog.destroy');

    Route::get('/contact', [ContactController::class, 'index']);

});

require __DIR__.'/auth.php';
