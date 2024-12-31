@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','View Data User')
@section('content')
    @push('panel_css')
    @endpush
    
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
                    function sumAmountByCurrencyInc($collection,$year, $currency)
                    {
                        if($year == null){
                            return $collection->where('price_type', $currency)->whereNull("movement_id")->sum('price');
                        }
                        return  $collection->where('price_type', $currency)->where("new_date",$year)->whereNull("movement_id")->sum('price');
                    }
                ?>
                
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                         <h6 class="mb-0">{{ __('User Balance') . " - " }} <a  target="_blank" href="{{ url('admin/entries?d_user='.$user->id) }}" >{{@$user->full_name}}</a> $ {{@$user->blance}}</h6>
                    </div>
                    <div>
                            <?php 
                            $url = Route('panel.users.add_balance',$id)."?";
                            
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
                        <a href="{{ route('panel.cash.add_new') }}" class="btn bg-gradient-dark btn-sm mb-2" type="button">+&nbsp; New cash</a>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <div class="table-responsive p-0">
                    
                    @foreach($moves_data_year as $year)
                    @foreach($state as $st)
                    <table class="table align-items-center mb-4">
                        <thead>
                            <tr class="bg">
                                <th colspan="10"> {{ $st == 0 ? "UnPaid" : "Paid" }} {{ $year->new_date }}</th>
                            </tr>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    ID
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:15%">
                                    Date
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:55%">
                                    customer
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:15%">
                                    Ammount
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:15%">
                                    Admin
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $con = 1; ?>
                            @foreach($moves_data as $key => $row)
                            @if($row->new_date == $year->new_date && $st == $row->sender_paid && $row->paybyus == 1)
                            <tr>
                                <td class="ps-4">
                                    <p class="text-xs font-weight-bold mb-0">{{ $con }}</p>
                                </td>
                                <td class="ps-4">
                                    <p class="text-xs font-weight-bold mb-0">{{  date("d M", strtotime($row->date)) }}</p>
                                </td>
                                <td class="ps-4">
                                    <a class="text-xs font-weight-bold mb-0" href="{{ url('/admin/entries/add',$row->movement_id) }}">{{  $row->customer }}</a>
                                </td>
                                <td class="ps-4">
                                    <p class="text-xs font-weight-bold mb-0">{{  $row->price_type . " " .$row->price }}</p>
                                </td>
                                <td class="ps-4">
                                    <p class="text-xs font-weight-bold mb-0">{{  $row->m_user->full_name }}</p>
                                </td>
                            </tr>
                            <?php $con++; ?>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    @endforeach
                    <table class="table align-items-center mb-4">
                        <thead>
                            <tr class="bg">
                                <th colspan="10">Transfer {{ $year->new_date }}</th>
                            </tr>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    ID
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:15%">
                                    Date
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:55%">
                                    Ammount
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:15%">
                                    Admin
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:15%">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $con = 1; ?>
                            @foreach($data_e as $key => $row)
                            @if($row->new_date == $year->new_date && $row->movement_id == null)
                            <tr>
                                <td class="ps-4">
                                    <p class="text-xs font-weight-bold mb-0">{{ $con }}</p>
                                </td>
                                <td class="ps-4">
                                    <p class="text-xs font-weight-bold mb-0">{{  date("d M", strtotime($row->date)) }}</p>
                                </td>
                                <td class="ps-4">
                                    <p class="text-xs font-weight-bold mb-0">{{  $row->price_type . " " .$row->price }}</p>
                                </td>
                                <td class="ps-4">
                                    <p class="text-xs font-weight-bold mb-0">{{  $row->m_user->full_name }}</p>
                                </td>
                                
                                <td class="text-center">
                                    <a href="{{ route('panel.cash.add_new' , $row->income_id) }}" target="_blank" class="mx-1" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit cash">
                                        <i class="fas fa-user-edit text-secondary"></i>
                                    </a>
                                    <a data-url="{{ route('panel.cash.delete' , $row->income_id) }}" class="mx-1 delete" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete cash">
                                        <i class="cursor-pointer fas fa-trash text-danger"></i>
                                    </a>
                                </td>             
                                <!--<td class="text-center">-->
                                <!--    <a data-url="{{ route('panel.users.balance_delete' , $row->income_id ) }}" class="mx-3 delete" data-bs-toggle="tooltip"-->
                                <!--        data-bs-original-title="Delete Balance">-->
                                <!--        <i class="cursor-pointer fas fa-trash text-danger"></i>-->
                                <!--    </a>-->
                                <!--</td>-->
                            </tr>
                            <?php $con++; ?>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    <!--<div class="sumtions">-->
                    <!--    <table class="table align-items-center mt-4">-->
                    <!--        <thead>-->
                    <!--            <tr>-->
                    <!--                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 17%;">Total</th>-->
                    <!--                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">USD</th>-->
                                    <!--<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TURKISH LIRA</th>-->
                                    <!--<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">EURO</th>-->
                                    <!--<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">POUND</th>-->
                    <!--            </tr>-->
                    <!--        </thead>-->
                    <!--        <tbody>-->
                    <!--            <tr>-->
                    <!--                <td class="text-xs font-weight-bold mb-0">UnPaid</td>-->
                    <!--                <td class="text-xs font-weight-bold mb-0">{{ $_1_1 += sumAmountByCurrencyMove($moves_data ,$year->new_date,0, '$')}}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_1_2 += sumAmountByCurrencyMove($moves_data ,$year->new_date,0, 'TL')}}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_1_3 += sumAmountByCurrencyMove($moves_data ,$year->new_date,0, '€')}}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_1_4 += sumAmountByCurrencyMove($moves_data ,$year->new_date,0, '£')}}</td>-->
                    <!--            </tr>-->
                    <!--            <tr>-->
                    <!--                <td class="text-xs font-weight-bold mb-0">Paid</td>-->
                    <!--                <td class="text-xs font-weight-bold mb-0">{{ $_2_1 += sumAmountByCurrencyMove($moves_data ,$year->new_date,1, '$')}}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_2_2 += sumAmountByCurrencyMove($moves_data ,$year->new_date,1, 'TL')}}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_2_3 += sumAmountByCurrencyMove($moves_data ,$year->new_date,1, '€')}}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_2_4 += sumAmountByCurrencyMove($moves_data ,$year->new_date,1, '£')}}</td>-->
                    <!--            </tr>-->
                    <!--            <tr>-->
                    <!--                <td class="text-xs font-weight-bold mb-0">Transfer</td>-->
                    <!--                <td class="text-xs font-weight-bold mb-0">{{ $_3_1 += sumAmountByCurrencyInc($data_e ,$year->new_date, '$')}}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_3_2 += sumAmountByCurrencyInc($data_e ,$year->new_date, 'TL')}}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_3_3 += sumAmountByCurrencyInc($data_e ,$year->new_date, '€')}}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_3_4 += sumAmountByCurrencyInc($data_e ,$year->new_date, '£')}}</td>-->
                    <!--            </tr>-->
                    <!--            <tr class="bg2">-->
                    <!--                <td class="text-xs font-weight-bold mb-0">Sum</td>-->
                    <!--                <td class="text-xs font-weight-bold mb-0">{{ $_3_1 - ($_1_1 + $_2_1) }}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_3_2 - ($_1_2 + $_2_2) }}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_3_3 - ($_1_3 + $_2_3) }}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_3_4 - ($_1_4 + $_2_4) }}</td>-->
                    <!--            </tr>-->
                    <!--        </tbody>-->
                    <!--    </table>-->
                    <!--</div>-->
                    @endforeach
                    
                    
                    @foreach($data_y as $year)
                    @if($moves_data_year->where('new_date', $year->new_date)->count() == 0)
                    <table class="table align-items-center mb-2">
                        <thead>
                            <tr class="bg">
                                <th colspan="10">Transfer {{ $year->new_date }}</th>
                            </tr>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    ID
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:15%">
                                    Date
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:55%">
                                    Ammount
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:15%">
                                    Admin
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:15%">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $con = 1; ?>
                            @foreach($data_e as $key => $row)
                            @if($row->new_date == $year->new_date && $row->movement_id == null)
                            <tr>
                                <td class="ps-4">
                                    <p class="text-xs font-weight-bold mb-0">{{ $con }}</p>
                                </td>
                                <td class="ps-4">
                                    <p class="text-xs font-weight-bold mb-0">{{  date("d M", strtotime($row->date)) }}</p>
                                </td>
                                <td class="ps-4">
                                    <p class="text-xs font-weight-bold mb-0">{{  $row->price_type . " " .$row->price }}</p>
                                </td>
                                <td class="ps-4">
                                    <p class="text-xs font-weight-bold mb-0">{{  $row->m_user->full_name }}</p>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('panel.cash.add_new' , $row->income_id) }}" target="_blank" class="mx-1" data-bs-toggle="tooltip"
                                        data-bs-original-title="Edit cash">
                                        <i class="fas fa-user-edit text-secondary"></i>
                                    </a>
                                    <a data-url="{{ route('panel.cash.delete' , $row->income_id) }}" class="mx-1 delete" data-bs-toggle="tooltip"
                                        data-bs-original-title="Delete cash">
                                        <i class="cursor-pointer fas fa-trash text-danger"></i>
                                    </a>
                                </td> 
                                <!--<td class="text-center">-->
                                <!--    <a data-url="{{ route('panel.users.balance_delete' , $row->income_id ) }}" class="mx-3 delete" data-bs-toggle="tooltip"-->
                                <!--        data-bs-original-title="Delete Balance">-->
                                <!--        <i class="cursor-pointer fas fa-trash text-danger"></i>-->
                                <!--    </a>-->
                                <!--</td>-->
                            </tr>
                            <?php $con++; ?>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    @endforeach
                    <div class="sumtions">
                        <table class="table align-items-center mt-4">
                            <thead>
                                <tr class="bg">
                                    <th  colspan="10">Total</th>
                                </tr>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 17%;">Total</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">USD</th>
                                    <!--<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TURKISH LIRA</th>-->
                                    <!--<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">EURO</th>-->
                                    <!--<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">POUND</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-xs font-weight-bold mb-0">UnPaid</td>
                                    <td class="text-xs font-weight-bold mb-0">{{ $_1_1 = sumAmountByCurrencyMove($moves_data ,null,0, '$')}}</td>
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_1_2 = sumAmountByCurrencyMove($moves_data ,null,0, 'TL')}}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_1_3 = sumAmountByCurrencyMove($moves_data ,null,0, '€')}}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_1_4 = sumAmountByCurrencyMove($moves_data ,null,0, '£')}}</td>-->
                                </tr>
                                <tr>
                                    <td class="text-xs font-weight-bold mb-0">Paid</td>
                                    <td class="text-xs font-weight-bold mb-0">{{ $_2_1 = sumAmountByCurrencyMove($moves_data ,null,1, '$')}}</td>
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_2_2 = sumAmountByCurrencyMove($moves_data ,null,1, 'TL')}}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_2_3 = sumAmountByCurrencyMove($moves_data ,null,1, '€')}}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_2_4 = sumAmountByCurrencyMove($moves_data ,null,1, '£')}}</td>-->
                                </tr>
                                <tr>
                                    <td class="text-xs font-weight-bold mb-0">Profit</td>
                                    <td class="text-xs font-weight-bold mb-0">{{ $_4_1 = sumAmountByCurrencyMove($moves_data ,"revenue_partner", 0, '$')}}</td>
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_3_2 = sumAmountByCurrencyMove($data_e ,"revenue_partner", 0, 'TL')}}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_3_3 = sumAmountByCurrencyMove($data_e ,"revenue_partner", 0, '€')}}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_3_4 = sumAmountByCurrencyMove($data_e ,"revenue_partner", 0, '£')}}</td>-->
                                </tr>
                                <tr>
                                    <td class="text-xs font-weight-bold mb-0">Transfer</td>
                                    <td class="text-xs font-weight-bold mb-0">{{ $_3_1 = sumAmountByCurrencyInc($data_e ,null, '$')}}</td>
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_3_2 = sumAmountByCurrencyInc($data_e ,null, 'TL')}}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_3_3 = sumAmountByCurrencyInc($data_e ,null, '€')}}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_3_4 = sumAmountByCurrencyInc($data_e ,null, '£')}}</td>-->
                                </tr>
                                <tr class="bg2">
                                    <td class="text-xs font-weight-bold mb-0">Sum</td>
                                    <td class="text-xs font-weight-bold mb-0">{{ ($_3_1+$_4_1) - ($_1_1 + $_2_1) }}</td>
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_3_2 - ($_1_2 + $_2_2) }}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_3_3 - ($_1_3 + $_2_3) }}</td>-->
                                    <!--<td class="text-xs font-weight-bold mb-0">{{ $_3_4 - ($_1_4 + $_2_4) }}</td>-->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  @push('panel_js')

  @endpush
@stop
