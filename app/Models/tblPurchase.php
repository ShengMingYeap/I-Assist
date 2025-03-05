<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblPurchase extends Model
{
    use HasFactory;

    protected $table = 'tbl_purchases';

    protected $fillable = [
                'BillNo',
                'MemberID',
                'SalesDate',
                'Amount'
            ];

    public function member()
    {
        return $this->belongsTo(tblMember::class, 'MemberID', 'MemberID');
    }
}
