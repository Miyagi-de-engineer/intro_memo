<?php

session_start();
require_once __DIR__ . '/lib/mysqli.php';
require_once __DIR__ . '/lib/escape.php';
$errors = [];

$title = 'メモの登録';
$content = __DIR__ . '/views/new.php';
@include __DIR__ . '/views/layout.php';
