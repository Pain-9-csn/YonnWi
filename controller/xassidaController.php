<?php

require_once __DIR__ . '/../model/XassidaDB.php';

class KhassidaController
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $model = new Khassida();

        $khassidas = $model->getAllKhassidas();

        require_once __DIR__
            . '/../view/pages/vitrine/xassida/listeXassida.php';
    }

    public function admin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $model = new Khassida();

        $khassidas = $model->getAllKhassidas();

        require_once __DIR__
            . '/../view/pages/admin/khassida/listeKhassida.php';
    }
}