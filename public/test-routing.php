<?php
// public/test-routing.php

echo "<h1>Routing Test</h1>";

echo "<h2>Direct Method (Old Way):</h2>";
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../app/Repositories/CoachRepository.php';
require_once __DIR__ . '/../app/Controllers/CoachController.php';

try {
    CoachController::listCoach();
    echo "<p>✅ Old method works!</p>";
} catch (Exception $e) {
    echo "<p>❌ Error: " . $e->getMessage() . "</p>";
}