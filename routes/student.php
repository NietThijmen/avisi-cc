<?php

Route::middleware(['auth:web', 'role:student'])->prefix('/student')->group(function () {

});
