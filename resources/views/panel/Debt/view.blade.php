@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','View Debt')
@section('content')
    @push('panel_css')
    @endpush
    <?php 
        
        function sumAmountByCurrencyDept($collection,$user,$date, $currency)
        {
            if($date == null){
                return $collection->where('price_type', $currency)->where("for_id",$user)->sum('price');
            }
            return $collection->where('price_type', $currency)->where("for_id",$user)->where("new_date",$date)->sum('price');
        }
    ?>
    <div class="row">
        <div class="col-12" style="position:relative;">
            <div class="card mb-4 mx-4 pb-2" style="position: sticky;right: 0;left: 17%;z-index: 3;top: 4px;">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1 show_accro">Filter Debt</h5>
                        </div>
                        <div>
                            <?php 
                            $url = Route('panel.debt.view')."?";
                            if(isset($request["d_user"]) && $request["d_user"]){
                                $url .="&d_user=".$request["d_user"];
                            }
                            
                            if(isset($request["type"]) && $request["type"]){
                                $url .="&type=".$request["type"];
                            }
                            
                            if(isset($request["m_user"]) && $request["m_user"]){
                                $url .="&m_user=".$request["m_user"];
                            }
                            if(isset($request["m_type"]) && $request["m_type"]){
                                $url .="&m_type=".$request["m_type"];
                            }
                            if(isset($request["for_id"]) && $request["for_id"]){
                                $url .="&for_id=".$request["for_id"];
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
                        <a class="btn bg-gradient-dark btn-sm mb-2 export_pdf" type="button">Export PDF</a>

                        <a href="{{ route('panel.debt.add_new') }}" class="btn bg-gradient-dark btn-sm mb-2" type="button">+&nbsp; New Debt</a>
                        </div>
                        </div>
                </div>
                <div class="card-body px-4 pt-0 pb-2 mb-0 hide_accro">
                    <form action="{{ Route('panel.debt.view') }}" method="Get" role="form text-left">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="from_date" class="form-control-label">{{ __('From Date') }}</label>
                                    <div class="@error('from_date') border border-danger rounded-3 @enderror">
                                        <input class="form-control datepicker" name="from_date" value="{{@$request['from_date']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="to_date" class="form-control-label">{{ __('To Date') }}</label>
                                    <div class="@error('to_date') border border-danger rounded-3 @enderror">
                                        <input class="form-control datepicker" name="to_date" value="{{@$request['to_date']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="for_id" class="form-control-label">{{ __('Accounts') }}</label>
                                    <div class="@error('for_id') border border-danger rounded-3 @enderror">
                                        <select name="for_id" class="select form-control" id="for_id">
                                        <option value="">Choose</option>
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
            <div class="card mb-4 mx-4">
                <div class="card-header pb-2">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <?php
                                $t1 = sumAmountByCurrencyDept($all_date , $request["for_id"],null, '$');
                                $t2 = sumAmountByCurrencyDept($all_date , $request["for_id"],null, 'TL');
                                $t3 = sumAmountByCurrencyDept($all_date , $request["for_id"],null, '€');
                            ?>
                            <h5 class="mb-1">All Debt{{ $t1 != 0 || $t2 != 0 || $t3 != 0 ? ":" : ""}}
                            
                            {{ $t1 == null || $t1 == 0 ? "" : " $ ".$t1}}
                            {{ $t2 == null || $t2 == 0 ? "" : "& TL ".$t2}}
                            {{ $t3 == null || $t3 == 0 ? "" : "& € ".$t3}} 
                            </h5>
                        </div>
                        
                        <div>
                            <?php 
                            $url = Route('panel.debt.view')."?";
                            if(isset($request["from_date"]) && $request["from_date"]){
                                $url .="&from_date=".$request["from_date"];
                            }
                            
                            if(isset($request["to_date"]) && $request["to_date"]){
                                $url .="&to_date=".$request["to_date"];
                            }
                            
                            if(isset($request["for_id"]) && $request["for_id"]){
                                $url .="&for_id=".$request["for_id"];
                            }
                            
                            ?>
                            <ul class="munths">
                                @foreach($users_admin as $uadmin)
                                @if($uadmin->id == 5 || $uadmin->id == 3 || $uadmin->id == 4)
                                <li><a href="{{$url.'&for_id='.$uadmin->id}}" class='{{ $uadmin->id == @$request["for_id"] ? "selected" : "" }}'>{{$uadmin->full_name}}</a></li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="exp_pdf" class="card-body px-2 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        @foreach($data_year as $year)
                        @foreach($data_g as $g)
                        @if($g->new_date == $year->new_date)
                        
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr class="bg">
                                    <th colspan="10">
                                        {{$year->new_date}}
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <table class="table align-items-center mb-2 nopadhid">
                            <thead>
                                <tr>
                                    <!--<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:30px;">-->
                                    <!--    ID-->
                                    <!--</th>-->
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:25%;">
                                        Date
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" style="width:25%;">
                                        Amount
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:25%;">
                                        Note
                                    </th>
                                    <th class="last-child text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:25%;">
                                        Action
                                    </th>
                                    <!--<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">-->
                                    <!--    Admin-->
                                    <!--</th>-->
                                    <!-- <th class="last-child text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $con=1; ?>
                              @foreach($data as $key => $row)
                              @if($row->for_id == $g->for_id && $row->new_date == $year->new_date)
                                <tr>
                                    <!--<td>-->
                                    <!--    <p class="text-xs font-weight-bold mb-0">{{ $con }}</p>-->
                                    <!--</td>-->
                                    <td class="user">
                                        <p class="text-xs font-weight-bold mb-0" style="background:{{@$row->m_user->background}};color:{{@$row->m_user->color}} !important">{{  date("d M", strtotime($row->date)) }}</p>
                                    </td>
                                    <td class="user">
                                        <p class="text-xs font-weight-bold mb-0" >{{ $row->price_type." ".$row->price }}</p>
                                    </td>
                                    <td class="user">
                                        <p class="text-xs font-weight-bold mb-0" >{{ $row->note }}</p>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('panel.debt.add_new' , $row->debt_id) }}" class="mx-1" target="_blank" data-bs-toggle="tooltip"
                                            data-bs-original-title="Edit debt">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <a data-url="{{ route('panel.debt.delete' , $row->debt_id) }}" class="mx-1 delete" data-bs-toggle="tooltip"
                                            data-bs-original-title="Delete debt">
                                            <i class="cursor-pointer fas fa-trash text-danger"></i>
                                        </a>
                                    </td>
                                    <!--<td class="user">-->
                                    <!--    <a class="text-xs font-weight-bold mb-0" style="background:{{@$row->m_user->background}};color:{{@$row->m_user->color}}" href="{{ url('/admin/movement?d_user='.$row->m_user->id)}}">{{ @$row->m_user->full_name }}</a>-->
                                    <!--</td>-->
                                    <!-- <td class="text-center">
                                        <div class="form-check form-switch ps-0 check_center">
                                            <input class="form-check-input ms-auto is-displayed"
                                              data-url="{{ route('panel.debt.change_status' , $row->debt_id) }}"
                                              type="checkbox" id="flexSwitchCheckDefault"
                                              {{ $row->status == 1 ? 'checked' : ''}}>
                                        </div>
                                    </td> -->
                                </tr>
                                <?php $con++; ?>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="sumtions">
                            <table class="table align-items-center mt-4">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:25%;">CURRENCY</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:25%;">USD</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:25%;">TURKISH LIRA</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:25%;">EURO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg2">
                                        <td class="text-xsm font-weight-bold mb-0">sum</td>
                                        <td class="text-xsm font-weight-bold mb-0">{{ sumAmountByCurrencyDept($data , $g->for_id ,$year->new_date, '$')}}</td>
                                        <td class="text-xsm font-weight-bold mb-0">{{ sumAmountByCurrencyDept($data , $g->for_id,$year->new_date, 'TL')}}</td>
                                        <td class="text-xsm font-weight-bold mb-0">{{ sumAmountByCurrencyDept($data , $g->for_id,$year->new_date, '€')}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @endif
                        @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
  @push('panel_js')

  @endpush
@stop
