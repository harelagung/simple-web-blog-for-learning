<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostDashboardController;
use App\Http\Controllers\ProfileController;

Route::get("/", [HomeController::class, "index"])->name("home");
Route::get("/posts", [PostController::class, "explore"]);
Route::get("/about", [AboutController::class, "index"])->name("about.index");
Route::get("/contact", [ContactController::class, "index"])->name("contact.index");

Route::middleware(["auth", "verified"])->group(function () {
    Route::get("/posts/{post:slug}", [PostController::class, "post"]);
    Route::get("/dashboard", [PostDashboardController::class, "index"])->name("dashboard");
    Route::get("/dashboard/create", [PostDashboardController::class, "create"]);
    Route::post("/dashboard/store", [PostDashboardController::class, "store"]);
    Route::get("/dashboard/edit/{post:slug}", [PostDashboardController::class, "edit"]);
    Route::patch("/dashboard/update/{post:slug}", [PostDashboardController::class, "update"]);
    Route::delete("/dashboard/{post:slug}", [PostDashboardController::class, "destroy"]);
    Route::get("/dashboard/{post:slug}", [PostDashboardController::class, "show"])->name("dashboard.show");
});

Route::middleware("auth")->group(function () {
    Route::get("/profile", [ProfileController::class, "edit"])->name("profile.edit");
    Route::patch("/profile", [ProfileController::class, "update"])->name("profile.update");
    Route::delete("/profile", [ProfileController::class, "destroy"])->name("profile.destroy");
    Route::post("/upload", [ProfileController::class, "upload"]);
});

require __DIR__ . "/auth.php";
