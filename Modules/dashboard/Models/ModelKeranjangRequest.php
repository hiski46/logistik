<?php

namespace Modules\dashboard\Models;

use CodeIgniter\Model;

class ModelKeranjangRequest extends Model
{
    protected $table = 'keranjang_request';

    protected $allowedFields = ['request', 'material', 'jumlah'];
}
