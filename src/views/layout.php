<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheets/css/app.css">
    <title><?php echo $title; ?></title>
</head>

<body>

    <!-- Header -->
    <header class="navbar shadow-sm p-3 mb-5 bg-white">
        <h1 class="h2">
            <a href="index.php" class="text-body text-decoration-none">メモメモ<i class="fas fa-book ml-2"></i></a>
        </h1>
        <!-- <form action="search.php" class="form-inline" method="post">
            <input type="search" name="search" class="form-control mr-sm-2" value="<?php echo escape($search_value); ?>" placeholder="メモの検索">
            <button class="btn btn-outline-info" type="submit">Search</button>
        </form> -->
    </header>

    <div class="container">
        <?php include $content; ?>
    </div>
    <script src="https://kit.fontawesome.com/6138d6e315.js" crossorigin="anonymous"></script>
</body>

</html>
