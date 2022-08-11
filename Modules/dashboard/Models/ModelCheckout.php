<?php

namespace Modules\dashboard\Models;

use CodeIgniter\Model;

class ModelCheckout extends Model
{
    protected $table = 'checkout';

    protected $allowedFields = ['material_id', 'jumlah', 'stok_awal', 'stok_akhir', 'tanggal'];
}
