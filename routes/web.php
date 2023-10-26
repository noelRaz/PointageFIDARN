<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersController;
use App\Http\Controllers\AccSpeController;
use App\Http\Controllers\PointageGlobalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\UtilisateurController;

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
    return view('auth/login');
});

//Personnelle route
Route::get('/pointpersonnel', [PersController::class, 'pointagePers'])->middleware(['auth'])->name('Pointpers');
Route::get('/pointageFiltre', [PersController::class, 'pointageFiltrePers']);
Route::get('/listepersonnel', [PersController::class, 'index'])->middleware(['auth'])->name('Listepers');
Route::post('addPers', [PersController::class, 'addPers']);
Route::post('addPoint', [PersController::class, 'addPointPers']);
Route::get('/supprimePers/{persID}', [PersController::class, 'suppPers'])->middleware(['auth'])->name('suppPers');
Route::put('/deletepersonnel', [PersController::class, 'deletePers'])->middleware(['auth'])->name('deletepers');
Route::get('/editpersonnel/{persID}', [PersController::class, 'edit'])->middleware(['auth'])->name('editpers');
Route::put('/updatepersonnel', [PersController::class, 'update']);
Route::get('/cartepersonnel/{persID}', [PersController::class, 'cartePers'])->middleware(['auth'])->name('detailpers');

//accompagnateur spécialisé et opérateur de saisie
Route::get('/pointAS', [AccSpeController::class, 'pointageExt'])->middleware(['auth'])->name('PointAS');
Route::get('/listeAS', [AccSpeController::class, 'index'])->middleware(['auth'])->name('ListeAS');
Route::post('addExt', [AccSpeController::class, 'addExt']);
Route::post('addPointExt', [AccSpeController::class, 'addExtPoint']);
Route::put('/deleteExt', [AccSpeController::class, 'deleteExt'])->middleware(['auth'])->name('deleteExt');
Route::get('/supprimeExt/{persID}', [AccSpeController::class, 'suppExt'])->middleware(['auth'])->name('suppExt');
Route::get('/detailpersext/{persID}', [AccSpeController::class, 'detailExt'])->middleware(['auth'])->name('detailext');
Route::get('/editExt/{persID}', [AccSpeController::class, 'edit'])->middleware(['auth'])->name('editpers');
Route::put('/updateASOS', [AccSpeController::class, 'updateExt']);
Route::get('/carteExt/{persID}', [AccSpeController::class, 'carteExt'])->middleware(['auth'])->name('detailpers');
Route::get('/pointageFiltreExt', [AccSpeController::class, 'pointageFiltreExt']);

//Utilisateur
Route::get('/utilisateur', [UtilisateurController::class, 'index'])->middleware(['auth'])->name('Utilisateur');
Route::get('/supprimeUser/{userID}', [UtilisateurController::class, 'suppUser'])->middleware(['auth'])->name('suppUser');
Route::get('/supprimeUser/{persID}', [UtilisateurController::class, 'suppUser'])->middleware(['auth'])->name('suppUser');
Route::put('/deleteutilisateur', [UtilisateurController::class, 'deleteUser'])->middleware(['auth'])->name('deleteuser');
Route::put('/updateUser', [UtilisateurController::class, 'updateUser']);

//visiteur
Route::get('/visiteur', [VisiteurController::class, 'visiteur'])->middleware(['auth'])->name('Visiteur');
Route::get('/listeVisiteur', [VisiteurController::class, 'listeVis'])->middleware(['auth'])->name('ListeVisiteur');
Route::post('addVisi', [VisiteurController::class, 'addVisi']);
Route::get('/visiteurFiltre', [VisiteurController::class, 'visiteurFiltre']);
Route::get('/editvisiteur/{visiID}', [VisiteurController::class, 'edit'])->middleware(['auth'])->name('editvisi');
Route::put('/updateVisiteur', [VisiteurController::class, 'updateVisi']);

//pointage
Route::get('/pointage', [PointageGlobalController::class, 'index'])->middleware(['auth'])->name('index');
Route::post('addPointGlobal', [PointageGlobalController::class, 'addPointGlobal']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Tableau de bord
//Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
