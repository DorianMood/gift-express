<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="/site/assets/images/favicon.ico" type="image/x-icon">
    <?php include ROOT . '/components/Asset.php'; ?>
    <title>Панель администратора</title>
</head>

<body>
<!-- Head -->
    <?php include ROOT . '/views/header.php'; ?>
    <h1 align='center'>ADMIN PANNEL</h1><br />
<!-- Orders -->
    <?php include ROOT . '/views/ordersAdmin.php'; ?>
<!-- Items -->
    <?php include ROOT . '/views/itemsAdmin.php'; ?>
</body>

</html>
