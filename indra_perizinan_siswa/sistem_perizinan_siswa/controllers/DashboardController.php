<?php
require_once 'models/Perizinan.php';
require_once 'models/Siswa.php';
require_once 'models/Kelas.php';
require_once 'models/User.php';

class DashboardController {
    private $perizinanModel;
    private $siswaModel;
    private $kelasModel;
    private $userModel;

    public function __construct() {
        $this->perizinanModel = new Perizinan();
        $this->siswaModel = new Siswa();
        $this->kelasModel = new Kelas();
        $this->userModel = new User();
    }

    public function index() {
        AuthController::checkAuth();
        $user = AuthController::getCurrentUser();

        switch ($user['role']) {
            case 'admin':
                $this->adminDashboard();
                break;
            case 'wali kelas':
                $this->waliKelasDashboard();
                break;
            case 'siswa':
                $this->siswaDashboard();
                break;
            default:
                header('Location: index.php?action=login');
                break;
        }
    }

    private function adminDashboard() {
        $totalPerizinan = count($this->perizinanModel->getAll());
        $totalSiswa = count($this->siswaModel->getAll());
        $totalKelas = count($this->kelasModel->getAll());
        $totalUsers = count($this->userModel->getAll());
        
        require 'views/dashboard/admin.php';
    }

    private function waliKelasDashboard() {
        $perizinan = $this->perizinanModel->getByWaliKelasId($_SESSION['user_id']);
        $totalPending = 0;
        foreach ($perizinan as $p) {
            if ($p['status'] == 'pending') $totalPending++;
        }
        
        require 'views/dashboard/wali_kelas.php';
    }

    private function siswaDashboard() {
        $siswa = $this->siswaModel->getByUserId($_SESSION['user_id']);
        $perizinan = $this->perizinanModel->getBySiswaId($siswa['id']);
        
        require 'views/dashboard/siswa.php';
    }
}
?>