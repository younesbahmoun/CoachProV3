<?php $uri = $_SERVER['REQUEST_URI']; ?>
<div class="nav-tabs">
    <a href="<?= BASE_URL ?>/coach/dashboard">
        <button class="nav-tab <?= strpos($uri, BASE_URL . '/coach/dashboard') !== false ? 'active' : '' ?>">
            <i class="fas fa-home"></i>
            Tableau de bord
        </button>
    </a>
    <a href="<?= BASE_URL ?>/coach/seances-disponibles">
        <button class="nav-tab <?= strpos($uri, BASE_URL . '/coach/seances-disponibles') !== false ? 'active' : '' ?>">
            <i class="fas fa-calendar-alt"></i>
            Mes séances
        </button>
    </a>
    <a href="<?= BASE_URL ?>/coach/seances-reserves">
        <button class="nav-tab <?= strpos($uri, BASE_URL . '/coach/seances-reserves') !== false ? 'active' : '' ?>">
            <i class="fas fa-calendar-check"></i>
            Réservations
        </button>
    </a>
    <a href="<?= BASE_URL ?>/coach/profil">
        <button class="nav-tab <?= strpos($uri, BASE_URL . '/coach/profil') !== false ? 'active' : '' ?>">
            <i class="fas fa-user-circle"></i>
            Mon profil
        </button>
    </a>
</div>