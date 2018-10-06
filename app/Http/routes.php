<?php

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('', function () {
    return 'Hello World from API! ;D';
});
