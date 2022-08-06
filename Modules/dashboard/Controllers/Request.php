<?php

namespace Modules\dashboard\Controllers;

use CodeIgniter\I18n\Time;
use Modules\dashboard\Controllers\Dashboard;

class Request extends Dashboard
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!$this->ionAuth->loggedIn()) {
            return redirect()->to('/auth/login');
        }
        $data['group_name'] = $this->group_name;
        $data['user_id'] = $this->ionAuth->getUserId();
        $this->rander(view("$this->view\\request", $data));
    }
    public function list_request()
    {
        $list_array = [];
        if ($this->group_name == 'members') {
            $request = $this->Modelrequest->where('request_by', $this->ionAuth->getUserId())->where('approval', null)->findAll();
        } else if ($this->group_name == 'supervisor' || $this->group_name == 'admin') {
            $request = $this->Modelrequest->where('approval', null)->findAll();
        }
        if ($request) {
            foreach ($request as $r) {
                if ($this->group_name == 'members') {
                    $aksi = form_button(['type' => 'button', 'class' => 'btn btn-sm btn-success', 'onclick' => 'keranjang(' . $r['id'] . ')'], '<small><i class="fa-solid fa-cart-shopping"></i></small>') . form_button(['type' => 'button', 'class' => 'btn btn-sm btn-danger', 'onclick' => 'hapusRequest(' . $r['id'] . ')'], '<small> <i class="fa-solid fa-trash"></i></small>');
                } else if ($this->group_name == 'supervisor') {
                    $aksi = form_button(['type' => 'button', 'class' => 'btn btn-sm btn-success', 'onclick' => 'keranjang(' . $r['id'] . ')'], '<small><i class="fa-solid fa-cart-shopping"></i></small>') . form_button(['type' => 'button', 'class' => 'btn btn-sm btn-primary', 'onclick' => 'approveRequest(' . $r['id'] . ')'], '<small> <i class="fa-solid fa-check"></i> Approve</small>') . form_button(['type' => 'button', 'class' => 'btn btn-sm btn-danger', 'onclick' => 'rejectRequest(' . $r['id'] . ')'], '<small> <i class="fa-solid fa-xmark"></i> Reject</small>');
                } else if ($this->group_name == 'admin') {
                    $aksi = form_button(['type' => 'button', 'class' => 'btn btn-sm btn-success', 'onclick' => 'keranjang(' . $r['id'] . ')'], '<small><i class="fa-solid fa-cart-shopping"></i></small>');
                }
                $list_array[] = [
                    $this->getName($r['request_by']),
                    date('l, d F Y', $r['tanggal']),
                    $aksi
                ];
            }
        }

        $data['data'] = $list_array;
        echo json_encode($data);
    }

    public function tambah()
    {
        if (!$this->ionAuth->loggedIn()) {
            return redirect()->to('/auth/login');
        }

        $user = $this->Modeluser->select('first_name, last_name, company')->find($this->ionAuth->getUserId());
        $data['request_by'] = $user['first_name'] . ' ' . $user['last_name'];
        $data['region'] = $user['company'];
        $data['tanggal'] = time();
        $material = $this->Modelmaterial->findAll();
        $arrayMaterial = [];
        foreach ($material as $m) {
            $arrayMaterial[$m['id']] = $m['material'];
        }
        $data['material'] = json_encode($arrayMaterial);
        // dd($data);
        $this->rander(view("$this->view\\tambah_request", $data));
    }

    public function formTambahMaterial()
    {
        $material = $this->Modelmaterial->findAll();
        $arrayMaterial = [];
        foreach ($material as $m) {
            $arrayMaterial[$m['id']] = $m['material'];
        }
        // dd($arrayMaterial);
        $html = '';
        $html .= form_dropdown(['class' => 'form-select', 'aria-label' => 'Default select example', 'id' => 'material'], $arrayMaterial);
        $html .= form_label('Jumlah', '', ['class' => 'form-label mt-3']);
        $html .= form_input(
            [
                'class' => 'form-control w-25',
                'min' => 1,
                'id' => 'jumlah'
            ],
            '',
            '',
            'number'
        );
        // $html = 

        return $this->modal(
            'Tambah Maerial',
            $html,
            'tambahBaris()',
            'primary',
            'tambah',
            'modal-lg'
        );
    }

    public function save()
    {
        $request_by = $this->request->getPost('nama');
        $tanggal = $this->request->getPost('tanggal');
        $keranjang = $this->request->getPost('keranjang');

        $data = [
            'request_by' => $this->ionAuth->getUserId(),
            'tanggal' => (int)$tanggal
        ];
        $data_keranjang = json_decode($keranjang);
        $save_id = $this->Modelrequest->insert($data);
        if ($save_id) {
            foreach ($data_keranjang as $dk) {
                $keranjang = [];
                $keranjang = [
                    'request' => $save_id,
                    'material' => $dk[0],
                    'jumlah' => $dk[1]
                ];
                $this->Modelkeranjangrequest->insert($keranjang);
            }
            echo json_encode(['success:true']);
        }
        echo json_encode(['success:false']);
    }

    public function keranjang($id_request)
    {
        $data['keranjang'] = $this->Modelkeranjangrequest->where('request', $id_request)->findAll();
        $material = $this->Modelmaterial->select('id, material')->findAll();
        $a = [];
        foreach ($material as $m) {
            $a[$m['id']] = $m['material'];
        }
        $data['material'] = $a;
        $html = view("$this->view\\table\\table_keranjang", $data);
        return $this->modal(
            'Keranjang Request',
            $html,
            'void(0)',
            'primary',
            'Oke',
            'modal-lg'
        );
    }

    public function hapusRequest($id)
    {
        return $this->modal(
            'Hapus Request',
            'Apakah anda yakin ingin menghapus request?',
            'hapus(' . $id . ')',
            'danger',
            'Hapus',
        );
    }

    public function delete($id)
    {
        $this->Modelrequest->delete($id);
        $this->Modelkeranjangrequest->where('request', $id)->delete();

        echo true;
    }

    public function approval($id, $type)
    {
        $data['approval'] = $type;
        $this->Modelrequest->update($id, $data);
    }

    public function modalApproval($id, $type)
    {
        if ($type == 'yes') {
            return $this->modal(
                'Approve Request',
                'Apakah anda yakin ingin approve request?',
                'approval(' . $id . ',`' . $type . '`)',
                'primary',
                'Approve',
            );
        } else {
            return $this->modal(
                'Reject Request',
                'Apakah anda yakin ingin reject request?',
                'approval(' . $id . ',`' . $type . '`)',
                'danger',
                'Reject',
            );
        }
    }

    public function completeRequest()
    {
        if (!$this->ionAuth->loggedIn()) {
            return redirect()->to('/auth/login');
        }
        $data['group_name'] = $this->group_name;
        $data['user_id'] = $this->ionAuth->getUserId();
        $this->rander(view("$this->view\complete_request", $data));
    }
    public function list_complete_request()
    {
        $list_array = [];
        if ($this->group_name == 'members') {
            $request = $this->Modelrequest->where('request_by', $this->ionAuth->getUserId())->where('approval !=', null)->findAll();
        } else if ($this->group_name == 'supervisor' || $this->group_name == 'admin') {
            $request = $this->Modelrequest->where('approval', 'yes')->orWhere('approval', 'no')->findAll();
        }
        if ($request) {
            foreach ($request as $r) {

                $list_array[] = [
                    $this->getName($r['request_by']),
                    date('l, d F Y', $r['tanggal']),
                    form_button(['type' => 'button', 'class' => 'btn btn-sm btn-success', 'onclick' => 'keranjang(' . $r['id'] . ')'], '<small><i class="fa-solid fa-cart-shopping"></i></small>'),
                    ($r['approval'] == 'yes') ? '<span class="badge bg-primary">Approved</span>' : '<span class="badge bg-danger">Rejected</span>',
                ];
            }
        }

        $data['data'] = $list_array;
        echo json_encode($data);
    }
}
