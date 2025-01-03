@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','View Payments')
@section('content')
    @push('panel_css')
    @endpush
    <style>

table.table tbody td p.datecolor{
    color:red !important;
}
        .actable td, .actable td p {
    padding: 8px !important;
}
.actable th:first-child, .actable td:first-child {
    width: 5% !important;
}
.actable th, .actable td {
    width: 15% !important;
}
    </style>
    <div class="row">
        <div class="col-12"  style="position:relative;">
            <div class="card mb-4 mx-4 pb-2"  style="position: sticky;right: 0;left: 17%;z-index: 3;top: 4px;">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1 show_accro">Filter 01 Jan

</h5>
                        </div>
                        <div>
                            <?php
                            $url = Route('panel.payments.view')."?";
                            if(isset($request["name"]) && $request["name"]){
                                $url .="&name=".$request["name"];
                            }

                            if(isset($request["amount"]) && $request["amount"]){
                                $url .="&amount=".$request["amount"];
                            }

                            if(isset($request["date"]) && $request["date"]){
                                $url .="&date=".$request["date"];
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
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pt-0 pb-2 mb-0 hide_accro">
                    <form action="{{ Route('panel.payments.view') }}" method="Get" role="form text-left">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">{{ __('Name') }}</label>
                                    <div class="@error('name') border border-danger rounded-3 @enderror">
                                        <input class="form-control" name="name" value="{{@$request['name']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label for="from_date" class="form-control-label">{{ __('From Date') }}</label>
                                    <div class="@error('from_date') border border-danger rounded-3 @enderror">
                                        <input class="form-control datepicker" autocomplete="off" name="from_date" value='{{ @$request["from_date"] }}'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group">
                                    <label for="to_date" class="form-control-label">{{ __('To Date') }}</label>
                                    <div class="@error('to_date') border border-danger rounded-3 @enderror">
                                        <input class="form-control datepicker" autocomplete="off" name="to_date" value='{{ @$request["to_date"] }}'>
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
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1">All Payments</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-2 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        @if(sizeof($data) > 0)
                        <table class="table align-items-center mb-0 actable nopadhid">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="last-child text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:40%">
                                        Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" style="width:150px">
                                        Amount
                                    </th>
                                    <th class="last-child text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th class="last-child text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Bank Res
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($data as $key => $row)
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $key + 1 }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ date('d M Y h:s A', strtotime($row->craeted_at))  }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $row->name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $row->amount . " " . ($row->currency == "840" ? "USD" : ($row->currency == "949" ? "TL" : ( $row->currency == "978" ? "Euro" : ""))) }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0 {{ $row->status != '1' ? 'datecolor' : '' }}">{{ $row->status == "1" ? "Compleated" : "Declined" }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0  {{ $row->res == 'Error' ? 'datecolor' : '' }}">{{ $row->res }}</p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
  @push('panel_js')

  @endpush
@stop
