<?php

namespace Modules\dashboard\Controllers;

use Modules\dashboard\Controllers\Dashboard;

class Material extends Dashboard
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
        $this->rander(view("$this->view\material", $data));
    }

    public function list_material()
    {
        $list_array = [];
        $material = $this->Modelmaterial->findAll();
        if ($material) {
            foreach ($material as $m) {
                $list_array[] = [
                    $m['material'],
                    $m['stok'],
                    ($this->ionAuth->isAdmin()) ? form_button(['type' => 'button', 'class' => 'btn btn-sm btn-success', 'onclick' => 'edit(' . $m['id'] . ')'], '<small><i class="fa-solid fa-pen-to-square"></i></small>') . form_button(['type' => 'button', 'class' => 'btn btn-sm btn-danger', 'onclick' => 'modalHapus(' . $m['id'] . ')'], '<small> <i class="fa-solid fa-trash"></i></small>') : null
                ];
            }
        }

        $data['data'] = $list_array;
        echo json_encode($data);
    }

    public function formTambahMaterial($type = NULL)
    {
        $data = [];
        if ($type == 'edit') {
            $id = $this->request->getPost('id');
            $data['material'] = $this->Modelmaterial->find($id);
            return $this->modal(
                'Edit Matrial',
                view($this->view . '\form\form_tambah_material', $data),
                'save()',
                'primary',
                'simpan'
            );
        } else {
            $data['material'] = NULL;
        }
        return $this->modal(
            'Tambah Matrial',
            view($this->view . '\form\form_tambah_material', $data),
            'save()',
            'primary',
            'simpan'
        );
    }

    public function modalHapus($id)
    {
        return $this->modal(
            'Hapus Material',
            'Apakah yakin ingin menghapus material ?',
            'hapus(' . $id . ')',
            'danger',
            'hapus'
        );
    }

    public function save()
    {
        $material = $this->request->getPost('material');
        $stok = $this->request->getPost('stok');
        $id = $this->request->getPost('id');

        $data = [
            'material' => $material,
            'stok' => $stok,
        ];
        if ($id) {
            if ($this->Modelmaterial->update($id, $data)) {
                return redirect()->to('material');
            };
        } else {
            if ($this->Modelmaterial->save($data)) {
                return redirect()->to('material');
            }
        }
    }

    public function delete($id)
    {
        if ($this->Modelmaterial->delete($id)) {
            return "sucess";
        }
    }
}
