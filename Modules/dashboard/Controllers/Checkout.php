<?php

namespace Modules\dashboard\Controllers;

use CodeIgniter\I18n\Time;
use Modules\dashboard\Controllers\Dashboard;

class Checkout extends Dashboard
{
    protected $list_material;
    public function __construct()
    {
        parent::__construct();
        $this->list_material = $this->getMaterial();
    }

    public function index()
    {
        if (!$this->ionAuth->loggedIn()) {
            return redirect()->to('/auth/login');
        }
        $data['group_name'] = $this->group_name;
        $data['user_id'] = $this->ionAuth->getUserId();
        $this->rander(view("$this->view\checkout", $data));
    }

    public function list_checkout()
    {
        $list_array = [];
        $checkout = $this->Modelcheckout->orderBy('id', 'DESC')->findAll();
        if ($checkout) {
            foreach ($checkout as $m) {
                $list_array[] = [
                    $this->list_material[$m['material_id']]['material'],
                    date('l, d-m-Y H:i', $m['tanggal']),
                    $m['jumlah'],
                    $m['stok_awal'],
                    $m['stok_akhir'],
                ];
            }
        }

        $data['data'] = $list_array;
        echo json_encode($data);
    }

    public function formTambahCheckout()
    {
        $data['material'] = $this->list_material;
        return $this->modal(
            'Tambah Checkout',
            view($this->view . '\form\form_tambah_checkout', $data),
            'save()',
            'primary',
            'simpan',
            'modal-lg'
        );
    }

    public function save()
    {
        $material_id = $this->request->getPost('material');
        $stok_awal = $this->list_material[$material_id]['stok'];
        $jumlah = $this->request->getPost('jumlah');
        $stok_akhir = $stok_awal - $jumlah;
        $tanggal = time();

        if ($stok_akhir < 0) {
            return redirect()->to('checkout');
        }

        $data = [
            'material_id' => $material_id,
            'jumlah' => $jumlah,
            'stok_awal' => $stok_awal,
            'stok_akhir' => $stok_akhir,
            'tanggal' => $tanggal,
        ];

        $this->Modelcheckout->save($data);

        $stok['stok'] = $stok_akhir;
        $this->Modelmaterial->update($material_id, $stok);
        return redirect()->to('checkout');
    }

    public function getMaterial()
    {
        $array = [];
        $material = $this->Modelmaterial->findAll();
        foreach ($material as $m) {
            $array[$m['id']] = $m;
        }
        return $array;
    }
}
