<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メモの登録</title>
</head>

<body>
    <h1>メモの登録</h1>
    <form action="create.php" method="post">
        <?php if (count($errors)) : ?>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <div>
            <label for="title">タイトル：</label>
            <input type="text" name="title" id="title" value="<?php echo $memo['title']; ?>">
        </div>
        <div>
            <label>カテゴリ：</label>
            <div>
                <input type="radio" name="category" id="category1" value="日常" <?php echo ($memo['category'] === '日常') ? 'checked' : ''; ?> checked>
                <label for="category1">日常</label>
            </div>
            <div>
                <input type="radio" name="category" id="category2" value="仕事" <?php echo ($memo['category'] === '仕事') ? 'checked' : ''; ?>>
                <label for="category2">仕事</label>
            </div>
            <div>
                <input type="radio" name="category" id="category3" value="その他" <?php echo ($memo['category'] === 'その他') ? 'checked' : ''; ?>>
                <label for="category3">その他</label>
            </div>

        </div>
        <div>
            <label for="importance">重要度：</label>
            <input type="number" name="importance" id="importance" value="<?php echo $memo['importance']; ?>">
        </div>
        <div>
            <label for="summary">内容：</label>
            <textarea type="text" name="summary" id="summary" rows="10" placeholder="メモする内容を入力してください（1000文字以内）"><?php echo $memo['summary']; ?></textarea>
        </div>
        <button type="submit">登録する</button>
    </form>
</body>

</html>
