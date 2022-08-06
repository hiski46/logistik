<?php

namespace Modules\dashboard\Models;

use CodeIgniter\Model;

class ModelMaterial extends Model
{
    protected $table = 'material';

    protected $allowedFields = ['material', 'stok'];
}
