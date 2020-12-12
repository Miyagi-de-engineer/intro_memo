<?php

session_start();
$errors = [];

$title = 'メモの登録';
$content = __DIR__ . '/views/new.php';
@include __DIR__ . '/views/layout.php';
