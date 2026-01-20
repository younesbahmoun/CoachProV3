<?php
// public/test-apache.php

echo "<h1>Apache Configuration Test</h1>";

// Check if mod_rewrite is loaded
if (function_exists('apache_get_modules')) {
    $modules = apache_get_modules();
    if (in_array('mod_rewrite', $modules)) {
        echo "<p>✅ mod_rewrite is <strong>ENABLED</strong></p>";
    } else {
        echo "<p>❌ mod_rewrite is <strong>DISABLED</strong></p>";
        echo "<p>Enable it with: <code>sudo a2enmod rewrite</code></p>";
    }
} else {
    echo "<p>⚠️ Cannot detect Apache modules (maybe running PHP-FPM)</p>";
}

echo "<h2>Server Variables:</h2>";
echo "<pre>";
echo "DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "REQUEST_URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "SCRIPT_NAME: " . $_SERVER['SCRIPT_NAME'] . "\n";
echo "</pre>";

phpinfo(INFO_MODULES);