<?php

session_start();
require_once __DIR__ . '/lib/mysqli.php';
require_once __DIR__ . '/lib/escape.php';

function searchMemo($link)
{

    $searches = [];

    try {

        var_dump($_POST['search']);
        $value = $_POST['search'];
        $query = "SELECT * FROM memos WHERE summary LIKE $value";
        $stmt = mysqli_prepare($link, $query);
        $result = mysqli_stmt_execute($stmt);

        while ($searchResult = mysqli_stmt_fetch($stmt)) {
            $searches[] = $searchResult;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    var_dump($searches);

    return $searches;
}

$link = dbConnect();
$searchResults = searchMemo($link);

$title = 'メモの検索結果';
$content = __DIR__ . '/views/search.php';
@include __DIR__ . '/views/layout.php';
