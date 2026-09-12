<?php
namespace App\Controllers;

use App\Repositories\MahasiswaRepository;
use App\Repositories\ProdiRepository;
use App\Services\MahasiswaService;
use App\Core\Logger;
use Exception;

class MahasiswaController extends BaseController
{
    private MahasiswaRepository $repo;
    private ProdiRepository $prodiRepo;
    private MahasiswaService $service;

    public function __construct()
    {
        $this->repo = new MahasiswaRepository();
        $this->prodiRepo = new ProdiRepository();
        $this->service = new MahasiswaService($this->repo, $this->prodiRepo);
    }

    public function index(): void
    {
        $search = $_GET['search'] ?? '';

        try {
            $mahasiswa = $this->repo->all($search);
        } catch (Exception $e) {
            Logger::error('Gagal mengambil data mahasiswa: ' . $e->getMessage());
            $mahasiswa = [];
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat memuat data. Silakan coba lagi nanti.'
            ];
        }

        $flash = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);

        $this->view('mahasiswa/index', ['mahasiswa' => $mahasiswa, 'flash' => $flash]);
    }

    public function create(): void
    {
        try {
            $prodiList = $this->prodiRepo->all();
        } catch (Exception $e) {
            Logger::error('Gagal mengambil data prodi: ' . $e->getMessage());
            $prodiList = [];
        }

        $this->view('mahasiswa/create', ['prodiList' => $prodiList]);
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $result = $this->service->create($_POST);

                if ($result['success']) {
                    $_SESSION['flash'] = [
                        'type' => 'success',
                        'message' => 'Data mahasiswa berhasil ditambahkan'
                    ];
                } else {
                    $_SESSION['flash'] = [
                        'type' => 'error',
                        'message' => 'Data gagal disimpan: ' . implode(', ', $result['errors'])
                    ];
                }
            } catch (Exception $e) {
                Logger::error('Gagal menambahkan mahasiswa: ' . $e->getMessage());
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Data gagal disimpan. Silakan coba lagi.'
                ];
            }

            $this->redirect('index.php?action=index');
        }
    }

    public function edit(int $id): void
    {
        try {
            $mahasiswa = $this->repo->find($id);
            $prodiList = $this->prodiRepo->all();
        } catch (Exception $e) {
            Logger::error('Gagal mengambil data mahasiswa untuk edit (id=' . $id . '): ' . $e->getMessage());
            $mahasiswa = null;
            $prodiList = [];
        }

        $this->view('mahasiswa/edit', ['mahasiswa' => $mahasiswa, 'prodiList' => $prodiList]);
    }

    public function update(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $result = $this->service->update($id, $_POST);

                if ($result['success']) {
                    $_SESSION['flash'] = [
                        'type' => 'success',
                        'message' => 'Data mahasiswa berhasil diubah'
                    ];
                } else {
                    $_SESSION['flash'] = [
                        'type' => 'error',
                        'message' => 'Data gagal disimpan: ' . implode(', ', $result['errors'])
                    ];
                }
            } catch (Exception $e) {
                Logger::error('Gagal mengubah mahasiswa (id=' . $id . '): ' . $e->getMessage());
                $_SESSION['flash'] = [
                    'type' => 'error',
                    'message' => 'Data gagal disimpan. Silakan coba lagi.'
                ];
            }

            $this->redirect('index.php?action=index');
        }
    }

    public function delete(int $id): void
    {
        try {
            $this->repo->delete($id);
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Data mahasiswa berhasil dihapus'
            ];
        } catch (Exception $e) {
            Logger::error('Gagal menghapus mahasiswa (id=' . $id . '): ' . $e->getMessage());
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Data gagal dihapus. Silakan coba lagi.'
            ];
        }

        $this->redirect('index.php?action=index');
    }
}