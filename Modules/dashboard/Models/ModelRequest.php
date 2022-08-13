<?php

namespace Modules\dashboard\Models;

use CodeIgniter\Model;

class ModelRequest extends Model
{
    protected $table = 'request';

    protected $allowedFields = ['request_by', 'tanggal', 'approval', 'checkout'];
}
