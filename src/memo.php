<?php

require_once __DIR__ . '/vendor/auto_load.php';

// DB接続関数
function dbConnect()
{
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
    $dotenv->load();

    $db_host = $_ENV['DB_HOST'];
    $db_username = $_ENV['DB_USERNAME'];
    $db_password = $_ENV['DB_PASSWORD'];
    $db_database = $_ENV['DB_DATABASE'];

    $link = mysqli_connect($db_host, $db_username, $db_password, $db_database);

    if (!$link) {
        echo 'DBに接続できませんでした' . PHP_EOL;
        echo 'DebuggingError:' . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    return $link;
}

// バリデーションチェック関数
function validate($memo)
{
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
    } elseif (!in_array($memo['category'], ['仕事', '日常', 'アイディア'])) {
        $errors['category'] = 'カテゴリは「仕事」「日常」「アイディア」の３つから入力してください';
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

// メモの作成関数
function createMemo($link)
{
    $memo = [];
    // メモの登録処理
    echo 'メモを登録します' . PHP_EOL;

    echo 'タイトル：';
    $memo['title'] = trim(fgets(STDIN));

    echo 'カテゴリ（仕事・日常・アイディアのいずれか）：';
    $memo['category'] = trim(fgets(STDIN));

    echo '重要度（1~5の整数で入力）：';
    $memo['importance'] = (int)trim(fgets(STDIN));

    echo '内容：';
    $memo['summary'] = trim(fgets(STDIN));

    $validate = validate($memo);

    if (count($validate) > 0) {
        foreach ($validate as $error) {
            echo $error . PHP_EOL;
        }
        return;
    }

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
    $results = mysqli_query($link, $sql);

    if ($results) {
        echo '新しいメモが登録されました！' . PHP_EOL;
    } else {
        echo 'Error:データが追加できませんでした' . PHP_EOL;
        echo 'DebuggingError:' . mysqli_error($link) . PHP_EOL;
    }
}

// メモの表示関数
function showMemos($link)
{
    echo '登録されたメモを表示します' . PHP_EOL;

    // DBから登録された内容の取得
    $sql = ('SELECT * FROM memos');
    // SQLの実行と変数への格納
    $results = mysqli_query($link, $sql);

    foreach ($results as $memo) {
        echo 'タイトル：' . $memo['title'] . PHP_EOL;
        echo 'カテゴリ：' . $memo['category'] . PHP_EOL;
        echo '重要度：' . $memo['importance'] . PHP_EOL;
        echo '内容：' . $memo['summary'] . PHP_EOL;
        echo '------------------------------' . PHP_EOL;
    }
}

$link = dbConnect();

while (true) {

    echo '1:メモを登録する' . PHP_EOL;
    echo '2:メモを表示する' . PHP_EOL;
    echo '3:メモを削除する' . PHP_EOL;
    echo '9:アプリケーションを終了する' . PHP_EOL;

    echo '番号を選択してください：';
    // ユーザーから入力値を取得する(int)へキャスト処理を行う
    $num = (int)fgets(STDIN);

    if ($num === 1) {
        createMemo($link);
    } elseif ($num === 2) {
        // メモの表示処理
        showMemos($link);
    } elseif ($num === 3) {
        // メモの削除処理
        echo 'メモを削除します' . PHP_EOL;
    } elseif ($num === 9) {
        // アプリケーションの終了
        echo 'アプリケーションを終了します' . PHP_EOL;
        break;
    }
}
