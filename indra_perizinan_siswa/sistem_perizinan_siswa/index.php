<?php
// Autoload controllers
spl_autoload_register(function ($class) {
    if (file_exists('controllers/' . $class . '.php')) {
        require_once 'controllers/' . $class . '.php';
    }
});

// Route requests
$action = $_GET['action'] ?? 'dashboard';

switch ($action) {
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
        
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
        
    case 'dashboard':
        $controller = new DashboardController();
        $controller->index();
        break;
        
    case 'perizinan':
        $controller = new PerizinanController();
        $controller->index();
        break;
        
    case 'perizinan_create':
        $controller = new PerizinanController();
        $controller->create();
        break;
        
    case 'perizinan_update_status':
        $controller = new PerizinanController();
        $controller->updateStatus();
        break;
        
    default:
        header('Location: index.php?action=dashboard');
        break;
}
?>