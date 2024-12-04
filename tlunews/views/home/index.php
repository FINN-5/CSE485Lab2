<?php


?>
<?php
//Phân trang
$itemsPerPage = 5;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$totalPages = ceil(count($ds_news) / $itemsPerPage);
$currentPageItems = array_slice($ds_news, ($currentPage - 1) * $itemsPerPage, $itemsPerPage);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý bài viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container-fruid mx-2">
        <h1 class="text-center">Tin Tức</h1>

        <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand text-dark" href="#">TLU News</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <?php foreach (array_slice($ds, 1) as $item) : ?>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#"><?= $item->getName() ?> </a>
                            </li>
                        </ul>
                    <?php endforeach; ?>
                </div>
            </div>
        </nav>

        <!-- Bố cục chính -->
        <div class="row my-4">
            <!-- Cột bên trái: 1 Card lớn -->
            <div class="col-md-8">
                <?php foreach ($currentPageItems as $index => $item) : ?>
                    <?php if ($index < 2): ?>
                        <div class="card mb-4">
                            <img src="<?= $item['image'] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="#" class="text-decoration-none text-dark ">
                                    <h5 class="card-title"><?= $item['title'] ?></h5>
                                </a>

                                <p class="card-text"><?= $item['content'] ?></p>
                                <p class="card-text"><small class="text-muted"><?= $item['created_at'] ?></small></p>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <!-- Cột bên phải: 3 Card nhỏ -->
            <div class="col-md-4">
                <div class="row">
                    <?php foreach (array_slice($currentPageItems, 2) as $index => $item) : ?>
                        <?php if ($index < 3): ?>
                            <div class="col-md-12 mb-3">
                                <div class="card">
                                    <img src="<?= $item['image'] ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <a href="#" class="text-decoration-none text-dark">
                                            <h6 class="card-title"><?= $item['title'] ?></h6>
                                        </a>

                                        <p class="card-text"><?= $item['content'] ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>


    </div>
    <div class="container container-expand-lg bg-body-tertiary sticky-bottom">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php if ($currentPage > 1): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $currentPage - 1 ?>">Trang trước</a></li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++):  ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                <?php endfor; ?>
                <?php if ($currentPage < $totalPages): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $currentPage + 1 ?>">Trang tiếp theo</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>