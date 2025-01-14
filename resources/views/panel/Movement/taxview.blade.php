@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','View Taxs')
@section('content')
    @push('panel_css')
    @endpush
    <Style>
    .text-xst {
    font-size: 11px !important;
}
    .table.align-items-center td, .table.align-items-center th {
        max-width: 15%;
        white-space: inherit;
    }
    .form-check {
        display: inline-block;
    }
    .td-5 th {
        width: 15% !important;
    }
    td.user.psw div span {
        float: right;
        color:#000;
        width: Calc(100% - 40%);
        text-align: center;
        padding: 0;
        font-weight: bold !important;
    }
    .paid_div{
            background: #12ff00;
    }
    td.user.psw {
        padding: 0 !important;
    }
    td.user.psw div span:first-child {
        border-right: 1px solid #000;
        font-size: 12px;
        width: 40%;
        float: left;
        margin: 0;
    }
    td.user.psw div:last-child {

        border-bottom: 0;
    }
    td.user.psw div {
        float: right;
        width: 100%;
        margin: 0;
        border-bottom: 1px solid #000;
    }
.redcol .text-xst {
    color: #fff;
}
    </Style>

                <?php
                    $_1_1=0;
                    $_1_2=0;
                    $_1_3=0;
                    $_1_4=0;
                    $_2_1=0;
                    $_2_2=0;
                    $_2_3=0;
                    $_2_4=0;
                    $_3_1=0;
                    $_3_2=0;
                    $_3_3=0;
                    $_3_4=0;
                    $_4_1=0;
                    function sumAmountByCurrencyMove($collection,$year,$state, $currency)
                    {
                        if($year == "revenue_partner"){
                            return $collection->where('price_type', $currency)->sum('revenue_partner');
                        }
                        if($year == null){
                            return $collection->where('price_type', $currency)->where("paybyus","1")->where("sender_paid",$state)->sum('price');
                        }

                        return $collection->where('price_type', $currency)->where("new_date",$year)->where("sender_paid",$state)->sum('price');
                    }
                    function sumAmountByCurrencyMoveCount($collection,$year,$state)
                    {
                        if($year == "revenue_partner"){
                            return $collection->Count();
                        }
                        if($year == "profit"){
                            return $collection->whereNotNull("revenue_partner")->Count();
                        }
                        if($year == null){
                            return $collection->where("paybyus","1")->where("sender_paid",$state)->Count();
                        }

                        return $collection->where("new_date",$year)->where("sender_paid",$state)->Count();
                    }
                    function sumAmountByCurrencyInc($collection,$year, $currency)
                    {
                        if($year == null){
                            return $collection->where('price_type', $currency)->whereNull("movement_id")->sum('price');
                        }
                        return  $collection->where('price_type', $currency)->where("new_date",$year)->whereNull("movement_id")->sum('price');
                    }
                ?>

    <?php

        function sumPartners($collection,$type, $currency)
        {
            $sum = 0;
            $collection = $collection->where('price_type', $currency)->where("status",0);
            if($type == "5"){
                $sum0 = $collection->where("paybyus" , "1")->sum("price");

                $sum =  ($collection->where("paybyus" , "0")->sum("revenue_partner")) - $sum0;
            }else{
                $collection = $collection->wherein("user_id",[1,2,3,4,5]);

                $sum = $collection->where("paybyus" , "0")->sum("revenue") +
                        $collection->where("paybyus" , "0")->sum("admin_partner") +
                        $collection->where("paybyus" , "0")->sum("revenue_partner");

                $sum = $sum - $collection->where("paybyus" , "1")->sum("net");
            }
            return $sum;
        }

        function sumAmountByCurrency($collection,$type, $currency)
        {
            $rev = "revenue";
            $collection = $collection->where('price_type', $currency);
            if($type == "5"){
                $rev = "revenue_partner";
            }else{
                $collection = $collection->where("status",1);
            }
            return $collection->sum($rev);
        }
        function sumAmountByCurrencyAllsNets($collection,$type, $currency)
        {

            $net = $collection->where('price_type', $currency)->where("paybyus" , "1")->where("leader_paid" , "0")->where("status","0")->where("net_tl",0)->sum("net");
            if($currency == "TL"){
                $net1 = $collection->where('price_type', $currency)->where("paybyus" , "1")->where("leader_paid" , "0")->where("status","0")->where("net_tl",0)->sum("net");
                $net3 = $collection->where('price_type',"!=", $currency)->where("paybyus" , "1")->where("leader_paid" , "0")->where("status","0")->sum("net_tl");
                $net = $net1+$net3;
            }

            $net02 = $collection->where('price_type', $currency)->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0")->where("net_tl",0)->sum("admin_partner");
            $net012 = $collection->where('price_type', $currency)->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0")->where("net_tl",0)->sum("revenue");
            $net2 = $net02 + $net012;
            if($currency == "TL"){
                $net6 = $collection->where('price_type', $currency)->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0")->where("net_tl",0)->sum("admin_partner");
                $net4 = $collection->where('price_type', $currency)->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0")->where("net_tl",0)->sum("revenue");
                $net5 = $collection->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0")->sum("net_tl");
                $net2 = $net4+$net5+$net6;
            }
            if($type == "net2"){
                return $net2;
            }
            if($type == "net"){
                return $net;
            }

            if($type == null){
                $net = $collection->where('price_type', $currency)->where("paybyus" , "1")->where("leader_paid" , "0")->where("status","0")->where("net_tl",0)->sum("net");
                if($currency == "TL"){
                    $net1 = $collection->where('price_type', $currency)->where("paybyus" , "1")->where("leader_paid" , "0")->where("status","0")->where("net_tl",0)->sum("net");
                    $net3 = $collection->where('price_type',"!=", $currency)->where("paybyus" , "1")->where("leader_paid" , "0")->where("status","0")->sum("net_tl");
                    $net = $net1+$net3;
                }


                $net02 = $collection->where('price_type', $currency)->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0")->where("net_tl",0)->sum("admin_partner");
                $net2 = $net02 + $collection->where('price_type', $currency)->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0")->where("net_tl",0)->sum("revenue");
                if($currency == "TL"){
                    $net02 = $collection->where('price_type', $currency)->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0")->where("net_tl",0)->sum("admin_partner");
                    $net4 = $net02+$collection->where('price_type', $currency)->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0")->where("net_tl",0)->sum("revenue");
                    $net5 = $collection->where("paybyus" , "0")->where("leader_paid" , "0")->where("status","0")->sum("net_tl");
                    $net2 = $net4+$net5;
                }

                return $net2 - $net;
            }


        }
        function sumAmountByCurrencyAlls($collection,$type, $currency)
        {

            $net = $collection->where('price_type', $currency)->where("paybyus" , "1")->where("status" , "1")->where("net_tl",0)->sum("net");
            if($currency == "TL"){
                $net1 = $collection->where('price_type', $currency)->where("paybyus" , "1")->where("status" , "1")->where("net_tl",0)->sum("net");
                $net3 = $collection->where('price_type',"!=", $currency)->where("paybyus" , "1")->where("status" , "1")->sum("net_tl");
                $net = $net1+$net3;
            }

            $net2 = $collection->where('price_type', $currency)->where("paybyus" , "0")->where("status" , "1")->where("net_tl",0)->sum("net");

            if($currency == "TL"){
                $net4 = $collection->where('price_type', $currency)->where("paybyus" , "0")->where("status" , "1")->where("net_tl",0)->sum("net");
                $net5 = $collection->where("paybyus" , "0")->where("status" , "1")->sum("net_tl");
                $net2 = $net4+$net5;
            }

            $unpaid = $collection->where('price_type', $currency)->where("paybyus" , "1")->where("status" , "0")->where("net_tl",0)->sum("net");
            if($currency == "TL"){
                $net6 = $collection->where('price_type', $currency)->where("paybyus" , "1")->where("status" , "0")->where("net_tl",0)->sum("net");
                $net7 = $collection->where("paybyus" , "1")->where("status" , "0")->sum("net_tl");
                $unpaid = $net7+$net6;
            }

            $profit = $collection->where('price_type', $currency)->where("paybyus" , "0")->where("status" , "1")->sum("revenue");
            $profit2 = $collection->where('price_type', $currency)->where("paybyus" , "1")->where("status" , "1")->sum("revenue");
            if($type == "profit"){
                return $profit;
            }
            if($type == "paid"){
                return $profit2;
            }
            if($type == "unpaid"){
                return $unpaid;
            }
            if($type == "net"){
                return $net;
            }
            if($type == "net2"){
                return $net2;
            }
            if($type == null){
                $net = $collection->where('price_type', $currency)->where("net_tl",0)->sum("net");
                if($currency == "TL"){
                    $net1 = $collection->where('price_type', $currency)->where("net_tl",0)->sum("net");
                    $net3 = $collection->where('price_type',"!=", $currency)->sum("net_tl");
                    $net = $net1+$net3;
                }
                return $net;
            }
            return $net+$net2;
        }
        function sumAmountByCurrencyAllAdmin($collection,$type, $currency)
        {
            $s =  $collection->where('price_type', $currency)->WhereNotNull("admin_partner")->sum("admin_partner");
            $s2 = $collection->where('admin_commission_type', $currency)->Where("admin_commission","!=","0")->sum("admin_commission");
            return $s + $s2;
        }
        function sumAmountByCurrencyAll($collection,$type, $currency)
        {
            return $collection->where('price_type', $currency)->where("status",1)->sum("revenue")
                    + $collection->where('commission_type', $currency)->where("status",1)->sum("commission");
        }
        function sumProfitPartnerAll($collection,$type, $currency)
        {
            return $collection->where("status",1)->sum("revenue_partner");
        }
        function sumAmountByCurrencyC($collection,$type, $currency)
        {
            return $collection->where('commission_type', $currency)->sum('commission');
        }
        function sumAmountByCurrencyCOfType($collection,$type, $currency)
        {
            $sum = $collection->where("type" , $type)->where("status",1)->where('commission_type', $currency)->sum('commission');
            return $sum == 0 ? null : $sum;
        }
        function sumAmountByCurrencyPOfType($collection,$type, $currency)
        {
            $sum = $collection->where("type" , $type)->where("status",1)->where('price_type', $currency)->sum('revenue');
            return $sum == 0 ? null : $sum;
        }

        function AdminsumAmountByCurrencyAll($collection,$type, $currency)
        {
            return $collection->where('price_type', $currency)->where("status",1)->sum("admin_partner") + $collection->where('admin_commission_type', $currency)->where("status",1)->sum("admin_commission");
        }
        function AdminsumAmountByCurrencyCOfType($collection,$type, $currency)
        {
            $sum = $collection->where("type" , $type)->where("status",1)->where('admin_commission_type', $currency)->sum('admin_commission');
            return $sum == 0 ? null : $sum;
        }
        function AdminsumAmountByCurrencyPOfType($collection,$type, $currency)
        {
            $sum = $collection->where("type" , $type)->where("status",1)->where('price_type', $currency)->sum('admin_partner');
            return $sum == 0 ? null : $sum;
        }


        function CountofTypeAdminAC($collection,$type, $currency)
        {
            if($type == null){
                $sum = $collection->Where("admin_commission","!=","0")->count();
            }else{
                $sum = $collection->Where("admin_commission","!=","0")->where("type" , $type)->where("status",1)->count();
            }
            return $sum == 0 ? null : $sum;
        }
        function sumAmountByCurrencyAllAdminAC($collection,$type, $currency)
        {
            return $collection->where('admin_commission_type', $currency)->Where("admin_commission","!=","0")->sum("admin_commission");
        }
        function CountofTypeAdmin($collection,$type, $currency)
        {
            if($type == "d"){
            return $collection->WhereNotNull("admin_partner")->where("status",1)->count();
            }
            if($type == "paid"){
            return $collection->WhereNotNull("admin_partner")->where("status",0)->count();
            }
            if($type == "net2"){
                return $collection->WhereNotNull("admin_partner")->where("paybyus" , "0")->where("status",1)->count();
            }
            if($type == "net"){
                return $collection->WhereNotNull("admin_partner")->where("paybyus" , "1")->where("status",1)->count();
            }
            if($type == "unpaid"){
                return $collection->WhereNotNull("admin_partner")->where("paybyus" , "1")->where("status",0)->count();
            }
            if($type == null){
            $sum = $collection->WhereNotNull("admin_partner")->count();
            }else{
            $sum = $collection->WhereNotNull("admin_partner")->where("type" , $type)->where("status",1)->count();
            }
            return $sum == 0 ? null : $sum;
        }
        function CountofTypeNets($collection,$type, $currency)
        {
            if($type == "d"){
            return $collection->where("leader_paid",0)->where("status","0")->count();
            }
            if($type == "paid"){
            return $collection->where("leader_paid",0)->where("status","0")->count();
            }
            if($type == "net2"){
                return $collection->where("paybyus" , "0")->where("status","0")->where("leader_paid",0)->count();
            }
            if($type == "net"){
                return $collection->where("paybyus" , "1")->where("status","0")->where("leader_paid",0)->count();
            }
            if($type == "unpaid"){
                return $collection->where("paybyus" , "1")->where("status","0")->where("leader_paid",0)->count();
            }
            if($type == null){
            $sum = $collection->where("leader_paid",0)->where("status","0")->count();
            }else{
            $sum = $collection->where("type" , $type)->where("status","0")->where("leader_paid",0)->count();

            }
            return $sum == 0 ? 0 : $sum;
        }
        function CountofType($collection,$type, $currency)
        {
            if($type == "d"){
            return $collection->where("status",1)->count();
            }
            if($type == "paid"){
            return $collection->where("status",0)->count();
            }
            if($type == "net2"){
                return $collection->where("paybyus" , "0")->where("status",1)->count();
            }
            if($type == "net"){
                return $collection->where("paybyus" , "1")->where("status",1)->count();
            }
            if($type == "unpaid"){
                return $collection->where("paybyus" , "1")->where("status",0)->count();
            }
            if($type == null){
            $sum = $collection->count();
            }else{
            $sum = $collection->where("type" , $type)->where("status",1)->count();

            }
            return $sum == 0 ? null : $sum;
        }

    ?>
    <style>
    .text-xsm{
    font-size: 0.75rem !important;
    }
        .flag img {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%,-50%);
    width: 100%;
    overflow: hidden;
    border-radius: 50%;
    height: 100%;
}
.flag {
    position: relative;
    display: inline-block;
    width: 22px;
    height: 22px;
    overflow: hidden;
    margin-bottom: -2px;
    margin-top: 4px;
}
ul.munths a.selected {
    background-color: #252f40;
    border-color: #252f40;
    color:#fff;
}
ul.munths a {
    float: right;
    width: 28px;
    height: 28px;
    border: 1px solid #ddd;
    font-size: 12px;
    text-align: center;
    line-height: 28px;
    border-radius: 5px;
}
ul.munths li {
    float: left;
    margin-right: 5px;
}
ul.munths {
    display: inline-block;
    margin-right: 5px;
    list-style: none;
    padding: 0;
    margin-bottom: -5px;
}
.checkbox.sus label{
    padding-left: 0;
    font-size: 16px;
    padding-right: 30px;
}
.checkbox.sus label:before{
    width:25px;
    height:25px;
    right: 0;
    left: auto !important;
}
.checkbox.sus label:after{
    width:25px !important;
    height:25px !important;
    right: 0;
    left: auto !important;
    font-size: 14px !important;
    line-height: 24px !important;
}
.munths li a.datecolor{
    color:red;
}
    </style>
    <div class="row">
        <div class="col-12" style="position: relative;">
            <div class="card mb-4 mx-4 pb-2" style="position: sticky;right: 0;left: 17%;z-index: 3;top: 4px;">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1 show_accro">
                                Filter Taxs
                            </h5>
                        </div>
                        <div>
                            <?php
                            $url = Route('panel.cash.tax')."?";
                            if(isset($request["d_user"]) && $request["d_user"]){
                                $url .="&d_user=".$request["d_user"];
                            }

                            if(isset($request["type"]) && $request["type"]){
                                $url .="&type=".$request["type"];
                            }

                            if(isset($request["m_type"]) && $request["m_type"]){
                                $url .="&m_type=".$request["m_type"];
                            }

                            if(isset($request["country_id"]) && $request["country_id"]){
                                $url .="&country_id=".$request["country_id"];
                            }
                            $nows = \Carbon\Carbon::now();
                            $now = $nows->month;
                            $year = $nows->year;
                            if(isset($request["from_date"]) && $request["from_date"] != null){
                                $nows = \Carbon\Carbon::parse($request["from_date"]);
                                $now = $nows->month;
                                $year = $nows->year;
                            }
                            ?>
                            <ul class="munths">
                                <li><a href="{{$url.'&from_date='.$year.'-01-01&to_date='.$year.'-01-31'}}" class='{{$now == 1 ? "selected" : "" }}'>01</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-02-01&to_date='.$year.'-02-31'}}" class='{{$now == 2 ? "selected" : "" }}'>02</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-03-01&to_date='.$year.'-03-31'}}" class='{{$now == 3 ? "selected" : "" }}'>03</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-04-01&to_date='.$year.'-04-31'}}" class='{{$now == 4 ? "selected" : "" }}'>04</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-05-01&to_date='.$year.'-05-31'}}" class='{{$now == 5 ? "selected" : "" }}'>05</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-06-01&to_date='.$year.'-06-31'}}" class='{{$now == 6 ? "selected" : "" }}'>06</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-07-01&to_date='.$year.'-07-31'}}" class='{{$now == 7 ? "selected" : "" }}'>07</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-08-01&to_date='.$year.'-08-31'}}" class='{{$now == 8 ? "selected" : "" }}'>08</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-09-01&to_date='.$year.'-09-31'}}" class='{{$now == 9 ? "selected" : "" }}'>09</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-10-01&to_date='.$year.'-10-31'}}" class='{{$now == 10 ? "selected" : "" }}'>10</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-11-01&to_date='.$year.'-11-31'}}" class='{{$now == 11 ? "selected" : "" }}'>11</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-12-01&to_date='.$year.'-12-31'}}" class='{{$now == 12 ? "selected" : "" }}'>12</a></li>
                            </ul>
                            <a class="btn bg-gradient-dark btn-sm mb-2 export_pdf" type="button">Export PDF</a>
                            <a href="{{ route('panel.movement.add_new') }}" class="btn bg-gradient-dark btn-sm mb-2" type="button">+&nbsp; New entry</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4 mx-4 mt-2">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between mb-2">
                        <div>

                            <?php
                                $t1 = 0;
                                $t2 = 0;
                                $t3 = 0;
                                if(isset($ispartner) && $ispartner->type != 1){
                                    foreach($data as $key=>$ye){
                                        foreach($ye as $key_yes => $yes){
                                            $t1 += sumAmountByCurrencyAllsNets($yes ,null, '$');
                                            $t2 += sumAmountByCurrencyAllsNets($yes ,null, 'TL');
                                            $t3 += sumAmountByCurrencyAllsNets($yes ,null, '€');
                                        }
                                    }
                                }
                                $OldCount = 0;
                            ?>

                            <h5 class="mb-1">All Taxs
                                @if(isset($ispartner))
                                    @if($ispartner->type == 5)
                                    , {{ $ispartner->full_name }} & Ahlan Antalya{{ ($ispartner->blance_usd != 0 || $ispartner->blance_tl != 0 || $ispartner->blance_e != 0 || $ispartner->blance_p != 0) == true ? ": " : "" }}

                                        {{ $ispartner->blance_usd == 0 ? "" : " $ ". $ispartner->blance_usd}}
                                        {{ $ispartner->blance_usd != 0 && $ispartner->blance_tl != 0   ? " & " : "" }}
                                        {{ $ispartner->blance_tl == 0 ? "" : " TL ". $ispartner->blance_tl}}
                                        {{ $ispartner->blance_tl != 0 && $ispartner->blance_e != 0   ? " & " : "" }}
                                        {{ $ispartner->blance_e == 0 ? "" : " € ". $ispartner->blance_e}}
                                        {{ $ispartner->blance_e != 0 && $ispartner->blance_p != 0   ? " & " : "" }}
                                        {{ $ispartner->blance_p == 0 ? "" : " £ ". $ispartner->blance_p}}

                                        @if($ispartner->blance_usd != 0 || $ispartner->blance_tl != 0 || $ispartner->blance_e != 0 || $ispartner->blance_p != 0)
                                        {{-- <div class="checkbox sus" style="margin-top: 4px;float: right;width: auto;">
                                            <input name="paids" type="checkbox" placeholder="paids" id="paids" value="1">
                                            <label for="paids"> , {{ __('Paid Done') }}</label>
                                        </div> --}}
                                        <form id="form_paids" action="{{ Route('panel.movement.paid') }}" method="post" role="form text-left" style="display:none;float: right;margin-top: -2px;margin-left: 5px;">
                                            @csrf
                                            <input type="hidden" name="from_date" value="{{ @$request['from_date'] }}" />
                                            <input type="hidden" name="to_date" value="{{ @$request['to_date'] }}" />
                                            <input type="hidden" name="d_user" value="{{ @$request['d_user'] }}" />
                                            <input type="hidden" name="type" value="{{ @$request['type'] }}" />
                                            <input type="hidden" name="m_type" value="{{ @$request['m_type'] }}" />
                                            <input type="hidden" name="country_id" value="{{ @$request['country_id'] }}" />
                                        </form>
                                        @endif
                                    @elseif($ispartner->id == 5)
                                        , {{ $ispartner->full_name }} {{ ($ispartner->blance_usd != 0 || $ispartner->blance_tl != 0 || $ispartner->blance_e != 0 || $ispartner->blance_p != 0) == true ? ": " : "" }}

                                        {{ $ispartner->blance_usd == 0 ? "" : " $ ". $ispartner->blance_usd}}
                                        {{ $ispartner->blance_usd != 0 && $ispartner->blance_tl != 0   ? " & " : "" }}
                                        {{ $ispartner->blance_tl == 0 ? "" : " TL ". $ispartner->blance_tl}}
                                        {{ $ispartner->blance_tl != 0 && $ispartner->blance_e != 0   ? " & " : "" }}
                                        {{ $ispartner->blance_e == 0 ? "" : " € ". $ispartner->blance_e}}
                                        {{ $ispartner->blance_e != 0 && $ispartner->blance_p != 0   ? " & " : "" }}
                                        {{ $ispartner->blance_p == 0 ? "" : " £ ". $ispartner->blance_p}}
                                    @else
                                     , {{ $ispartner->full_name }} {{ ($t1 != 0 || $t2 != 0 || $t3 != 0 || @$ispartner->blance != 0) == true ? ": " : "" }}
                                    @endif


                                    @if($ispartner->type == 3)
                                     {{ $ispartner->blance < 0 ? "-" : "" }}
                                     {{ $ispartner->blance != 0 ? "$" .$ispartner->blance < 0 ? abs($ispartner->blance) : "$" . $ispartner->blance : "" }}
                                    @endif

                                    @if($ispartner->type == 2 || $ispartner->type == 4)
                                        {{ $t1 == null || $t1 == 0 ? "" : " $ ".$t1}}
                                        {{ $t2 == null || $t2 == 0 ? "" : "& TL ".$t2}}
                                        {{ $t3 == null || $t3 == 0 ? "" : "& € ".$t3}}
                                        @if($t1 != 0 || $t2 != 0 || $t3 != 0)
                                        {{-- <div class="checkbox sus" style="margin-top: 4px;float: right;width: auto;">
                                            <input name="paids" type="checkbox" placeholder="paids" id="paids" value="1">
                                            <label for="paids"> , {{ __('Paid Done') }}</label>
                                        </div> --}}
                                        <form id="form_paids" action="{{ Route('panel.movement.paid') }}" method="post" role="form text-left" style="display:none;float: right;margin-top: -2px;margin-left: 5px;">
                                            @csrf
                                            <input type="hidden" name="from_date" value="{{ @$request['from_date'] }}" />
                                            <input type="hidden" name="to_date" value="{{ @$request['to_date'] }}" />
                                            <input type="hidden" name="d_user" value="{{ @$request['d_user'] }}" />
                                            <input type="hidden" name="type" value="{{ @$request['type'] }}" />
                                            <input type="hidden" name="m_type" value="{{ @$request['m_type'] }}" />
                                            <input type="hidden" name="country_id" value="{{ @$request['country_id'] }}" />
                                        </form>
                                        @endif
                                    @endif

                                    @if($ispartner->id == 25)
                                        {{ $ispartner->blance_tlgn != 0 ? "TL" . $ispartner->blance_tlgn : "" }}
                                    @endif
                                @endif
                            </h5>
                        </div>
                    </div>
                </div>
                <div id="exp_pdf" class="card-body px-3 pt-0 pb-2 cls">
                    <!-- <div class="table-responsive p-0"> -->
                    @foreach($data as $key=>$ye)
                        @foreach($ye as $key_yes => $yes)
                            <?php
                                $ispartnerprofit = sumProfitPartnerAll($yes,null,null);
                                $is=0;
                                $iss=0;
                                $isss=0;
                                $issss=0;

                                $cs=0;
                                $css=0;
                                $csss=0;
                                $cssss=0;

                                $date="";
                                foreach($ye as $k=>$it){
                                    $date = $k;
                                }
                            ?>
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr class="bg">
                                        <th colspan="20">
                                            @if(isset($ispartner) && $ispartner->type == 5)
                                                Ahlan Antalya <br>
                                            @else
                                            {{$date}}
                                            @endif
                                        </th>
                                    </tr>

                                    @include('panel.Movement.headertable')
                                </thead>
                                <tbody>

                                    <?php $old_this = false; ?>
                                    @foreach($yes as $key => $row)
                                        <?php $keysyes = ($key == sizeof($yes)-1 ? "tr_last" : ""); ?>
                                        @include('panel.Movement.table')
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    @endforeach

                </div>
            </div>
        </div>
    </div>
  @section('panel_js')
    <script>
        $( document ).ready(function() {
            console.log($(".table").find(".tr_last").length);
            if($(".table").find(".tr_last").length >= 1){
                $( ".tr_last" )[0].scrollIntoView();
            }
        });
    </script>
  @endsection
@stop
