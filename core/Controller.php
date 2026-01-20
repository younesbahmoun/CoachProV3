<?php
// core/Controller.php

class Controller {
    
    protected function view($view, $data = []) {
        extract($data);
        require_once __DIR__ . "/../app/Views/{$view}.php";
    }

    protected function redirect($uri) {
        header("Location: {$uri}");
        exit;
    }

    protected function json($data, $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function isAuthenticated() {
        return isset($_SESSION['user_id']);
    }

    protected function requireAuth() {
        if (!$this->isAuthenticated()) {
            $this->redirect('/login');
        }
    }

    protected function requireRole($role) {
        $this->requireAuth();
        if ($_SESSION['user_role'] !== $role) {
            $this->redirect('/');
        }
    }
}