<h1 class="h4 text-dark mb-4">登録メモ一覧</h1>
<a href="new.php" class="btn btn-success mb-3">メモを新しく登録する<i class="fas fa-pencil-alt ml-2"></i></a>
<?php if (count($memos) > 0) : ?>
    <?php foreach ($memos as $memo) : ?>
        <!-- 登録されているメモがあればループで取得してくる -->
        <div class="card mb-4">
            <h2 class="card-header h5 mb-4"><?php echo escape($memo['title']); ?></h2>
            <div class="card-body">
                <div class="card-text mb-3">カテゴリ：<?php echo escape($memo['category']); ?>&nbsp;/&nbsp;重要度：<?php echo escape($memo['importance']); ?></div>
                <p><?php echo nl2br(escape($memo['summary'])); ?></p>
                <a href="delete_memo.php?id=<?php echo escape($memo['id']); ?>" class="btn btn-danger">削除する<i class="far fa-trash-alt ml-2"></i></a>
            </div>
            <div class="card-footer text-muted text-right"><?php echo escape(date('Y年m月d日', strtotime($memo['created_at'])));  ?></div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <!-- 登録されているメモがなければ何も表示しない -->
    <p>登録されているメモはありません</p>
<?php endif; ?>
