<?php

require_once __DIR__ . '/lib/mysqli.php';
require_once __DIR__ . '/lib/escape.php';

function listMemos($link)
{
    $memos = [];
    // SQL文
    $sql = 'SELECT * FROM memos';
    // 結果を変数に格納
    $results = mysqli_query($link, $sql);

    while ($memo = mysqli_fetch_assoc($results)) {
        $memos[] = $memo;
    }

    // 降順で表示できるように配列をソートし直す
    arsort($memos);

    mysqli_free_result($results);

    return $memos;
}

$link = dbConnect();
$memos = listMemos($link);

$title = 'メモ一覧';
$content = __DIR__ . '/views/index.php';
include __DIR__ . '/views/layout.php';
