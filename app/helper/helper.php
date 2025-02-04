<?php

use Illuminate\Support\Str;

function front_url($route)
{
    return url('/public/front/' . $route);
}

function admin_url($route)
{
    return url('/public/'.$route);
}

function panel_url($route)
{
    return url('/public/panel/' . $route);
}

function setting($name){
    return \App\Models\Setting::where('name' , $name)->first()->value ?? '';
}


//
if(!function_exists('sumAmountByCurrencyMove')){
    function sumAmountByCurrencyMove($collection, $year, $state, $currency)
    {
        if ($year == 'revenue_partner') {
            return $collection->where('price_type', $currency)->sum('revenue_partner');
        }
        if ($year == null) {
            $sum = $collection->where('price_type', $currency)->where('paybyus', '1');
            if ($state == 0 || $state == 1) {
                $sum = $sum->where('sender_paid', $state);
            }
            $sum = $sum->sum('price');
            return $sum;
        }

        return $collection->where('price_type', $currency)->where('new_date', $year)->where('sender_paid', $state)->sum('price');
    }
}
if(!function_exists('sumAmountByCurrencyMoveCount')){
    function sumAmountByCurrencyMoveCount($collection, $year, $state)
    {
        if ($year == 'revenue_partner') {
            return $collection->Count();
        }
        if ($year == 'profit') {
            return $collection->whereNotNull('revenue_partner')->Count();
        }
        if ($year == null) {
            return $collection->where('paybyus', '1')->where('sender_paid', $state)->Count();
        }

        return $collection->where('new_date', $year)->where('sender_paid', $state)->Count();
    }
}
if(!function_exists('sumAmountByCurrencyInc')){
    function sumAmountByCurrencyInc($collection, $year, $currency, $type)
    {
        if ($type == 'Income') {
            $collection = $collection->where('type', 'Income');
        } else {
            $collection = $collection->where('type', 'Expenses');
        }

        if ($year == null) {
            return $collection->where('price_type', $currency)->whereNull('movement_id')->sum('price');
        }
        return $collection->where('price_type', $currency)->where('new_date', $year)->whereNull('movement_id')->sum('price');
    }
}
if(!function_exists('sumProfitPartners')){
    function sumProfitPartners($collection, $type, $currency)
    {
        $sum = 0;
        $collection = $collection->where('status', 0);
        if ($type == '5') {
            $sum = $collection->where('price_type', $currency)->sum('revenue_partner');
        }
        return $sum;
    }
}
if(!function_exists('sumProfitPartners')){
    function sumProfitPartners($collection, $type, $currency)
    {
        $sum = 0;
        $collection = $collection->where('status', 0);
        if ($type == '5') {
            $sum = $collection->where('price_type', $currency)->sum('revenue_partner');
        }
        return $sum;
    }
}
if(!function_exists('sumPartnersUnPaid')){
    function sumPartnersUnPaid($collection, $type, $currency)
    {
        $sum = 0;
        $collection = $collection->where('status', 0);

        if ($type == '5') {
            $sum = $collection->where('price_type', $currency)->where('paybyus', '1')->sum('price');
        }
        return $sum;
    }
}
if(!function_exists('sumPartners')){
    function sumPartners($collection, $type, $currency)
    {
        $sum = 0;
        $collection = $collection->where('status', 0);
        if ($type == '5') {
            $sum0 = $collection->where('price_type', $currency)->where('paybyus', '1')->sum('price');
            $sum1 = $collection->where('price_type', $currency)->where('paybyus', '0')->sum('revenue_partner');
            $sum = $sum1 - $sum0;
        } else {
            $collection = $collection->wherein('user_id', [1, 2, 3, 4, 5]);
            $sum = $collection->where('price_type', $currency)->where('paybyus', '0')->sum('revenue') + $collection->where('price_type', $currency)->where('paybyus', '0')->sum('revenue_partner') + $collection->where('price_type', $currency)->where('paybyus', '0')->sum('admin_partner');
            //dd($sum);
            $sum_com = $collection->where('admin_commission_type', $currency)->Where('admin_commission', '!=', '0')->sum('admin_commission') + $collection->where('commission_type', $currency)->Where('commission', '!=', '0')->sum('commission');

            $sum = $sum + $sum_com;
            $sum = $sum - $collection->where('price_type', $currency)->where('paybyus', '1')->sum('net');
        }
        return $sum;
    }
}
if(!function_exists('sumAmountByCurrency')){
    function sumAmountByCurrency($collection, $type, $currency)
    {
        $rev = 'revenue';
        $collection = $collection->where('price_type', $currency);
        if ($type == '5') {
            $rev = 'revenue_partner';
        } else {
            $collection = $collection->where('status', 1);
        }
        return $collection->sum($rev);
    }
}
if(!function_exists('sumAmountByCurrencyAllsPrice')){
    function sumAmountByCurrencyAllsPrice($collection, $type, $currency)
    {
        $net02 = $collection->where('price_type', $currency)->where('paybyus', '0')->where('leader_paid', '0')->where('status', '0')->sum('price');

        return $net02;
    }
}
if(!function_exists('sumAmountByCurrencyAllsNets2')){
    function sumAmountByCurrencyAllsNets2($collection, $type, $currency)
    {
        $net = $collection->where('price_type', $currency)->where('paybyus', '1')->where('leader_paid', '0')->where('status', '0')->where('net_tl', 0)->sum('net');
        if ($currency == 'TL') {
            $net1 = $collection->where('price_type', $currency)->where('paybyus', '1')->where('leader_paid', '0')->where('status', '0')->where('net_tl', 0)->sum('net');
            $net3 = $collection->where('price_type', '!=', $currency)->where('paybyus', '1')->where('leader_paid', '0')->where('status', '0')->sum('net_tl');
            $net = $net1 + $net3;
        }

        $net021 = $collection->where('price_type', $currency)->where('paybyus', '0')->where('leader_paid', '0')->where('status', '0')->where('net_tl', 0)->sum('revenue_partner');
        $net02 = $collection->where('price_type', $currency)->where('paybyus', '0')->where('leader_paid', '0')->where('status', '0')->where('net_tl', 0)->sum('admin_partner');
        $net012 = $collection->where('price_type', $currency)->where('paybyus', '0')->where('leader_paid', '0')->where('status', '0')->where('net_tl', 0)->sum('revenue');
        $net2 = $net02 + $net012 + $net021;
        if ($currency == 'TL') {
            // dd($collection->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0"));
            $net6 = 0; //$collection->where('price_type', $currency)->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0")->where("net_tl",0)->sum("admin_partner");
            $net4 = $collection->where('price_type', $currency)->where('paybyus', '0')->where('leader_paid', '0')->where('status', '0')->where('net_tl', 0)->sum('net');
            $net5 = $collection->where('paybyus', '0')->where('leader_paid', '0')->where('status', '0')->sum('net_tl');
            $net2 = $net4 + $net5 + $net6;
        }
        if ($type == 'net2') {
            return $net2;
        }
        if ($type == 'net') {
            return $net;
        }

        if ($type == null) {
            $net = $collection->where('price_type', $currency)->where('paybyus', '1')->where('leader_paid', '0')->where('status', '0')->where('net_tl', 0)->sum('net');
            if ($currency == 'TL') {
                $net1 = $collection->where('price_type', $currency)->where('paybyus', '1')->where('leader_paid', '0')->where('status', '0')->where('net_tl', 0)->sum('net');
                $net3 = $collection->where('price_type', '!=', $currency)->where('paybyus', '1')->where('leader_paid', '0')->where('status', '0')->sum('net_tl');
                $net = $net1 + $net3;
            }

            $net02 = $collection->where('price_type', $currency)->where('paybyus', '0')->where('leader_paid', '0')->where('status', '0')->where('net_tl', 0)->sum('admin_partner');
            $net2 = $net02 + $collection->where('price_type', $currency)->where('paybyus', '0')->where('leader_paid', '0')->where('status', '0')->where('net_tl', 0)->sum('revenue');
            if ($currency == 'TL') {
                $net02 = 0; //$collection->where('price_type', $currency)->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0")->where("net_tl",0)->sum("admin_partner");
                $net4 = $net02 + $collection->where('price_type', $currency)->where('paybyus', '0')->where('leader_paid', '0')->where('status', '0')->where('net_tl', 0)->sum('net');
                $net5 = $collection->where('paybyus', '0')->where('leader_paid', '0')->where('status', '0')->sum('net_tl');
                $net2 = $net4 + $net5;
            }

            return $net2 + $net;
        }
    }
}
if(!function_exists('sumAmountByCurrencyAllsNetsTicket')){
    function sumAmountByCurrencyAllsNetsTicket($collection, $type, $currency)
    {
        $collection = $collection->where('type', 'T & T')->where('price_type', $currency);
        return 0;
    }
}
if(!function_exists('CountofTypeNetsTicket')){
    function CountofTypeNetsTicket($collection, $type, $currency)
    {
        $collection = $collection->where('type', 'T & T')->where('paybyus', 0);
        if ($type == 'dircit') {
            $collection = $collection->where('t_paid', 0);
        }
        if ($type == 'us') {
            $collection = $collection->where('t_paid', 1);
        }
        return $collection->count();
    }
}
if(!function_exists('sumAmountByCurrencyTicket')){
    function sumAmountByCurrencyTicket($collection, $type, $currency)
    {
        //dd($collection,$type, $currency);
        $sum = 0;
        $net = 0;
        $price = 0;
        $collection = $collection->where('type', 'T & T')->where('price_type', $currency)->where('paybyus', 0);
        if ($type == 'dircit') {
            $sum = $collection->where('t_paid', 0)->sum('t_net');
        }
        if ($type == 'us') {
            $sum = $collection->where('t_paid', 1)->sum('t_net');
        }
        if ($type == null) {
            $sum = $collection->where('t_paid', 1)->sum('t_net');
        }
        //$sum = $price - $net;
        return $sum;
    }
}
if(!function_exists('sumAmountByCurrencyAllsNets')){
    function sumAmountByCurrencyAllsNets($collection, $type, $currency)
    {
        $ticks = 0;
        $org_collection = $collection;
        //dd($collection);
        $net = $collection->where('price_type', $currency)->where('paybyus', '1')->where('leader_paid', '0')->where('status', '0')->where('net_tl', 0)->sum('net');
        if ($currency == 'TL') {
            $net1 = $collection->where('price_type', $currency)->where('paybyus', '1')->where('leader_paid', '0')->where('status', '0')->where('net_tl', 0)->sum('net');
            $net3 = $collection->where('price_type', '!=', $currency)->where('paybyus', '1')->where('leader_paid', '0')->where('status', '0')->sum('net_tl');
            $net = $net1 + $net3;
        }

        $net021 = $collection->where('price_type', $currency)->where('paybyus', '0')->where('leader_paid', '0')->where('status', '0')->where('net_tl', 0)->sum('revenue_partner');
        $net02 = $collection->where('price_type', $currency)->where('paybyus', '0')->where('leader_paid', '0')->where('status', '0')->where('net_tl', 0)->sum('admin_partner');
        $net012 = $collection->where('price_type', $currency)->where('paybyus', '0')->where('leader_paid', '0')->where('status', '0')->where('net_tl', 0)->sum('revenue');
        $net2 = $net02 + $net012 + $net021;
        //dd($net2);
        if ($currency == 'TL') {
            // dd($collection->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0"));
            //$net6 = 0;//$collection->where('price_type', $currency)->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0")->where("net_tl",0)->sum("admin_partner");
            //$net4 = $collection->where('price_type', $currency)->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0")->where("net_tl",0)->sum("net");
            //$net5 = $collection->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0")->sum("net_tl");
            //$net2 = $net4+$net5+$net6;
        }
        if ($type == 'net2') {
            return $net2;
        }
        if ($type == 'net') {
            return $net;
        }

        if ($type == null) {
            $net = $collection->where('price_type', $currency)->where('paybyus', '1')->where('leader_paid', '0')->where('status', '0')->where('net_tl', 0)->sum('net');
            if ($currency == 'TL') {
                $net1 = $collection->where('price_type', $currency)->where('paybyus', '1')->where('leader_paid', '0')->where('status', '0')->where('net_tl', 0)->sum('net');
                $net3 = $collection->where('price_type', '!=', $currency)->where('paybyus', '1')->where('leader_paid', '0')->where('status', '0')->sum('net_tl');
                $net = $net1 + $net3;
            }

            $net021 = $collection->where('admin_commission_type', $currency)->where('paybyus', '0')->where('leader_paid', '0')->where('status', '0')->where('admin_commission', '!=', '0')->sum('admin_commission');
            $net021 += $collection->where('commission_type', $currency)->where('paybyus', '0')->where('leader_paid', '0')->where('status', '0')->where('commission', '!=', '0')->sum('commission');
            $net021 += $collection->where('price_type', $currency)->where('paybyus', '0')->where('leader_paid', '0')->where('status', '0')->where('net_tl', 0)->sum('revenue_partner');
            $net02 = $net021 + $collection->where('price_type', $currency)->where('paybyus', '0')->where('leader_paid', '0')->where('status', '0')->where('net_tl', 0)->sum('admin_partner');
            $net2 = $net02 + $collection->where('price_type', $currency)->where('paybyus', '0')->where('leader_paid', '0')->where('status', '0')->where('net_tl', 0)->sum('revenue');
            if ($currency == 'TL') {
                // $net021 = $collection->where('admin_commission_type', $currency)->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0")->where("admin_commission","!=","0")->sum("admin_commission");
                // $net021 += $collection->where('commission_type', $currency)->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0")->where("commission","!=","0")->sum("commission");

                // $net02 = $net021+0;//$collection->where('price_type', $currency)->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0")->where("net_tl",0)->sum("admin_partner");
                // $net4 = $net02+$collection->where('price_type', $currency)->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0")->where("net_tl",0)->sum("net");
                // $net5 = $collection->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0")->sum("net_tl");
                // $net2 = $net4+$net5;
            }
            $ticks = sumAmountByCurrencyTicket($org_collection, 'us', $currency);
            return $net2 + $ticks - $net;
        }
    }
}
if(!function_exists('sumAmountByCurrencyAlls')){
    function sumAmountByCurrencyAlls($collection, $type, $currency)
    {
        $net = $collection->where('price_type', $currency)->where('paybyus', '1')->where('status', '1')->where('net_tl', 0)->sum('net');
        if ($currency == 'TL') {
            $net1 = $collection->where('price_type', $currency)->where('paybyus', '1')->where('status', '1')->where('net_tl', 0)->sum('net');
            $net3 = $collection->where('price_type', '!=', $currency)->where('paybyus', '1')->where('status', '1')->sum('net_tl');
            $net = $net1 + $net3;
        }

        $net2 = $collection->where('price_type', $currency)->where('paybyus', '0')->where('status', '1')->where('net_tl', 0)->sum('net');

        if ($currency == 'TL') {
            $net4 = $collection->where('price_type', $currency)->where('paybyus', '0')->where('status', '1')->where('net_tl', 0)->sum('net');
            $net5 = $collection->where('paybyus', '0')->where('status', '1')->sum('net_tl');
            $net2 = $net4 + $net5;
        }

        $unpaid = $collection->where('price_type', $currency)->where('paybyus', '1')->where('status', '0')->where('net_tl', 0)->sum('net');
        if ($currency == 'TL') {
            $net6 = $collection->where('price_type', $currency)->where('paybyus', '1')->where('status', '0')->where('net_tl', 0)->sum('net');
            $net7 = $collection->where('paybyus', '1')->where('status', '0')->sum('net_tl');
            $unpaid = $net7 + $net6;
        }

        $profit = $collection->where('price_type', $currency)->where('paybyus', '0')->where('status', '1')->sum('revenue');
        $profit2 = $collection->where('price_type', $currency)->where('paybyus', '1')->where('status', '1')->sum('revenue');
        if ($type == 'profit') {
            return $profit;
        }
        if ($type == 'paid') {
            return $profit2;
        }
        if ($type == 'unpaid') {
            return $unpaid;
        }
        if ($type == 'net') {
            return $net;
        }
        if ($type == 'net2') {
            return $net2;
        }
        if ($type == null) {
            $net = $collection->where('price_type', $currency)->where('net_tl', 0)->sum('net');
            if ($currency == 'TL') {
                $net1 = $collection->where('price_type', $currency)->where('net_tl', 0)->sum('net');
                $net3 = $collection->where('price_type', '!=', $currency)->sum('net_tl');
                $net = $net1 + $net3;
            }
            return $net;
        }
        return $net + $net2;
    }
}
if(!function_exists('sumAmountByCurrencyAllAdmin')){
    function sumAmountByCurrencyAllAdmin($collection, $type, $currency)
    {
        $s = $collection->where('price_type', $currency)->WhereNotNull('admin_partner')->sum('admin_partner');
        $s2 = $collection->where('admin_commission_type', $currency)->Where('admin_commission', '!=', '0')->sum('admin_commission');
        return $s + $s2;
    }
}
if(!function_exists('sumAmountByCurrencyAll')){
    function sumAmountByCurrencyAll($collection, $type, $currency)
    {
        try {
            return $collection->where('price_type', $currency)->where('status', 1)->sum('revenue') + $collection->where('commission_type', $currency)->where('status', 1)->sum('commission');
        } catch (\Exception $e) {
            return '0';
        }
    }
}
if(!function_exists('sumProfitPartnerAll')){
    function sumProfitPartnerAll($collection, $type, $currency)
    {
        return $collection->where('status', 1)->sum('revenue_partner');
    }
}
if(!function_exists('sumAmountByCurrencyC')){
    function sumAmountByCurrencyC($collection, $type, $currency)
    {
        return $collection->where('commission_type', $currency)->where('status', 0)->sum('commission');
    }
}
if(!function_exists('sumAmountByCurrencyCOfType')){
    function sumAmountByCurrencyCOfType($collection, $type, $currency)
    {
        $sum = $collection->where('type', $type)->where('status', 1)->where('commission_type', $currency)->sum('commission');
        return $sum == 0 ? null : $sum;
    }
}
if(!function_exists('sumAmountByCurrencyPOfType')){
    function sumAmountByCurrencyPOfType($collection, $type, $currency)
    {
        $sum = $collection->where('type', $type)->where('status', 1)->where('price_type', $currency)->sum('revenue');
        return $sum == 0 ? null : $sum;
    }
}
if(!function_exists('AdminsumAmountByCurrencyAll')){
    function AdminsumAmountByCurrencyAll($collection, $type, $currency)
    {
        return $collection->where('price_type', $currency)->where('status', 1)->sum('admin_partner') + $collection->where('admin_commission_type', $currency)->where('status', 1)->sum('admin_commission');
    }
}
if(!function_exists('AdminsumAmountByCurrencyCOfType')){
    function AdminsumAmountByCurrencyCOfType($collection, $type, $currency)
    {
        $sum = $collection->where('type', $type)->where('status', 1)->where('admin_commission_type', $currency)->sum('admin_commission');
        return $sum == 0 ? null : $sum;
    }
}
if(!function_exists('AdminsumAmountByCurrencyPOfType')){
    function AdminsumAmountByCurrencyPOfType($collection, $type, $currency)
    {
        $sum = $collection->where('type', $type)->where('status', 1)->where('price_type', $currency)->sum('admin_partner');
        return $sum == 0 ? null : $sum;
    }
}
if(!function_exists('CountofTypeAadminCont')){
    function CountofTypeAadminCont($collection, $type, $currency)
    {
        $sum = $collection->Where('admin_commission', '!=', '0')->count();
        return $sum == 0 ? null : $sum;
    }
}
if(!function_exists('CountofTypeACont')){
    function CountofTypeACont($collection, $type, $currency)
    {
        $sum = $collection->Where('commission', '!=', '0')->count();
        return $sum == 0 ? null : $sum;
    }
}
if(!function_exists('CountofTypeAdminAC2')){
    function CountofTypeAdminAC2($collection, $type, $currency)
    {
        if ($type == null) {
            $sum = $collection->Where('admin_partner', '!=', null)->where('status', 1)->count();
            
        } else {
            $sum = $collection->Where('admin_partner', '!=', null)->where('type', $type)->where('status', 1)->count();
        }
        return $sum == 0 ? null : $sum;
    }
}
if(!function_exists('CountofTypeAdminAC')){
    function CountofTypeAdminAC($collection, $type, $currency)
    {
        if ($type == null) {
            $sum = $collection->Where('admin_commission', '!=', '0')->count();
        } else {
            $sum = $collection->Where('admin_commission', '!=', '0')->where('type', $type)->where('status', 1)->count();
        }
        return $sum == 0 ? null : $sum;
    }
}
if(!function_exists('sumAmountByCurrencyAllAdminAC')){
    function sumAmountByCurrencyAllAdminAC($collection, $type, $currency)
    {
        return $collection->where('admin_commission_type', $currency)->where('status', 0)->Where('admin_commission', '!=', '0')->sum('admin_commission');
    }
}
if(!function_exists('CountofTypeAdmin')){
    function CountofTypeAdmin($collection, $type, $currency)
    {
        if ($type == 'd') {
            return $collection->WhereNotNull('admin_partner')->where('status', 1)->count();
        }
        if ($type == 'paid') {
            return $collection->WhereNotNull('admin_partner')->where('status', 0)->count();
        }
        if ($type == 'net2') {
            return $collection->WhereNotNull('admin_partner')->where('paybyus', '0')->where('status', 1)->count();
        }
        if ($type == 'net') {
            return $collection->WhereNotNull('admin_partner')->where('paybyus', '1')->where('status', 1)->count();
        }
        if ($type == 'unpaid') {
            return $collection->WhereNotNull('admin_partner')->where('paybyus', '1')->where('status', 0)->count();
        }
        if ($type == null) {
            $sum = $collection->WhereNotNull('admin_partner')->count();
        } else {
            $sum = $collection->WhereNotNull('admin_partner')->where('type', $type)->where('status', 1)->count();
        }
        return $sum == 0 ? null : $sum;
    }
}
if(!function_exists('CountofTypeNets2')){
    function CountofTypeNets2($collection, $type, $currency)
    {
        return $collection->where('price_type', $currency)->where('paybyus', '0')->where('leader_paid', 0)->where('status', '0')->count();
    }
}
if(!function_exists('CountofTypeNets')){
    function CountofTypeNets($collection, $type, $currency)
    {
        if ($type == 'd') {
            return $collection->where('leader_paid', 0)->where('status', '0')->count();
        }
        if ($type == 'paid') {
            return $collection->where('leader_paid', 0)->where('status', '0')->count();
        }
        if ($type == 'net2') {
            return $collection->where('paybyus', '0')->where('status', '0')->where('leader_paid', 0)->count();
        }
        if ($type == 'net') {
            return $collection->where('paybyus', '1')->where('status', '0')->where('leader_paid', 0)->count();
        }
        if ($type == 'unpaid') {
            return $collection->where('paybyus', '1')->where('status', '0')->where('leader_paid', 0)->count();
        }
        if ($type == null) {
            $sum = $collection->where('leader_paid', 0)->where('status', '0')->count();
        } else {
            $sum = $collection->where('type', $type)->where('status', '0')->where('leader_paid', 0)->count();
        }
        return $sum == 0 ? 0 : $sum;
    }
}
if(!function_exists('CountofType')){
    function CountofType($collection, $type, $currency)
    {
        if ($type == 'd') {
            return $collection->where('status', 1)->count();
        }
        if ($type == 'paid') {
            return $collection->where('status', 0)->count();
        }
        if ($type == 'net2') {
            return $collection->where('paybyus', '0')->where('status', 1)->count();
        }
        if ($type == 'net') {
            return $collection->where('paybyus', '1')->where('status', 1)->count();
        }
        if ($type == 'unpaid') {
            return $collection->where('paybyus', '1')->where('status', 0)->count();
        }
        if ($type == null) {
            $sum = $collection->count();
        } else {
            $sum = $collection->where('type', $type)->where('status', 1)->count();
        }
        return $sum == 0 ? null : $sum;
    }
}
if(!function_exists('movement_type_icon')){
    function movement_type_icon($type){
        $icon = null;
        switch($type){
            case 'Transfers':
                $icon = '<i class="fas fa-user-clock"></i>';
                break;
            case 'Driver Tours':
                $icon = '<i class="fa fa-car"></i>';
                break;
            case 'Group Tours':
                $icon = '<i class="fas fa-bus-alt"></i>';
                break;
            case 'hotels':
                $icon = '<i class="fas fa-bed"></i>';
                break;
            case 'Flights':
                $icon = '<i class="fas fa-plane-departure"></i>';
                break;
            case 'Other Services':
                $icon = '<i class="fa fa-check-circle"></i>';
                break;
            case 'T & T':
                $icon = '<i class="fas fa-id-card-alt"></i>';
                break;
            default:
                $icon = $type;
        }
        return $icon;
    }
}
if(!function_exists('abreviation_country')){
    function abreviation_country($country){
        return substr($country , 0 , 3);
    }
}
if(!function_exists('movement_date_format')){
    function movement_date_format($date){
        // return $date;
        return \Carbon\Carbon::createFromFormat('Y-m-d' , $date)->format('d M');
    }
}
