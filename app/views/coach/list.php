<?php
// app/Views/coach/list.php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>List of Coaches</title>
</head>

<body>
    <h1>Coaches List</h1>
    <p>If you see this, the View is loading correctly.</p>

    <!-- Debug Data -->
    <pre>
    <?php
    if (isset($coaches)) {
        print_r($coaches);
    } else {
        echo "No coaches data found.";
    }
    ?>
    </pre>
</body>

</html>