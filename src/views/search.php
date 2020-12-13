<h1 class="h4 text-dark mb-4">検索結果一覧</h1>
<p>検索結果：&nbsp;<?php echo count($searchResults); ?>&nbsp;件がヒットしました</p>
<?php if (count($searchResults) > 0) : ?>
    <?php foreach ($searchResults as $result) : ?>
        <!-- 登録されているメモがあればループで取得してくる -->
        <div class="card mb-4">
            <h2 class="card-header h5 mb-4"><?php echo escape($result['title']); ?></h2>
            <div class="card-body">
                <div class="card-text mb-3">カテゴリ：<?php echo escape($result['category']); ?>&nbsp;/&nbsp;重要度：<?php echo escape($result['importance']); ?></div>
                <p><?php echo escape(nl2br($result['summary'])); ?></p>
                <a href="delete_memo.php?id=<?php echo escape($result['id']); ?>" class="btn btn-danger">削除する<i class="far fa-trash-alt ml-2"></i></a>
            </div>
            <div class="card-footer text-muted text-right"><?php echo escape(date('Y年m月d日', strtotime($result['created_at'])));  ?></div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <!-- 登録されているメモがなければ何も表示しない -->
    <p>検索内容を含んだメモはありません</p>
<?php endif; ?>
