<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryModel extends Model
{
    protected $table      = 'history';
    protected $useTimestamps = true;
    protected $allowedFields = ['awal','tujuan','radius','jarak'];
}