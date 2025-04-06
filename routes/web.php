<?php

use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;
 
Route::get('/', [PetController::class, 'showPetSearch']);

Route::get('/pets/{id}', [PetController::class, 'showPetOverview'])->name('pet.overview');



