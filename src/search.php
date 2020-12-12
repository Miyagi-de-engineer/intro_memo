<?php

session_start();
require_once __DIR__ . '/lib/mysqli.php';
require_once __DIR__ . '/lib/escape.php';

function searchMemo($link)
{
}

$link = dbConnect();
$searchResult = searchMemo($link);

$title = 'メモの検索結果';
$content = __DIR__ . '/views/search.php';
@include __DIR__ . '/views/layout.php';
