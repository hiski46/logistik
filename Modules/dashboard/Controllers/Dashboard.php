<?php

namespace Modules\dashboard\Controllers;

use App\Controllers\BaseController;
use IonAuth\Controllers\Auth;

class Dashboard extends BaseController
{
    protected $ionAuth;
    protected $ionAuthModel;
    protected $view;
    protected $auth;

    protected $group_name;

    protected $Modelmaterial;
    protected $Modelrequest;
    protected $Modeluser;
    protected $Modelkeranjangrequest;
    protected $Modelcheckout;

    function __construct()
    {
        $this->view = 'Modules\dashboard\Views';
        $this->ionAuth = new \IonAuth\Libraries\IonAuth();
        $this->ionAuthModel = new \IonAuth\Models\IonAuthModel();
        $this->auth = new Auth;
        $this->Modelmaterial = new \Modules\dashboard\Models\ModelMaterial();
        $this->Modelrequest = new \Modules\dashboard\Models\ModelRequest();
        $this->Modeluser = new \Modules\dashboard\Models\ModelUser();
        $this->Modelkeranjangrequest = new \Modules\dashboard\Models\ModelKeranjangRequest();
        $this->Modelcheckout = new \Modules\dashboard\Models\ModelCheckout();
        if ($this->ionAuth->loggedIn()) {
            $this->group_name = $this->ionAuthModel->getUsersGroups()->getResultArray()[0]['name'];
        }
    }

    public function rander($html)
    {
        $data['html'] = $html;
        $data['is_admin'] = $this->ionAuth->isAdmin();
        if ($this->ionAuth->loggedIn()) {
            $user = $this->Modeluser->find($this->ionAuth->getUserId());
            $data['user'] = $user['first_name'] . ' ' . $user['last_name'];
        }
        echo view($this->view . '\index', $data);
    }

    public function index()
    {
        if (!$this->ionAuth->loggedIn()) {
            return redirect()->to('/auth/login');
        }
        $this->profile();
    }

    public function managementUser()
    {
        if ($this->ionAuth->isAdmin()) {
            $this->rander($this->auth->index());
        } else {
            $this->rander(view("$this->view\dashboard"));
        }
    }

    public function modal($title, $isi, $aksi, $warna, $tombol, $size = NULL)
    {
        $html = '<div class="modal-dialog ' . $size . ' modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">' . $title . '</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">' .
            $isi
            . '</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button onclick="' . $aksi . '" type="button" data-bs-dismiss="modal" class="btn btn-' . $warna . '">' . $tombol . '</button>
            </div>
        </div>
    </div>';
        return $html;
    }

    public function checkGroup($id_group, $id_user)
    {
        echo $this->ionAuthModel->inGroup($id_group, $id_user);
    }

    public function getName($id)
    {
        if ($this->ionAuth->loggedIn()) {
            $user = $this->Modeluser->select('first_name, last_name')->find($id);
            $name = $user['first_name'] . ' ' . $user['last_name'];
            return $name;
        }
    }

    public function profile()
    {
        $data['user'] = $this->Modeluser->find($this->ionAuth->getUserId());
        return $this->rander(view("$this->view\profile", $data));
    }
}
