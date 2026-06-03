<?php

require_once __DIR__ . '/../model/Xassida.php';

class KhassidaController
{
    public function index()
    {
        $model = new Khassida();

        $khassidas = $model->getAllKhassidas();

        require_once __DIR__
        . '/../view/pages/admin/khassida/listeKhassida.php';
    }
}