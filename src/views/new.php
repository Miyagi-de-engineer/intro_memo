        <h1 class="h4 text-dark mb-4">メモの登録</h1>
        <form action="create.php" method="post">
            <?php if (count($errors)) : ?>
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li class="text-danger"><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" name="title" class="form-control" id="title" value="<?php echo $memo['title']; ?>">
            </div>
            <div class="form-group">
                <label>カテゴリ：</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="category" id="category1" value="日常" <?php echo ($memo['category'] === '日常') ? 'checked' : ''; ?> checked>
                    <label class="form-check-label" for="category1">日常</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="category" id="category2" value="仕事" <?php echo ($memo['category'] === '仕事') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="category2">仕事</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="category" id="category3" value="その他" <?php echo ($memo['category'] === 'その他') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="category3">その他</label>
                </div>

            </div>
            <div class="form-group">
                <label for="importance">重要度</label>
                <input type="number" name="importance" class="form-control" id="importance" value="<?php echo $memo['importance']; ?>" placeholder="1~5の整数で入力してください">
            </div>
            <div class="form-group">
                <label for="summary">内容</label>
                <textarea type="text" name="summary" class="form-control" id="summary" rows="10" placeholder="メモする内容を入力してください（1000文字以内）"><?php echo $memo['summary']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">登録する</button>
        </form>
