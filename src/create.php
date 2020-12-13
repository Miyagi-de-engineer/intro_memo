<?php

// DB接続
require_once __DIR__ . '/lib/mysqli.php';
require_once __DIR__ . '/lib/escape.php';

// DB登録
function createMemo($link, $memo)
{
    // SQL文
    $sql = <<<EOT
    INSERT INTO memos(
        title,
        category,
        importance,
        summary
    ) VALUES (
        "{$memo['title']}",
        "{$memo['category']}",
        "{$memo['importance']}",
        "{$memo['summary']}"
    )
    EOT;
    // クエリの実行
    $result = mysqli_query($link, $sql);

    //クエリに失敗した場合の処理
    if (!$result) {
        error_log('Error: fail to create memo');
        error_log('Debugging Error:' . mysqli_error($link));
    }
}

// バリデーション
function validate($memo)
{
    // エラー格納用配列用
    $errors = [];

    // タイトル入力に関するバリデーションチェック
    if (!strlen($memo['title'])) {
        $errors['title'] = 'タイトルが未入力です';
    } elseif ($memo['title'] > 255) {
        $errors['title'] = 'タイトルは255文字以内で入力してください';
    }

    // カテゴリ入力に関するバリデーションチェック
    if (!strlen($memo['category'])) {
        $errors['category'] = 'カテゴリが未入力です';
    } elseif (!in_array($memo['category'], ['仕事', '日常', 'その他'])) {
        $errors['category'] = 'カテゴリは「仕事」「日常」「その他」の３つから入力してください';
    }

    // 重要度に関するバリデーションチェック
    if (!strlen($memo['importance'])) {
        $errors['importance'] = '重要度が未入力です';
    } elseif ($memo['importance'] < 1 || $memo['importance'] > 5) {
        $errors['importance'] = '重要度は1~5の整数で入力してください';
    }

    // メモ内容の入力に関するバリデーションチェック
    if (!strlen($memo['summary'])) {
        $errors['summary'] = 'メモ内容が未入力です';
    } elseif ($memo['summary'] > 1000) {
        $errors['summary'] = 'メモ内容は1000文字以内で入力してください';
    }

    return $errors;
}

// HTTPメソッドがPOSTだった場合
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POSTされた値を格納
    $memo = [
        'title' => $_POST['title'],
        'category' => $_POST['category'],
        'importance' => $_POST['importance'],
        'summary' => $_POST['summary']
    ];

    // バリデーションの実行
    $errors = validate($memo);

    // エラーがなければ登録処理を行う
    if (!count($errors)) {
        // DB接続
        $link = dbConnect();
        // 登録処理の実行
        createMemo($link, $memo);
        // DB接続を終了
        mysqli_close($link);
        // 一覧ページへ遷移する
        header('Location: index.php');
    }
}

$title = 'メモの登録';
$content = __DIR__ . '/views/new.php';
@include __DIR__ . '/views/layout.php';
