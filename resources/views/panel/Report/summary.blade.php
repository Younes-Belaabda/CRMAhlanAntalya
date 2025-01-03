@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','Summary')
@section('content')
    @push('panel_css')
    @endpush
    <?php

        function Sums($collection,$data, $type ,$currency)
        {
            $start_ = date("Y-m",strtotime($data))."-01";
            $end_ = date("Y-m",strtotime($data))."-31";
            $das = $collection->where("status",1);
            $das = $das->whereBetween("date" , [$start_,$end_]);
            if($type == "commission"){
                $das = $das->where('commission_type', $currency)->sum($type);
            }else{
                $das = $das->where('price_type', $currency)->sum($type);
            }
            return  $das;
        }
        function Counts($collection,$data)
        {
            $start_ = date("Y-m",strtotime($data))."-01";
            $end_ = date("Y-m",strtotime($data))."-31";
            $das = $collection->where("status",1);
            $das = $das->whereBetween("date" , [$start_,$end_]);
            $das = $das->count();
            return  $das;
        }
        function CountsType($collection,$type,$data)
        {
            $start_ = date("Y-m",strtotime($data))."-01";
            $end_ = date("Y-m",strtotime($data))."-31";
            $das = $collection->where("status",1);
            $das = $das->whereBetween("date" , [$start_,$end_]);
            $das = $das->wherehas("users" , function (Builder $query) use($type){
                $query->where("type" , $type->type);
            });
            $das = $das->count();
            return  $das;
        }
    ?>
    <div class="row">
        <div class="col-12"  style="position:relative;">
            <div class="card mb-4 mx-4 pb-2"   style="position: sticky;right: 0;left: 17%;z-index: 3;top: 4px;">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1 show_accro">Summary</h5>
                        </div>
                        <div>
                            <?php
                            $url = Route('panel.report.summary')."?";
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
                                <li><a href="{{$url.'&from_date='.$year.'-01-01&to_date='.$year.'-01-31'}}" class='{{ $now == 1 ? "selected" : "" }}'>01</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-02-01&to_date='.$year.'-02-31'}}" class='{{ $now == 2 ? "selected" : "" }}'>02</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-03-01&to_date='.$year.'-03-31'}}" class='{{ $now == 3 ? "selected" : "" }}'>03</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-04-01&to_date='.$year.'-04-31'}}" class='{{ $now == 4 ? "selected" : "" }}'>04</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-05-01&to_date='.$year.'-05-31'}}" class='{{ $now == 5 ? "selected" : "" }}'>05</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-06-01&to_date='.$year.'-06-31'}}" class='{{ $now == 6 ? "selected" : "" }}'>06</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-07-01&to_date='.$year.'-07-31'}}" class='{{ $now == 7 ? "selected" : "" }}'>07</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-08-01&to_date='.$year.'-08-31'}}" class='{{ $now == 8 ? "selected" : "" }}'>08</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-09-01&to_date='.$year.'-09-31'}}" class='{{ $now == 9 ? "selected" : "" }}'>09</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-10-01&to_date='.$year.'-10-31'}}" class='{{ $now == 10 ? "selected" : "" }}'>10</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-11-01&to_date='.$year.'-11-31'}}" class='{{ $now == 11 ? "selected" : "" }}'>11</a></li>
                                <li><a href="{{$url.'&from_date='.$year.'-12-01&to_date='.$year.'-12-31'}}" class='{{ $now == 12 ? "selected" : "" }}'>12</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pt-0 pb-2 mb-0 hide_accro">
                    <form action="{{ Route('panel.report.summary') }}" method="Get" role="form text-left">
                        @csrf
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="d_user" class="form-control-label">{{ __('User') }}</label>
                                    <div class="@error('d_user') border border-danger rounded-3 @enderror">
                                        <select name="d_user" class="select form-control" id="d_user">
                                        <option value="">Choose</option>
                                            @foreach($users as $key => $row)
                                                <option value="{{$row->id}}" {{ isset($request["d_user"]) && $request["d_user"] == $row->id ? 'selected' : '' }}>{{$row->full_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="type" class="form-control-label">{{ __('Type') }}</label>
                                    <div class="@error('type') border border-danger rounded-3 @enderror">
                                        <select name="type" class="select form-control" id="type">
                                        <option value="">Choose</option>
                                        <option value="1" {{ isset($request["type"]) && $request["type"] == "1" ? 'selected' : '' }}>Admin</option>
                                        <option value="2" {{ isset($request["type"]) && $request["type"] == "2" ? 'selected' : '' }}>Driver</option>
                                        <option value="3" {{ isset($request["type"]) && $request["type"] == "3" ? 'selected' : '' }}>Agent</option>
                                        <option value="4" {{ isset($request["type"]) && $request["type"] == "4" ? 'selected' : '' }}>Vendor</option>
                                        <option value="5" {{ isset($request["type"]) && $request["type"] == "5" ? 'selected' : '' }}>Partner</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="from_date" class="form-control-label">{{ __('From Date') }}</label>
                                    <div class="@error('from_date') border border-danger rounded-3 @enderror">
                                        <input class="form-control datepicker" name="from_date" value='{{ @$request["from_date"] }}'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="to_date" class="form-control-label">{{ __('To Date') }}</label>
                                    <div class="@error('to_date') border border-danger rounded-3 @enderror">
                                        <input class="form-control datepicker" name="to_date" value='{{ @$request["to_date"] }}'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="m_type" class="form-control-label">{{ __('Movement Type') }}</label>
                                    <div class="@error('m_type') border border-danger rounded-3 @enderror">
                                        <select name="m_type" class="select form-control" id="m_type">
                                        <option value="">Choose</option>
                                        <option value="Airport Pickup & Transfers" {{ isset($request["m_type"]) && $request["m_type"] == "Transfers" ? 'selected' : '' }}>Transfers</option>
                                        <option value="Driver Tours" {{isset($request["m_type"]) && $request["m_type"] == "Driver Tours" ? 'selected' : '' }}>Driver Tours</option>
                                        <option value="Group Tours" {{isset($request["m_type"]) && $request["m_type"] == "Group Tours" ? 'selected' : '' }}>Group Tours</option>
                                        <option value="Hotels/Apart-hotels" {{ isset($request["m_type"]) && $request["m_type"] == "Hotels" ? 'selected' : '' }}>Hotels</option>
                                        <option value="Other Services" {{ isset($request["m_type"]) && $request["m_type"] == "Other Services" ? 'selected' : '' }}>Other Services</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="country_id" class="form-control-label">{{ __('country') }}</label>
                                    <div class="@error('country_id') border border-danger rounded-3 @enderror">
                                        <select name="country_id" class="select form-control" id="country_id">
                                        <option value="">Choose</option>
                                        @foreach($countries as $key => $row)
                                            <option value="{{$row->countries_id}}" {{ isset($request["country_id"]) && $request["country_id"] == $row->countries_id ? "selected" : ""}}>{{$row->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn bg-gradient-dark btn-md mt-2 mb-2">{{ 'Go Filter' }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1">Summary Report</h5>
                        </div>
                        <div>
                            <?php
                            $url = Route('panel.report.summary')."?";
                            if(isset($request["d_user"]) && $request["d_user"]){
                                $url .="&d_user=".$request["d_user"];
                            }

                            if(isset($request["m_type"]) && $request["m_type"]){
                                $url .="&m_type=".$request["m_type"];
                            }

                            if(isset($request["from_date"]) && $request["from_date"]){
                                $url .="&from_date=".$request["from_date"];
                            }

                            if(isset($request["to_date"]) && $request["to_date"]){
                                $url .="&to_date=".$request["to_date"];
                            }

                            if(isset($request["country_id"]) && $request["country_id"]){
                                $url .="&country_id=".$request["country_id"];
                            }

                            ?>
                            <ul class="munths">
                                @foreach($user_type as $keys=>$ut)
                                @if($ut != "Admin")
                                <li><a href="{{$url.'&type='.($keys+1)}}" class='{{ @$request["type"] == $keys+1 ? "selected" : "" }}'>{{$ut}}</a></li>
                                @endif
                                @endforeach
                            </ul>
                            <a class="btn bg-gradient-dark btn-sm mb-2 export_pdf" type="button">Export PDF</a>
                        </div>
                    </div>
                </div>

                <div id="exp_pdf" class="card-body px-2 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        @foreach($data_u as $type)
                            <?php
                                $show = false;
                                foreach($data_up as $key => $d_user){
                                    if($d_user->type == $type->type && Counts($d_user->movements ,$date) != 0){
                                        $show = true;
                                    }
                                }
                            ?>
                            <?php $con = 1; ?>
                            @if($show)
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr class="bg">
                                        <th colspan="10">
                                                {{ $type->Typename }}
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                            <table class="table align-items-center mb-2">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:20%">
                                            User
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:20%">
                                            Total Bookings
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:15%">
                                            Currency
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Total Net
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Total Profit
                                        </th>
                                        <?php $com=0; ?>
                                        @foreach($data_up as $key => $d_user)
                                            @if($d_user->type == $type->type && Counts($d_user->movements ,$date) != 0)
                                                @foreach($currancy as $i_cur)
                                                    <?php
                                                        $com += Sums($d_user->movements ,$date, "commission" , $i_cur);
                                                    ?>
                                                @endforeach
                                            @endif
                                        @endforeach
                                        <?php $coms = $com > 0 ? true : false;?>
                                        @if($coms)
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Total Commission
                                            </th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data_up as $key => $d_user)
                                        @if($d_user->type == $type->type && Counts($d_user->movements ,$date) != 0)
                                            <tr>
                                                <?php
                                                    $sizeo = sizeof($currancy)+1;
                                                ?>
                                                @foreach($currancy as $i_cur)
                                                    <?php
                                                        $net = Sums($d_user->movements ,$date, "net" , $i_cur);
                                                        $profit = Sums($d_user->movements ,$date, "revenue" , $i_cur);
                                                        $com = Sums($d_user->movements ,$date, "commission" , $i_cur);
                                                        if($net == 0 && $profit == 0 && $com == 0){
                                                            $sizeo -= 1;
                                                        }
                                                    ?>
                                                @endforeach
                                                <td rowspan="{{$sizeo}}" class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $con }}</p>
                                                </td>
                                                <td class="user" rowspan="{{$sizeo}}" style="background:{{@$d_user->background}};color:{{@$d_user->color}}">
                                                    <a class="text-xs font-weight-bold mb-0" target="_blank" style="background:{{@$d_user->background}};color:{{@$d_user->color}}" href="{{ url('/admin/entries?d_user='.$d_user->id)}}">{{ @$d_user->full_name }}</a>
                                                </td>
                                                <td class="text-center"  rowspan="{{$sizeo}}">
                                                    <p class="text-xs font-weight-bold mb-0">{{  Counts($d_user->movements ,$date) }}</p>
                                                </td>
                                            </tr>
                                            @foreach($currancy as $i_cur)
                                                <?php
                                                    $net = Sums($d_user->movements ,$date, "net" , $i_cur);
                                                    $profit = Sums($d_user->movements ,$date, "revenue" , $i_cur);
                                                    $com = Sums($d_user->movements ,$date, "commission" , $i_cur);
                                                ?>
                                                @if($net == 0 && $profit == 0 && $com == 0)
                                                @else
                                                    <tr>
                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0" style="color: #333;">{{ $i_cur }}</p>
                                                        </td>
                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">{{ $net }}</p>
                                                        </td>
                                                        <td class="text-center">
                                                            <p class="text-xs font-weight-bold mb-0">{{ $profit }}</p>
                                                        </td>
                                                        @if($coms)
                                                            <td class="text-center">
                                                                <p class="text-xs font-weight-bold mb-0">{{ $com }}</p>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endif
                                            @endforeach
                                            <?php $con++; ?>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
  @push('panel_js')

  @endpush
@stop
