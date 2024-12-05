<?php
$message = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id = $_GET['id'] ?? '';
    if ($id) {
        $title = "Chỉnh sửa thể loại tin tức";
        $submit = "Cập nhật";
        $name = $category->getName();
    } else {
        $title = "Thêm thể loại tin tức";
        $submit = "Thêm";
    }
} else {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = $_POST['id'] ?? '';
        if ($id) {
            $title = "Chỉnh sửa thể loại tin tức";
            $submit = "Cập nhật";
            $name = $category->getName();
        } else {

            $title = "Thêm thể loại tin tức";
            $submit = "Thêm";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container my-5">
        <h1 class="text-center text-success mb-4"><?php echo $title ?></h1>

        <?php if ($message): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($message); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if ($errors): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php foreach ($errors as $error): ?>
                    <div><?= htmlspecialchars($error); ?></div>
                <?php endforeach; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form method="Post" action="" class="p-4 border rounded shadow">
            <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id'] ?? ''); ?>">

            <div class="mb-3">
                <label for="name" class="form-label">Tên thể loại:</label>
                <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($name ?? ''); ?>" required>
            </div>

            <button type="submit" class="btn btn-success w-40"><?php echo $submit ?> </button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>