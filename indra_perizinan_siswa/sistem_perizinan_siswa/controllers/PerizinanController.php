<?php
require_once 'models/Perizinan.php';
require_once 'models/Siswa.php';
require_once 'models/Kelas.php';

class PerizinanController {
    private $perizinanModel;
    private $siswaModel;
    private $kelasModel;

    public function __construct() {
        $this->perizinanModel = new Perizinan();
        $this->siswaModel = new Siswa();
        $this->kelasModel = new Kelas();
    }

    public function index() {
        AuthController::checkAuth();
        $user = AuthController::getCurrentUser();

        if ($user['role'] === 'admin') {
            $perizinan = $this->perizinanModel->getAll();
        } elseif ($user['role'] === 'wali kelas') {
            $perizinan = $this->perizinanModel->getByWaliKelasId($user['id']);
        } else {
            $siswa = $this->siswaModel->getByUserId($user['id']);
            $perizinan = $this->perizinanModel->getBySiswaId($siswa['id']);
        }

        require 'views/perizinan/index.php';
    }

    public function create() {
        AuthController::checkAuth();
        $user = AuthController::getCurrentUser();

        if ($user['role'] !== 'siswa') {
            header('Location: index.php?action=perizinan');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $siswa = $this->siswaModel->getByUserId($user['id']);
            $kelas = $this->kelasModel->getById($siswa['kelas_id']);

            $data = [
                'siswa_id' => $siswa['id'],
                'wali_kelas_id' => $kelas['wali_kelas_id'],
                'tanggal_izin' => $_POST['tanggal_izin'],
                'jam_keluar' => $_POST['jam_keluar'],
                'alasan' => $_POST['alasan']
            ];

            if ($this->perizinanModel->create($data)) {
                header('Location: index.php?action=perizinan&success=1');
            } else {
                $error = "Gagal mengajukan perizinan";
            }
        }

        require 'views/perizinan/create.php';
    }

    public function updateStatus() {
        AuthController::checkAuth();
        $user = AuthController::getCurrentUser();

        if ($user['role'] !== 'wali kelas') {
            header('Location: index.php?action=perizinan');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $status = $_POST['status'];
            $keterangan = $_POST['keterangan'] ?? '';

            if ($this->perizinanModel->updateStatus($id, $status, $keterangan)) {
                header('Location: index.php?action=perizinan&success=1');
            } else {
                $error = "Gagal memperbarui status perizinan";
            }
        }
    }
}
?>