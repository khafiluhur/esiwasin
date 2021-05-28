<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KertasAuditKeuangan extends Model
{
    protected $fillable = ['audit_keuangan', 'kode_audit_keuangan', 'filename'];
    //
}
