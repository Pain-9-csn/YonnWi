<?php

require_once __DIR__ . '/../model/XassidaDB.php';

class KhassidaController
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $model     = new Khassida();
        $khassidas = $model->getAllKhassidas();

        require_once __DIR__
            . '/../view/pages/vitrine/xassida/listeXassida.php';
    }

    public function show()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;

        if (!$id) {
            header('Location: index.php?page=khassida');
            exit;
        }

        $model     = new Khassida();
        $khassida  = $model->getKhassidaById($id);

        if (!$khassida) {
            header('Location: index.php?page=khassida');
            exit;
        }

        require_once __DIR__
            . '/../view/pages/vitrine/xassida/listeXassida.php';
    }

    public function admin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $model     = new Khassida();
        $khassidas = $model->getAllKhassidas();

        require_once __DIR__
            . '/../view/pages/admin/khassida/listeKhassida.php';
    }
}

// ── Dispatch ──────────────────────────────────────────────
$controller = new KhassidaController();

$action = $_GET['action'] ?? 'index';

match ($action) {
    'show'  => $controller->show(),
    'admin' => $controller->admin(),
    default => $controller->index(),
};