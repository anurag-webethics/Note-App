<?php

use App\Http\Controllers\InvitationDetailController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\NoteAppController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/view', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(NoteController::class)->group(function () {
        Route::get('note/view/{id}', 'index')->name('note.view');
        Route::get('notes', 'show')->name('notes');
        Route::post('note/view', 'store')->name('note.insert');
        Route::get('note/delete/{id}', 'destroy')->name('note.delete');
        Route::get('note/edit/{id}', 'edit')->name('note.edit');
        Route::post('note/edit/{id}', 'update')->name('note.update');
    });
    Route::controller(MailController::class)->group(function () {
        Route::get('/email', 'create')->name('email.send');
        Route::get('/email/page', 'show')->name('email.page');
        Route::post('/invite/user', 'store')->name('invite.user');
    });
});

// Route::get('invitation/view', function () {
//     return view('notes.invite-view');
// })->name('');

Route::get('/public/note/view/{id}', [NoteController::class, 'shareNoteView'])->name('public.link');

Route::controller(InvitationDetailController::class)->group(function () {
    Route::get('/invitation/view/{token}', 'index')->name('invitation.view');
    Route::get('/invitation/reject{token}', 'invitationReject')->name('invitation.reject');
    Route::get('/invitation/accept{token}', 'invitationAccept')->name('invitation.accept');
});



require __DIR__ . '/auth.php';
