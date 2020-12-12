<?php

session_start();
require_once __DIR__ . '/lib/mysqli.php';

$link = dbConnect();

if ($_REQUEST['id']) {
    try {
        $id = $_REQUEST['id'];

        // SQL文を準備する
        $query = 'DELETE FROM memos WHERE id=?';
        // 変数stmtにprepareを用いてqueryをセットする
        $stmt = $link->prepare($query);
        // 削除先のidをバインドする。 'i'はintegerの意味
        $stmt->bind_param('i', $id);
        // SQLの実行
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

header('Location:index.php');
exit();


// function deleteMemo($link)
// {

//     $id = $_SESSION['id'];

//     $sql = 'DELETE FROM memos WHERE id=1';

//     $result = mysqli_query($link, $sql);

//     if (!$result) {
//         error_log('Error:fail to delete memo');
//         error_log('Debugging Error:' . mysqli_error($link));
//     }

//     mysqli_close($link);
// }

// $link = dbConnect();
// deleteMemo($link);
