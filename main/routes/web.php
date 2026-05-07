<?php

Route::middleware(['web', 'auth', 'verified'])->group(function () {
    Route::prefix('admin/rezgo')->name('rezgo.')->group(function () {
        Route::get('submissions', 'App\Http\Controllers\RezgoTrackingController@dashboard')->name('dashboard');
        Route::get('api/submission/{orderId}', 'App\Http\Controllers\RezgoTrackingController@getSubmission')->name('submission.api');
        Route::get('api/submissions', 'App\Http\Controllers\RezgoTrackingController@getAllSubmissions')->name('submissions.api');
        Route::get('api/submission-detail/{id}', 'App\Http\Controllers\RezgoTrackingController@getSubmissionDetail')->name('detail.api');
    });
});
