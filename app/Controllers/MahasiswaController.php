<?php
namespace App\Controllers;

use App\Repositories\MahasiswaRepository;
use App\Repositories\ProdiRepository;

class MahasiswaController extends BaseController
{
    private MahasiswaRepository $repo;
    private ProdiRepository $prodiRepo;

    public function __construct()
    {
        $this->repo = new MahasiswaRepository();
        $this->prodiRepo = new ProdiRepository();
    }

    public function index(): void
    {
        $search = $_GET['search'] ?? '';
        $mahasiswa = $this->repo->all($search);
        $this->view('mahasiswa/index', ['mahasiswa' => $mahasiswa]);
    }

    public function create(): void
    {
        $prodiList = $this->prodiRepo->all();
        $this->view('mahasiswa/create', ['prodiList' => $prodiList]);
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->repo->create($_POST);
            $this->redirect('index.php?action=index');
        }
    }

    public function edit(int $id): void
    {
        $mahasiswa = $this->repo->find($id);
        $prodiList = $this->prodiRepo->all();
        $this->view('mahasiswa/edit', ['mahasiswa' => $mahasiswa, 'prodiList' => $prodiList]);
    }

    public function update(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->repo->update($id, $_POST);
            $this->redirect('index.php?action=index');
        }
    }

    public function delete(int $id): void
    {
        $this->repo->delete($id);
        $this->redirect('index.php?action=index');
    }
}