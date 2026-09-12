<?php
namespace App\Services;

use App\Repositories\MahasiswaRepository;
use App\Repositories\ProdiRepository;

class MahasiswaService
{
    private const STATUS_VALID = ['aktif', 'cuti', 'lulus'];

    public function __construct(
        private MahasiswaRepository $repo,
        private ProdiRepository $prodiRepo
    ) {}

    public function create(array $input): array
    {
        $errors = $this->validate($input);

        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors
            ];
        }

        $id = $this->repo->create($input);

        return [
            'success' => true,
            'id' => $id
        ];
    }

    public function update(int $id, array $input): array
    {
        $errors = $this->validate($input, $id);

        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors
            ];
        }

        $this->repo->update($id, $input);

        return [
            'success' => true
        ];
    }

    private function validate(array $input, ?int $excludeId = null): array
    {
        $errors = [];

        // --- NIM ---
        $nim = trim($input['nim'] ?? '');
        if ($nim === '') {
            $errors['nim'] = 'NIM wajib diisi';
        } elseif (!preg_match('/^[A-Za-z0-9]{4,20}$/', $nim)) {
            $errors['nim'] = 'NIM hanya boleh huruf dan angka, panjang 4-20 karakter';
        } elseif ($this->repo->existsByNim($nim, $excludeId)) {
            $errors['nim'] = 'NIM sudah terdaftar';
        }

        // --- Nama ---
        $nama = trim($input['nama'] ?? '');
        if ($nama === '') {
            $errors['nama'] = 'Nama wajib diisi';
        } elseif (mb_strlen($nama) < 3 || mb_strlen($nama) > 100) {
            $errors['nama'] = 'Nama harus antara 3-100 karakter';
        }

        // --- Email ---
        $email = trim($input['email'] ?? '');
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email tidak valid';
        }

        // --- Program Studi ---
        $prodiId = $input['prodi_id'] ?? '';
        if ($prodiId === '' || $prodiId === null) {
            $errors['prodi_id'] = 'Program studi wajib dipilih';
        } elseif (!ctype_digit((string) $prodiId) || !$this->prodiRepo->find((int) $prodiId)) {
            $errors['prodi_id'] = 'Program studi tidak valid';
        }

        // --- Angkatan ---
        $angkatan = $input['angkatan'] ?? '';
        $tahunSekarang = (int) date('Y');
        if ($angkatan === '' || $angkatan === null) {
            $errors['angkatan'] = 'Angkatan wajib diisi';
        } elseif (!ctype_digit((string) $angkatan) || (int) $angkatan < 2000 || (int) $angkatan > $tahunSekarang) {
            $errors['angkatan'] = "Angkatan harus berupa tahun antara 2000 - {$tahunSekarang}";
        }

        // --- Status ---
        $status = $input['status'] ?? '';
        if ($status === '' || $status === null) {
            $errors['status'] = 'Status wajib dipilih';
        } elseif (!in_array($status, self::STATUS_VALID, true)) {
            $errors['status'] = 'Status tidak valid';
        }

        return $errors;
    }
}
