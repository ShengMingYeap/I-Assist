<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblMember;
use App\Models\tblPurchase;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function getRegisteredByDateJoin(Request $request)
    {
        $fromDateJoin = Carbon::create(2024, 1, 1); // 1 Jan 2024
        $toDateJoin = Carbon::create(2024, 3, 31); // 31 March 2024

        if ($request->get("date_range")) {
            [$fromDateJoin, $toDateJoin] = array_map(fn ($date) => Carbon::createFromFormat('Y-m-d', $date)->format('y-m-d'), explode(' - ', request()->get('date_range')));
        }

        $members = tblMember::whereBetween('DateJoin', [$fromDateJoin, $toDateJoin])->get();

        return view('index', compact('members'));
    }

    public function topTen(Request $request)
    {
        $fromDate = Carbon::create(2024, 3, 1); // 1 March 2024
        $endDate = Carbon::create(2024, 3, 31); // 31 March 2024

        $topPurchaseMembers = tblMember::withCount(['purchase' => function ($query) use ($fromDate, $endDate) {
            $query->whereBetween('SalesDate', [$fromDate, $endDate]);
        }])->withSum(['purchase' => function ($query) use ($fromDate, $endDate) {
            $query->whereBetween('SalesDate', [$fromDate, $endDate]);
        }], 'Amount')
        ->orderBy('purchase_count', 'desc')
        ->take(10)
        ->get();

        return view('question-two', compact('topPurchaseMembers'));
    }

    public function calRefer(Request $request)
    {
        $members = tblMember::withCount('referral')->get();
        
        return view('question-three', compact('members'));
    }

    public function countMemberPurchase(Request $request)
    {
        $members = tblMember::withCount('purchase')->get();
        $members = $members->transform(function ($member) {
            $referralMembers = tblMember::where('ParentID', $member->MemberID)->get();
            $referralPurchase = 0;
            if (count($referralMembers) > 0) {
                foreach ($referralMembers as $referralMember) {
                    $referralPurchase += tblPurchase::where('MemberID', $referralMember->MemberID)->count();
                }
            }
            $member->total_referral_purchase = $referralPurchase;
            $member->total_group_purchase = $member->purchase_count + $referralPurchase;
            return $member;
        });

        return view('question-four', compact('members'));
    }

    public function familyTreeChart(Request $request)
    {
        $members = tblMember::withCount('purchase')->get();
        $familyTree = [];

        if (count($members) > 0) {
            foreach ($members as $member) {
                if (is_null($member['ParentID']) || empty($member['ParentID'])) {
                    $personalSales = tblPurchase::where('MemberID', $member->MemberID)->sum('Amount');
                    $referralMembers = tblMember::getReferralMembers($member->MemberID);
                    $referral = [];
                    $groupSales = 0;
                    if (count($referralMembers) > 0) {
                        $groupSales = $personalSales + tblPurchase::whereIn('MemberID', $referralMembers)->sum('Amount');
                        // $referral = tblPurchase::whereIn('MemberID', $referralMembers)->get();
                        $referral = tblMember::withSum('purchase', 'Amount')->whereIn('MemberID', $referralMembers)->get();
                    }

                    $familyTree[] = [
                        'name' => $member->Name,
                        'date_join' => $member->DateJoin,
                        'personal_sales' => $personalSales ?? 0,
                        'group_sales' => $groupSales,
                        'referral' => $referral,
                    ];
                }
            }
        }

        return view('question-five', compact('familyTree'));
    }
}
