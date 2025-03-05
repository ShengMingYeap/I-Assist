<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblMember extends Model
{
    use HasFactory;

    protected $table = 'tbl_members';
    
    protected $fillable = [
                'MemberID', 
                'Name', 
                'DateJoin', 
                'TelM',
                'Email',
                'BirthDate',
                'ParentID'
            ];

    public function purchase()
    {
        return $this->hasMany(tblPurchase::class, 'MemberID', 'MemberID');
    }

    public function referral()
    {
        return $this->hasMany(tblMember::class, 'ParentID', 'MemberID');
    }

    public static function getReferralRecursively($children, &$referralIds)
    {
        foreach ($children as $child) {
            $referralIds[] = $child['MemberID'];
            if (!empty($child['ParentID'])) {
                $members = tblMember::where('ParentID', $child['MemberID'])->get();
                self::getReferralRecursively($members, $referralIds);
            }
        }
    }

    public static function getReferralMembers($memberID)
    {
        $referralMembers = [];
        $members = tblMember::where('ParentID', $memberID)->get();
        self::getReferralRecursively($members, $referralMembers);
        return array_unique($referralMembers);
    }
}
