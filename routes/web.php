<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VendorController;
use Illuminate\Routing\RouteRegistrar;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// authenticated Routs
Route::post('create-vendor', [AuthController::class, 'createVendor'])->name('create.vendor');
Route::post('verify-otp', [AuthController::class, 'verifyOtp'])->name('verify.otp');
Route::post('authenticate-user', [AuthController::class, 'authenticateUser'])->name('authenticate.user');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('login-admin', [AuthController::class, 'adminLogin']);
Route::post('login', [AuthController::class, 'loginAdmin'])->name('login');



// Web Routes 
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('post-property', [HomeController::class, 'postProperty'])->name('post.property');
Route::post('submit-property', [HomeController::class, 'submitPostProperty'])->name('submit.property');

// home page Routes 
Route::post('location-property', [HomeController::class, 'locationProperties'])->name('location.properties');
Route::post('index-filters-search', [HomeController::class, 'searchFilterIndex'])->name('index.filters.search');
Route::get('project-list/{id}/{name}', [HomeController::class, 'allListing'])->name('all.listing');
Route::get('project-city/{id}/{name}', [HomeController::class, 'allListing'])->name('city.listing');
Route::get('project-cat/{id}/{name}', [HomeController::class, 'allListing'])->name('category.filter');
Route::get('PG-Co-Living/{id}/{name}', [HomeController::class, 'allListing'])->name('PG.Co.Living');
Route::get('paying-guest/{id}/{name}', [HomeController::class, 'allListing'])->name('paying.guest');
Route::get('project-cat-prop/{id}/{name}', [HomeController::class, 'allListing'])->name('project.cat.city');
Route::get('paying-living/{id}/{name}', [HomeController::class, 'allListing'])->name('paying.living');
Route::get('paying-guests-search/{id}/{name}', [HomeController::class, 'allListing'])->name('paying.living.search');
Route::post('all-list-filters', [HomeController::class, 'allListingFilters'])->name('all.list.filters');


Route::get('single-list/{id}/{name}', [HomeController::class, 'singlePropertyListing'])->name('single.list');
Route::post('insert-review', [HomeController::class, 'insertReview'])->name('insert.review');
Route::post('add-fav', [HomeController::class, 'addToFavProperty'])->name('add.fav.property');
// Dashboard Routes 

Route::get('welcome-dashboard', [DashboardController::class, 'index'])->name('welcome.dashboard');
Route::get('profile', [DashboardController::class, 'myProfile'])->name('profile');
Route::post('update-profile', [DashboardController::class, 'updateProfile'])->name('update.profile');
Route::post('image-delete', [DashboardController::class, 'profileImageRemove'])->name('profile.delete');

// vendor routes 
Route::get('my-property', [VendorController::class, 'index'])->name('my.postProperty');
Route::get('edit-post/{name}/{id}', [VendorController::class, 'editPostProperty'])->name('edit.postProperty');
Route::get('single/{name}/{id}', [VendorController::class, 'singlePropertyListing'])->name('single');

// Admin Route 
Route::get('manage-all-properties', [AdminController::class, 'manageAllProperties'])->name('manage.allProperties');
Route::post('manage-status', [AdminController::class, 'managePropertyStatus'])->name('manage.property.status');
Route::post('delete-property', [AdminController::class, 'deleteProperty'])->name('property.delete.admin');
Route::get('admin-property', [AdminController::class, 'postPropertiesAdmin'])->name('admin.postProperty');
Route::get('news-articles', [AdminController::class, 'newsArticles'])->name('manage.news.articles');
Route::get('article/{id}/{name}', [AdminController::class, 'singleArticle'])->name('article');
Route::get('post-news-articles', [AdminController::class, 'postNewsArticles'])->name('post.news.articles');
Route::post('article-category', [AdminController::class, 'articleCategory'])->name('add.article.category');
Route::post('submit-articles', [AdminController::class, 'insertArticles'])->name('submit.articles');
Route::get('edit-article/{id}/{name}', [AdminController::class, 'editArticle'])->name('edit.article');
Route::post('update-articles', [AdminController::class, 'updateArticle'])->name('update.articles');
Route::post('manage-articleStatus', [AdminController::class, 'manageArticleStatus'])->name('manage.articleStatus');
Route::post('delete-article', [AdminController::class, 'deleteArticle'])->name('delete.article');
Route::get('user', [DashboardController::class, 'userList'])->name('users');
Route::get('property-owner', [DashboardController::class, 'vendorList'])->name('property.owner');
