<?php
echo "<h1>Routing Debugger</h1>";
echo "<pre>";
echo "Request URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "Script Name: " . $_SERVER['SCRIPT_NAME'] . "\n";
echo "PHP Self: " . $_SERVER['PHP_SELF'] . "\n";
echo "</pre>";

$expectedPath = '/CoachProV3';
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (strpos($currentPath, $expectedPath) === 0) {
    echo "<p style='color:green'>Base path matches expected: $expectedPath</p>";
} else {
    echo "<p style='color:orange'>Warning: Current path '$currentPath' does not start with '$expectedPath'. You might need to adjust \$basePath in public/index.php.</p>";
}
