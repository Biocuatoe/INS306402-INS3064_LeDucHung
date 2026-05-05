<?php
// public/index.php  — Front Controller (Single Entry Point)

session_start();

// Map controller names to their class files
$controllerMap = [
    'patient'     => [
        'file'  => __DIR__ . '/../controllers/PatientController.php',
        'class' => 'PatientController',
    ],
    'appointment' => [
        'file'  => __DIR__ . '/../controllers/AppointmentController.php',
        'class' => 'AppointmentController',
    ],
];

// Determine which controller and action to use
$controllerKey = $_GET['controller'] ?? 'patient';
$action        = $_GET['action']     ?? 'index';

// Whitelist check — prevent arbitrary file inclusion
if (!array_key_exists($controllerKey, $controllerMap)) {
    http_response_code(404);
    exit("Controller not found.");
}

$controllerInfo = $controllerMap[$controllerKey];

// Load the controller class
require_once $controllerInfo['file'];

$controllerClass = $controllerInfo['class'];
$controller = new $controllerClass();

// Whitelist allowed actions per controller
$allowedActions = [
    'patient'     => ['index', 'create', 'store', 'edit', 'update', 'delete', 'show'],
    'appointment' => ['index', 'create', 'store', 'edit', 'update', 'delete'],
];

if (!in_array($action, $allowedActions[$controllerKey] ?? [])) {
    http_response_code(404);
    exit("Action not found.");
}

// Dispatch: call the action method on the controller
$controller->$action();
