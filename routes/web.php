<?php

use App\Http\Controllers\InvitationDetailController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Testing;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/add/note', function () {
    return view('notes.note-add');
})->middleware(['auth', 'verified'])->name('note.add');

Route::get('/note/view/{id}', [NoteController::class, 'show'])->name('note.view');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('note', NoteController::class);

    // Route::controller(NoteController::class)->group(function () {
    //     Route::get('note/view/{id}', 'index')->name('note.view');
    //     Route::get('notes', 'show')->name('notes');
    //     Route::post('note/view', 'store')->name('note.create');
    //     Route::get('note/delete/{id}', 'destroy')->name('note.delete');
    //     Route::get('note/edit/{id}', 'edit')->name('note.edit');
    //     Route::post('note/edit/{id}', 'update')->name('note.update');
    // });

    Route::controller(MailController::class)->group(function () {
        Route::get('/colleagues', 'create')->name('email.send');
        Route::get('/email/page', 'show')->name('email.page');
        Route::post('/invite/user', 'store')->name('invite.user');
    });
});

Route::controller(InvitationDetailController::class)->group(function () {
    Route::get('/invitation/view/{token}', 'index')->name('invitation.view');
    Route::get('/invitation/reject{token}', 'invitationReject')->name('invitation.reject');
    Route::get('/invitation/accept{token}', 'invitationAccept')->name('invitation.accept');
});

Route::get('/public/note/view/{id}', [NoteController::class, 'shareNoteView'])->name('public.link');

Route::fallback(function () {
    return back();
});

require __DIR__ . '/auth.php';
