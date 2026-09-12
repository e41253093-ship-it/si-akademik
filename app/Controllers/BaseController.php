<?php

namespace App\Controllers;

class BaseController
{
    // Method untuk menampilkan halaman (view)
    protected function view(string $view, array $data = []): void
    {
        extract($data); // ubah array jadi variabel biasa, misal $mahasiswa
        $viewFile = __DIR__ . '/../Views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            throw new \Exception("View tidak ditemukan: {$view}");
        }

        require $viewFile;
    }

    // Method untuk pindah halaman
    protected function redirect(string $url): void
    {
        header("Location: {$url}");
        exit;
    }
}