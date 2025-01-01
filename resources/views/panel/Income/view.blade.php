@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','View Accounting')
@section('content')
    @push('panel_css')
    @endpush
<Style>
    table.table td:last-child a{
        float: right;
}
     table.table.act th:last-child, table.table.act td:last-child {
    width: 50px !important;
    padding: 0 10px;
}
table.table.align-items-center.mb-0.th_1 th{
    width: 50%;
}
table.table.align-items-center.mb-0.th_2 th{
    width: 33.3%;
}
table.table.align-items-center.mb-0.th_3 th{
    width: 25%;
}
table.table.align-items-center.mb-0.th_4 th{
    width: 20%;
}
table.table tbody td p.gren,
p.gren {
    color: green !important;
}
table.table tbody td p.red,
p.red {
    color: red  !important;
}

.munths li a.datecolor{
    color:red;
}
.munths li a.datecolor.selected{
    color: #fff;
    background-color: red;
    border-color: red;
}
.hideAccount{
    display:none !important;
}
.hideAccount.active{
    display:block !important;
}
.showaccout {
    display: inline-block;
    width: 15px;
    height: 15px;
    background: #fbfbfb;
    border-radius: 50%;
    color:#d7d7d7;
    font-size:10px;
    margin-right: 7px;
    margin-top: 6px;
    float: left;
    cursor: pointer;
}
</Style>
    <div class="row">
        <div class="col-12"  style="position:relative;">
            <div class="card mb-4 mx-4 pb-2" style="position: sticky;right: 0;left: 17%;z-index: 3;top: 4px;">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1 show_accro">Filter</h5>
                        </div>
                        <div>
                            <?php
                            $url = Route('panel.cash.view')."?";
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
                            $tnow = $nows->month;
                            $now = $nows->month;
                            $year = $nows->year;
                            if(isset($request["from_date"]) && $request["from_date"] != null){
                                $nows = \Carbon\Carbon::parse($request["from_date"]);
                                $now = $nows->month;
                                $year = $nows->year;
                            }
                            ?>
                            <span class="showaccout"><i class="fa fa-plus"></i></span>
                            <ul class="munths">
                                <?php
                                    $its = \App\Models\Income::whereNull("movement_id")->whereMonth("date",">",$tnow)->whereBetween("date" , ['2024-11-01','2024-11-30'])->get()->Count();
                                ?>
                                <li><a href="{{$url.'&from_date=2024-11-01&to_date=2024-11-30'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 11 ? "selected" : "" }}'>11</a></li>
                                <?php
                                    $its = \App\Models\Income::whereNull("movement_id")->whereMonth("date",">",$tnow)->whereBetween("date" , ['2024-12-01','2024-12-31'])->get()->Count();
                                ?>
                                <li><a href="{{$url.'&from_date=2024-12-01&to_date=2024-12-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 12 ? "selected" : "" }}'>12</a></li>

                                <?php
                                    $its = \App\Models\Income::whereNull("movement_id")->whereMonth("date",">",$tnow)->whereBetween("date" , [$year.'-01-01',$year.'-01-31'])->get()->Count();
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-01-01&to_date='.$year.'-01-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 1 ? "selected" : "" }}'>01</a></li>
                                <?php
                                    $its = \App\Models\Income::whereNull("movement_id")->whereMonth("date",">",$tnow)->whereBetween("date" , [$year.'-02-01',$year.'-02-31'])->get()->Count();
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-02-01&to_date='.$year.'-02-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 2 ? "selected" : "" }}'>02</a></li>
                                <?php
                                    $its = \App\Models\Income::whereNull("movement_id")->whereMonth("date",">",$tnow)->whereBetween("date" , [$year.'-03-01',$year.'-03-31'])->get()->Count();
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-03-01&to_date='.$year.'-03-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 3 ? "selected" : "" }}'>03</a></li>
                                <?php
                                    $its = \App\Models\Income::whereNull("movement_id")->whereMonth("date",">",$tnow)->whereBetween("date" , [$year.'-04-01',$year.'-04-31'])->get()->Count();
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-04-01&to_date='.$year.'-04-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 4 ? "selected" : "" }}'>04</a></li>
                                <?php
                                    $its = \App\Models\Income::whereNull("movement_id")->whereMonth("date",">",$tnow)->whereBetween("date" , [$year.'-05-01',$year.'-05-31'])->get()->Count();
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-05-01&to_date='.$year.'-05-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 5 ? "selected" : "" }}'>05</a></li>
                                <?php
                                    $its = \App\Models\Income::whereNull("movement_id")->whereMonth("date",">",$tnow)->whereBetween("date" , [$year.'-06-01',$year.'-06-31'])->get()->Count();
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-06-01&to_date='.$year.'-06-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 6 ? "selected" : "" }}'>06</a></li>
                                <?php
                                    $its = \App\Models\Income::whereNull("movement_id")->whereMonth("date",">",$tnow)->whereBetween("date" , [$year.'-07-01',$year.'-07-31'])->get()->Count();
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-07-01&to_date='.$year.'-07-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 7 ? "selected" : "" }}'>07</a></li>
                                <?php
                                    $its = \App\Models\Income::whereNull("movement_id")->whereMonth("date",">",$tnow)->whereBetween("date" , [$year.'-08-01',$year.'-08-31'])->get()->Count();
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-08-01&to_date='.$year.'-08-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 8 ? "selected" : "" }}'>08</a></li>
                                <?php
                                    $its = \App\Models\Income::whereNull("movement_id")->whereMonth("date",">",$tnow)->whereBetween("date" , [$year.'-09-01',$year.'-09-31'])->get()->Count();
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-09-01&to_date='.$year.'-09-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 9 ? "selected" : "" }}'>09</a></li>
                                <?php
                                    $its = \App\Models\Income::whereNull("movement_id")->whereMonth("date",">",$tnow)->whereBetween("date" , [$year.'-10-01',$year.'-10-31'])->get()->Count();
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-10-01&to_date='.$year.'-10-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 10 ? "selected" : "" }}'>10</a></li>
                                <?php
                                    $its = \App\Models\Income::whereNull("movement_id")->whereMonth("date",">",$tnow)->whereBetween("date" , [$year.'-11-01',$year.'-11-31'])->get()->Count();
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-11-01&to_date='.$year.'-11-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 11 ? "selected" : "" }}'>11</a></li>
                                <?php
                                    $its = \App\Models\Income::whereNull("movement_id")->whereMonth("date",">",$tnow)->whereBetween("date" , [$year.'-12-01',$year.'-12-31'])->get()->Count();
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-12-01&to_date='.$year.'-12-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 12 ? "selected" : "" }}'>12</a></li>
                            </ul>
                        <a class="btn bg-gradient-dark btn-sm mb-2 export_pdf" type="button">PDF</a>
                        <a href="{{ route('panel.cash.tax') }}" class="btn bg-gradient-dark btn-sm mb-2" type="button">Tax</a>
                        <a href="{{ route('panel.cash.add_new') }}" class="btn bg-gradient-dark btn-sm mb-2" type="button">+&nbsp; cash</a>
                        </div>
                        </div>
                </div>
                <div class="card-body px-4 pt-0 pb-2 mb-0 hide_accro">
                    <form action="{{ Route('panel.cash.view') }}" method="Get" role="form text-left">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="type" class="form-control-label">{{ __('Type') }}</label>
                                    <div class="@error('type') border border-danger rounded-3 @enderror">
                                        <select name="type" class="select form-control" id="type">
                                            <option value="">Choose</option>
                                            <option value="Income" {{ @$request['type'] == "Income" ? 'selected' : '' }}>Income</option>
                                            <option value="Expenses" {{ @$request['type'] == "Expenses" ? 'selected' : '' }}>Expenses</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="from_date" class="form-control-label">{{ __('From Date') }}</label>
                                    <div class="@error('from_date') border border-danger rounded-3 @enderror">
                                        <input class="form-control datepicker" name="from_date" value="{{@$request['from_date']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="to_date" class="form-control-label">{{ __('To Date') }}</label>
                                    <div class="@error('to_date') border border-danger rounded-3 @enderror">
                                        <input class="form-control datepicker" name="to_date" value="{{@$request['to_date']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="for_id" class="form-control-label">{{ __('User') }}</label>
                                    <div class="@error('for_id') border border-danger rounded-3 @enderror">
                                        <select name="for_id" class="select form-control" id="for_id">
                                        <option value="">Choose</option>
                                        <option value="0" {{ @$request['for_id'] == "0" ? 'selected' : '' }}>Expenses</option>
                                            @foreach($users as $key => $row)
                                                <option value="{{$row->id}}" {{ @$request['for_id'] == $row->id ? 'selected' : '' }}>{{$row->full_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn bg-gradient-dark btn-md mt-1 mb-1">{{ 'Go Filter' }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mb-4 mx-4 hideAccount">
                <div class="card-header pb-2">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1">
                                Accounting{{ $ts1 != 0 || $ts2 != 0 || $ts3 != 0 || $ts4 != 0 ? ": " : ""}}
                                {{ ($ts1 != 0 ? "$ ".$ts1 : "") . ($ts2 != 0 ? " & TL ".$ts2 : "") . ( $ts3 != 0 ? " & € ".$ts3 : "") .  ($ts4 != 0 ? " & £ ".$ts4 : "") }}
                            </h5>
                        </div>
                    </div>
                </div>
                <?php
                    function sumAmountByCurrency($collection,$new_date,$type, $currency)
                    {
                        if($type == "Income"){
                            //->whereNotNull("movement_id")
                             return $collection->where('price_type', $currency)->where("new_date" , $new_date)
                             ->where("type" , $type)->sum('price');
                        }
                         //else{
                            return $collection->where('price_type', $currency)->where("new_date" , $new_date)
                            ->where("type" , $type)->sum('price');

                        //}
                    }
                    function SumByType($collection, $colum,$Sum)
                    {
                        $item = $collection->where('price_type', $colum)->sum($Sum);
                        return $item;
                    }
                    function sumMAmountByCurrency($collection,$new_date, $colum)
                    {
                        $i = $collection->where('price_type', $colum)->where("new_date" , $new_date)->sum("revenue");
                        $i2 = $collection->where('price_type', $colum)->where("new_date" , $new_date)->sum("admin_partner");
                        return  $i + $i2;
                    }
                    function sumMCAmountByCurrency($collection,$new_date, $colum)
                    {
                        return $collection->where('commission_type', $colum)->where("new_date" , $new_date)->sum("commission") + $collection->where('admin_commission_type', $colum)->where("new_date" , $new_date)->sum("admin_commission");
                    }
                    function sumMTAmountByCurrency($collection,$new_date, $colum)
                    {
                        return $collection->where('price_type', $colum)->where("new_date" , $new_date)->sum("tax");
                    }
                ?>
                <div id="exp_pdf" class="card-body px-2 pt-0 pb-2">
                    <div class="row">
                        @foreach($data_y as $year)
                            @foreach($types as $type)
                            <?php $con = 1; ?>
                            <div class="col-6 col-xs-12">
                                <div class="table-responsive p-0 mb-3">
                                    <table class="table align-items-center mb-0 act head_table ">
                                        <thead>
                                            <tr class="bg">
                                                <th colspan="10">
                                                    {{ $type }}<br>
                                                    <!--{{ $year->new_date }} -->
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <table class="table align-items-center mb-0 act nopadhid">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    ID
                                                </th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Date
                                                </th>
                                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Summary
                                                </th>
                                                @if(SumByType($data_e,"$","price") != 0)
                                                <th class="price text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 incs">
                                                    $
                                                </th>
                                                @endif
                                                @if(SumByType($data_e,"TL","price") != 0)
                                                <th class="price text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 incs">
                                                    TL
                                                </th>
                                                @endif
                                                @if(SumByType($data_e,"€","price") != 0)
                                                <th class="price text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 incs">
                                                €
                                                </th>
                                                @endif
                                                @if(SumByType($data_e,"£","price") != 0)
                                                <th class="price text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 incs">
                                                £
                                                </th>
                                                @endif
                                                <th class="last-child text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $usd=0;
                                            $tl=0;
                                            $euro=0;
                                            $pond=0;
                                        ?>
                                        @foreach($data_e as $key => $row)
                                        @if($row->new_date == $year->new_date && $row->type == $type)
                                            <?php
                                                if($row->price_type == "$"){
                                                    $usd += $row->price;
                                                }
                                                if($row->price_type == "TL"){
                                                    $tl += $row->price;
                                                }
                                                if($row->price_type == "£"){
                                                    $pond += $row->price;
                                                }
                                                if($row->price_type == "€"){
                                                    $euro += $row->price;
                                                }
                                            ?>
                                            <tr>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $con  }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{  date("d M", strtotime($row->date)) }}</p>
                                                </td>
                                                <td>
                                                    @if($row->movement_id != null)
                                                    <a class="text-xs font-weight-bold mb-0"  target="_blank" href="{{ url('admin/entries/add',$row->movement_id) }}">
                                                        @if($row->com == "0")
                                                            <i class="fa fa-exchange" aria-hidden="true"></i>
                                                        @else
                                                            C ::
                                                        @endif
                                                        {{$row->note == null ? $type." From ".@$row->for_user->full_name : $row->note}}
                                                    </a>
                                                    @else
                                                    <p class="text-xs font-weight-bold mb-0 {{  $row->movement_id == null ? ( $row->for_id != null ? "" : ($type == 'Income' ? 'gren' : 'red')) : ''}}">{{$row->note == null ? $type . ($type == "Income" ? " From " : " to ").@$row->for_user->full_name : $row->note}}</p>
                                                    @endif
                                                </td>
                                                @if(SumByType($data_e,"$","price") != 0)
                                                <td class="incs">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $row->price_type == "$" ? $row->price : "0" }}</p>
                                                </td>
                                                @endif
                                                @if(SumByType($data_e,"TL","price") != 0)
                                                <td class="incs">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $row->price_type == "TL" ? $row->price : "0" }}</p>
                                                </td>
                                                @endif
                                                @if(SumByType($data_e,"€","price") != 0)
                                                <td class="incs">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $row->price_type == "€" ? $row->price : "0" }}</p>
                                                </td>
                                                @endif
                                                @if(SumByType($data_e,"£","price") != 0)
                                                <td class="incs">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $row->price_type == "£" ? $row->price : "0" }}</p>
                                                </td>
                                                @endif
                                                <td class="text-center">
                                                    <a data-url="{{ route('panel.cash.delete' , $row->income_id) }}" class="mx-1 delete" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Delete cash">
                                                        <i class="cursor-pointer fas fa-trash text-danger"></i>
                                                    </a>
                                                    @if($row->movement_id == null)
                                                    <a href="{{ route('panel.cash.add_new' , $row->income_id) }}" target="_blank" class="mx-1"  target="_blank" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Edit cash">
                                                        <i class="fas fa-user-edit text-secondary"></i>
                                                    </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <?php $con++; ?>
                                            @endif
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <?php
                                                $is = 0;
                                                SumByType($data_e,"$","price") != 0 ? $is++:"";
                                                SumByType($data_e,"TL","price") != 0 ? $is++:"";
                                                SumByType($data_e,"€","price") != 0 ? $is++:"";
                                                SumByType($data_e,"£","price") != 0 ? $is++:"";
                                                ?>
                                                <td class="text-sm font-weight-bold mb-0" colspan="3">Total</td>
                                                @if(SumByType($data_e,"$","price") != 0)
                                                <td class="text-sm font-weight-bold mb-0 incs">{{$usd}}</td>
                                                @endif
                                                @if(SumByType($data_e,"TL","price") != 0)
                                                <td class="text-sm font-weight-bold mb-0 incs">{{$tl}}</td>
                                                @endif
                                                @if(SumByType($data_e,"€","price") != 0)
                                                <td class="text-sm font-weight-bold mb-0 incs">{{$euro}}</td>
                                                @endif
                                                @if(SumByType($data_e,"£","price") != 0)
                                                <td class="text-sm font-weight-bold mb-0 incs">{{$pond}}</td>
                                                @endif
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-12">
                                <div class="sumtions">
                                    <div class="card-body px-0 mb-2">
                                        <?php
                                            $e01=0;
                                            $e02=0;
                                            $e03=0;
                                            $e04=0;
                                            $e1=0;
                                            $e2=0;
                                            $e3=0;
                                            $e4=0;
                                            $i1=0;
                                            $i2=0;
                                            $i3=0;
                                            $i4=0;
                                            $m1=0;
                                            $m2=0;
                                            $m3=0;
                                            $m4=0;

                                            $i1=sumAmountByCurrency($data_e,$year->new_date,"Income", '$');
                                            $i2=sumAmountByCurrency($data_e,$year->new_date,"Income", 'TL');
                                            $i3=sumAmountByCurrency($data_e,$year->new_date,"Income", '€');
                                            $i4=sumAmountByCurrency($data_e,$year->new_date,"Income", '£');

                                            $m1=sumMAmountByCurrency($movement,$year->new_date,"$");
                                            $m2=sumMAmountByCurrency($movement,$year->new_date,"TL");
                                            $m3=sumMAmountByCurrency($movement,$year->new_date,"€");
                                            $m4=sumMAmountByCurrency($movement,$year->new_date,"£");

                                            $c1 = sumMCAmountByCurrency($movement,$year->new_date,"$");
                                            $c2 = sumMCAmountByCurrency($movement,$year->new_date,"TL");
                                            $c3 = sumMCAmountByCurrency($movement,$year->new_date,"€");
                                            $c4 = sumMCAmountByCurrency($movement,$year->new_date,"£");

                                            $e01 = sumMTAmountByCurrency($movement,$year->new_date, '$');
                                            $e02 = sumMTAmountByCurrency($movement,$year->new_date, 'TL');
                                            $e03 = sumMTAmountByCurrency($movement,$year->new_date, '€');
                                            $e04 = sumMTAmountByCurrency($movement,$year->new_date, '£');

                                            $e1 = sumAmountByCurrency($data_e,$year->new_date,"Expenses", '$');
                                            $e2 = sumAmountByCurrency($data_e,$year->new_date,"Expenses", 'TL');
                                            $e3 = sumAmountByCurrency($data_e,$year->new_date,"Expenses", '€');
                                            $e4 = sumAmountByCurrency($data_e,$year->new_date,"Expenses", '£');

                                            $rows= 1;
                                            if($i1 != 0 || $m1 != 0 || $c1 != 0 || $e01 != 0 || $e1 != 0){
                                                $rows ++ ;
                                            }
                                            if($i2 != 0 || $m2 != 0 || $c2 != 0 || $e02 != 0 || $e2 != 0){
                                                $rows ++ ;
                                            }
                                            if($i3 != 0 || $m3 != 0 || $c3 != 0 || $e03 != 0 || $e3 != 0){
                                                $rows ++ ;
                                            }
                                            if($i4 != 0 || $m4 != 0 || $c4 != 0 || $e04 != 0 || $e4 != 0){
                                                $rows ++ ;
                                            }
                                        ?>

                                        <table class="table align-items-center mb-0 th_{{$rows}} nopadhids head_table">
                                            <thead>
                                                <tr class="bg"><th  colspan="10">Entries PROFIT Display</th></tr>
                                            </thead>
                                        </table>
                                        <table class="table align-items-center mb-0 th_{{$rows}} nopadhids">
                                            <thead>
                                                <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                                                    @if($i1 != 0 || $m1 != 0 || $c1 != 0 || $e01 != 0 || $e1 != 0)
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">USD</th>
                                                    @endif
                                                    @if($i2 != 0 || $m2 != 0 || $c2 != 0 || $e02 != 0 || $e2 != 0)
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TURKISH LIRA</th>
                                                    @endif
                                                    @if($i3 != 0 || $m3 != 0 || $c3 != 0 || $e03 != 0 || $e3 != 0)
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">EURO</th>
                                                    @endif
                                                    @if($i4 != 0 || $m4 != 0 || $c4 != 0 || $e04 != 0 || $e4 != 0)
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">POUND</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td> PROFIT Movement </td>
                                                    @if($i1 != 0 || $m1 != 0 || $c1 != 0 || $e01 != 0 || $e1 != 0)
                                                    <td>{{$m1}}</td>
                                                    @endif
                                                    @if($i2 != 0 || $m2 != 0 || $c2 != 0 || $e02 != 0 || $e2 != 0)
                                                    <td>{{$m2}}</td>
                                                    @endif
                                                    @if($i3 != 0 || $m3 != 0 || $c3 != 0 || $e03 != 0 || $e3 != 0)
                                                    <td>{{$m3}}</td>
                                                    @endif
                                                    @if($i4 != 0 || $m4 != 0 || $c4 != 0 || $e04 != 0 || $e4 != 0)
                                                    <td>{{$m4}}</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td> Commetion Movement </td>
                                                    @if($i1 != 0 || $m1 != 0 || $c1 != 0 || $e01 != 0 || $e1 != 0)
                                                    <td>{{$c1}}</td>
                                                    @endif
                                                    @if($i2 != 0 || $m2 != 0 || $c2 != 0 || $e02 != 0 || $e2 != 0)
                                                    <td>{{$c2}}</td>
                                                    @endif
                                                    @if($i3 != 0 || $m3 != 0 || $c3 != 0 || $e03 != 0 || $e3 != 0)
                                                    <td>{{$c3}}</td>
                                                    @endif
                                                    @if($i4 != 0 || $m4 != 0 || $c4 != 0 || $e04 != 0 || $e4 != 0)
                                                    <td>{{$c4}}</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td> Tax Movement</td>
                                                    @if($i1 != 0 || $m1 != 0 || $c1 != 0 || $e01 != 0 || $e1 != 0)
                                                    <td>{{$e01}}</td>
                                                    @endif
                                                    @if($i2 != 0 || $m2 != 0 || $c2 != 0 || $e02 != 0 || $e2 != 0)
                                                    <td>{{$e02}}</td>
                                                    @endif
                                                    @if($i3 != 0 || $m3 != 0 || $c3 != 0 || $e03 != 0 || $e3 != 0)
                                                    <td>{{$e03}}</td>
                                                    @endif
                                                    @if($i4 != 0 || $m4 != 0 || $c4 != 0 || $e04 != 0 || $e4 != 0)
                                                    <td>{{$e04}}</td>
                                                    @endif
                                                </tr>
                                                <tr class="bg2">
                                                    <?php
                                                        $m1 += sumMCAmountByCurrency($movement,$year->new_date,"$");
                                                        $m2 += sumMCAmountByCurrency($movement,$year->new_date,"TL");
                                                        $m3 += sumMCAmountByCurrency($movement,$year->new_date,"€");
                                                        $m4 += sumMCAmountByCurrency($movement,$year->new_date,"£");
                                                    ?>
                                                    <td>Total </td>
                                                    @if($i1 != 0 || $m1 != 0 || $c1 != 0 || $e01 != 0 || $e1 != 0)
                                                    <td>{{$m1+$c1+$e01}}</td>
                                                    @endif
                                                    @if($i2 != 0 || $m2 != 0 || $c2 != 0 || $e02 != 0 || $e2 != 0)
                                                    <td>{{$m2+$c2+$e02}}</td>
                                                    @endif
                                                    @if($i3 != 0 || $m3 != 0 || $c3 != 0 || $e03 != 0 || $e3 != 0)
                                                    <td>{{$m3+$c3+$e03}}</td>
                                                    @endif
                                                    @if($i4 != 0 || $m4 != 0 || $c4 != 0 || $e04 != 0 || $e4 != 0)
                                                    <td>{{$m4+$c4+$e04}}</td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="sumtions">
                                    <div class="card-body px-0 mb-2 pt-0">
                                        <?php
                                            $e01=0;
                                            $e02=0;
                                            $e03=0;
                                            $e04=0;
                                            $e1=0;
                                            $e2=0;
                                            $e3=0;
                                            $e4=0;
                                            $i1=0;
                                            $i2=0;
                                            $i3=0;
                                            $i4=0;
                                            $m1=0;
                                            $m2=0;
                                            $m3=0;
                                            $m4=0;

                                            $i1=sumAmountByCurrency($data_e,$year->new_date,"Income", '$');
                                            $i2=sumAmountByCurrency($data_e,$year->new_date,"Income", 'TL');
                                            $i3=sumAmountByCurrency($data_e,$year->new_date,"Income", '€');
                                            $i4=sumAmountByCurrency($data_e,$year->new_date,"Income", '£');

                                            $m1=sumMAmountByCurrency($movement,$year->new_date,"$");
                                            $m2=sumMAmountByCurrency($movement,$year->new_date,"TL");
                                            $m3=sumMAmountByCurrency($movement,$year->new_date,"€");
                                            $m4=sumMAmountByCurrency($movement,$year->new_date,"£");

                                            $c1 = sumMCAmountByCurrency($movement,$year->new_date,"$");
                                            $c2 = sumMCAmountByCurrency($movement,$year->new_date,"TL");
                                            $c3 = sumMCAmountByCurrency($movement,$year->new_date,"€");
                                            $c4 = sumMCAmountByCurrency($movement,$year->new_date,"£");

                                            $e01 = sumMTAmountByCurrency($movement,$year->new_date, '$');
                                            $e02 = sumMTAmountByCurrency($movement,$year->new_date, 'TL');
                                            $e03 = sumMTAmountByCurrency($movement,$year->new_date, '€');
                                            $e04 = sumMTAmountByCurrency($movement,$year->new_date, '£');

                                            $e1 = sumAmountByCurrency($data_e,$year->new_date,"Expenses", '$');
                                            $e2 = sumAmountByCurrency($data_e,$year->new_date,"Expenses", 'TL');
                                            $e3 = sumAmountByCurrency($data_e,$year->new_date,"Expenses", '€');
                                            $e4 = sumAmountByCurrency($data_e,$year->new_date,"Expenses", '£');

                                            $rows= 1;
                                            if($i1 != 0 || $m1 != 0 || $c1 != 0 || $e01 != 0 || $e1 != 0){
                                                $rows ++ ;
                                            }
                                            if($i2 != 0 || $m2 != 0 || $c2 != 0 || $e02 != 0 || $e2 != 0){
                                                $rows ++ ;
                                            }
                                            if($i3 != 0 || $m3 != 0 || $c3 != 0 || $e03 != 0 || $e3 != 0){
                                                $rows ++ ;
                                            }
                                            if($i4 != 0 || $m4 != 0 || $c4 != 0 || $e04 != 0 || $e4 != 0){
                                                $rows ++ ;
                                            }
                                        ?>

                                        <table class="table align-items-center mb-0 th_{{$rows}} nopadhids head_table">
                                            <thead>
                                                <tr class="bg"><th  colspan="10">Final PRofit</th></tr>
                                                <tr><th  colspan="10">Income - Expenses</th></tr>
                                            </thead>
                                        </table>
                                        <table class="table align-items-center mb-0 th_{{$rows}} nopadhids tsw">
                                            <thead>
                                                <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                                                    @if($i1 != 0 || $m1 != 0 || $c1 != 0 || $e01 != 0 || $e1 != 0)
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">USD</th>
                                                    @endif
                                                    @if($i2 != 0 || $m2 != 0 || $c2 != 0 || $e02 != 0 || $e2 != 0)
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TURKISH LIRA</th>
                                                    @endif
                                                    @if($i3 != 0 || $m3 != 0 || $c3 != 0 || $e03 != 0 || $e3 != 0)
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">EURO</th>
                                                    @endif
                                                    @if($i4 != 0 || $m4 != 0 || $c4 != 0 || $e04 != 0 || $e4 != 0)
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">POUND</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td> Income</td>
                                                    @if($i1 != 0 || $m1 != 0 || $c1 != 0 || $e01 != 0 || $e1 != 0)
                                                    <td>{{$i1}}</td>
                                                    @endif
                                                    @if($i2 != 0 || $m2 != 0 || $c2 != 0 || $e02 != 0 || $e2 != 0)
                                                    <td>{{$i2}}</td>
                                                    @endif
                                                    @if($i3 != 0 || $m3 != 0 || $c3 != 0 || $e03 != 0 || $e3 != 0)
                                                    <td>{{$i3}}</td>
                                                    @endif
                                                    @if($i4 != 0 || $m4 != 0 || $c4 != 0 || $e04 != 0 || $e4 != 0)
                                                    <td>{{$i4}}</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td> Expenses</td>
                                                    @if($i1 != 0 || $m1 != 0 || $c1 != 0 || $e01 != 0 || $e1 != 0)
                                                    <td>{{$e1}}</td>
                                                    @endif
                                                    @if($i2 != 0 || $m2 != 0 || $c2 != 0 || $e02 != 0 || $e2 != 0)
                                                    <td>{{$e2}}</td>
                                                    @endif
                                                    @if($i3 != 0 || $m3 != 0 || $c3 != 0 || $e03 != 0 || $e3 != 0)
                                                    <td>{{$e3}}</td>
                                                    @endif
                                                    @if($i4 != 0 || $m4 != 0 || $c4 != 0 || $e04 != 0 || $e4 != 0)
                                                    <td>{{$e4}}</td>
                                                    @endif
                                                </tr>
                                                <tr class="bg2 tr_last">
                                                    <?php
                                                        $m1 += sumMCAmountByCurrency($movement,$year->new_date,"$");
                                                        $m2 += sumMCAmountByCurrency($movement,$year->new_date,"TL");
                                                        $m3 += sumMCAmountByCurrency($movement,$year->new_date,"€");
                                                        $m4 += sumMCAmountByCurrency($movement,$year->new_date,"£");
                                                    ?>
                                                    <td>Total </td>
                                                    @if($i1 != 0 || $m1 != 0 || $c1 != 0 || $e01 != 0 || $e1 != 0)
                                                    <td>{{$i1-$e1}}</td>
                                                    @endif
                                                    @if($i2 != 0 || $m2 != 0 || $c2 != 0 || $e02 != 0 || $e2 != 0)
                                                    <td>{{$i2-$e2}}</td>
                                                    @endif
                                                    @if($i3 != 0 || $m3 != 0 || $c3 != 0 || $e03 != 0 || $e3 != 0)
                                                    <td>{{$i3-$e3}}</td>
                                                    @endif
                                                    @if($i4 != 0 || $m4 != 0 || $c4 != 0 || $e04 != 0 || $e4 != 0)
                                                    <td>{{$i4-$e4}}</td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

  @section('panel_js')
    <script>
        $( document ).ready(function() {
            $(".showaccout").click(function(){
                if($(this).find("i").hasClass("fa-plus")){
                    $(this).find("i").attr("class","fa fa-minus");
                }else{
                    $(this).find("i").attr("class","fa fa-plus");
                }
                $(".hideAccount").toggleClass("active");
            });
            var len = $(".tsw").length;
            if(len >= 1){
                $(".tsw")[0].scrollIntoView();
            }else if($(".tsw").find(".tr_last").length >= 1){
                $( ".tr_last" )[0].scrollIntoView();
            }
        });
    </script>
  @endsection
@stop
