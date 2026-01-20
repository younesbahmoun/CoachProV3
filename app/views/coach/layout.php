<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Coach - Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="../public/assets/css/style.css"> -->
    <!-- <link rel="stylesheet" href="../assets/css/style.css"> -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/style.css">
</head>
<body>
    <!-- Header -->
    <?php require_once __DIR__ . '/../partials/header.php'; ?>
    <?php require_once __DIR__ . '/../partials/nav.php'; ?>
    <?= $content ?>
    <script src="main.js"></script>
</body>
</html>