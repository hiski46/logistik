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

    public function formTambahCheckout($id_request)
    {
        $data['material'] = $this->list_material;
        $req = $this->Modelrequest->find($id_request);
        $keranjang = $this->Modelkeranjangrequest->where('request', $id_request)->findAll();

        foreach ($keranjang as $k) {
            $material = $this->list_material[$k['material']];
            if ($material['stok'] < $k['jumlah']) {
                $title = "Checkout Gagal";
                $pesan = "Stok " . $material['material'] . " tidak cukup. Jumlah request <b>" . $k['jumlah'] . "</b>, Jumlah Stok <b>" . $material['stok'] . "</b>";
                $action = 'void(0)';
                $color = "danger";
                break;
            } else {
                $title = "Checkout";
                $pesan = "Apakah anda yakin ingin melakuakan Checkout?";
                $action = "checkout($id_request)";
                $color = "primary";
            }
        }
        return $this->modal(
            $title,
            $pesan,
            $action,
            $color,
            'OK',
            'modal-lg'
        );
    }

    public function save($id_request)
    {
        // $material_id = $this->request->getPost('material');
        // $stok_awal = $this->list_material[$material_id]['stok'];
        // $jumlah = $this->request->getPost('jumlah');
        // $stok_akhir = $stok_awal - $jumlah;
        $req = $this->Modelrequest->find($id_request);
        $keranjang = $this->Modelkeranjangrequest->where('request', $id_request)->findAll();
        $tanggal = time();
        foreach ($keranjang as $k) {
            $material = $this->list_material[$k['material']];
            $material_id = $k['material'];
            $stok_awal = $material['stok'];
            $jumlah = $k['jumlah'];
            $stok_akhir = $stok_awal - $jumlah;
            if ($stok_akhir < 0) {
                return $this->modal(
                    'Checkout Gagal',
                    "Stok " . $material['material'] . " tidak cukup. Jumlah request <b>" . $k['jumlah'] . "</b>, Jumlah Stok <b>" . $material['stok'] . "</b>",
                    'void(0)',
                    'danger',
                    'Oke',
                    'modal-md'
                );
                break;
            }
            $data = [
                'material_id' => $material_id,
                'nama_material' => $material['material'],
                'jumlah' => $jumlah,
                'stok_awal' => $stok_awal,
                'stok_akhir' => $stok_akhir,
                'tanggal' => $tanggal,
            ];
            $this->Modelcheckout->save($data);

            $stok['stok'] = $stok_akhir;
            $this->Modelmaterial->update($material_id, $stok);

            $status_checkout_request['checkout'] = "yes";
            $this->Modelrequest->update($id_request, $status_checkout_request);
        }

        return $this->modal(
            'Checkout berhasil',
            "Checkout berhasil",
            'refresh()',
            'primary',
            'Oke',
            'modal-md'
        );
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
