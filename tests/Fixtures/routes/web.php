<?php

app('router')->get('login', function () {
    return response('login');
})->name('login');
