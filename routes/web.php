<?php
// routes/web.php

// Define Application Routes
$router->get('/', 'CoachController', 'listCoaches');
$router->get('/coaches', 'CoachController', 'listCoaches');
$router->get('/coaches/{id}', 'CoachController', 'showCoach');

// Coach Actions
$router->get('/coach/ajouter-seance', 'CoachController', 'AjouterSeance');
$router->post('/coach/ajouter-seance', 'CoachController', 'submitSeance');
$router->get('/coach/seances-disponibles', 'CoachController', 'toutSeanceDisponible');
$router->get('/coach/seances-reserves', 'CoachController', 'toutSeanceReserve');

// Add more routes here as needed