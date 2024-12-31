@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','Reports')
@section('content')
    @push('panel_css')
    @endpush
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4 pb-2">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1 show_accro">Reports</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pt-0 pb-2 mb-0 hide_accro">
                    <form action="{{ Route('panel.report.source_service') }}" method="Get" role="form text-left">
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
                                        <input class="form-control datepicker" autocomplete="off" name="from_date" value='{{ @$request["from_date"] }}'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="to_date" class="form-control-label">{{ __('To Date') }}</label>
                                    <div class="@error('to_date') border border-danger rounded-3 @enderror">
                                        <input class="form-control datepicker" autocomplete="off" name="to_date" value='{{ @$request["to_date"] }}'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="m_type" class="form-control-label">{{ __('Movement Type') }}</label>
                                    <div class="@error('m_type') border border-danger rounded-3 @enderror">
                                        <select name="m_type" class="select form-control" id="m_type">
                                        <option value="">Choose</option>
                                        <option value="Airport Pickup & Transfers" {{ isset($request["m_type"]) && $request["m_type"] == "Airport Pickup & Transfers" ? 'selected' : '' }}>Airport Pickup & Transfers</option>
                                        <option value="Driver Tours" {{isset($request["m_type"]) && $request["m_type"] == "Driver Tours" ? 'selected' : '' }}>Driver Tours</option>
                                        <option value="Group Tours" {{isset($request["m_type"]) && $request["m_type"] == "Group Tours" ? 'selected' : '' }}>Group Tours</option>
                                        <option value="Car Rental" {{ isset($request["m_type"]) && $request["m_type"] == "Car Rental" ? 'selected' : '' }}>Car Rental</option>
                                        <option value="Hotels/Apart-hotels" {{ isset($request["m_type"]) && $request["m_type"] == "Hotels/Apart-hotels" ? 'selected' : '' }}>Hotels/Apart-hotels</option>
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
                            <h5 class="mb-1">Report Data</h5>
                        </div>
                        <a class="btn bg-gradient-dark btn-sm mb-2 export_pdf" type="button">Export PDF</a>
                    </div>
                </div>
                <div id="exp_pdf" class="card-body px-2 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Summary
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    USD
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    TL
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Euro
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    £
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($data as $key => $row)
                                <tr>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $key + 1 }}</p>
                                    </td>
                                    <td class="user">
                                        <a class="text-xs font-weight-bold mb-0"  href="{{ url('/admin/entries?d_user='.$row['user_id'])}}">{{ @$row['full_name'] }}</a>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $row['C1'] }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $row['C2'] }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $row['C3'] }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $row['C4'] }}</p>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="sumtions">
                        <div class="card-body  px-0 ">
                            <?php
                                function sumAmountByCurrency($collection,$type, $currency)
                                {
                                    return $collection->where('price_type', $currency)
                                    ->where("type" , $type)->sum('price');
                                }
                                function sumMAmountByCurrency($collection, $colum)
                                {
                                    return $collection->sum($colum);
                                }
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
                            ?>

                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">$</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TL</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">€</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">£</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> Expenses</td>
                                    <td>{{$e1=sumAmountByCurrency($income,"Expenses", '$')}}</td>
                                    <td>{{$e2=sumAmountByCurrency($income,"Expenses", 'TL')}}</td>
                                    <td>{{$e3=sumAmountByCurrency($income,"Expenses", '€')}}</td>
                                    <td>{{$e4=sumAmountByCurrency($income,"Expenses", '£')}}</td>
                                </tr>
                                <tr>
                                    <td> Income</td>
                                    <td>{{$i1=sumAmountByCurrency($income,"Income", '$')}}</td>
                                    <td>{{$i2=sumAmountByCurrency($income,"Income", 'TL')}}</td>
                                    <td>{{$i3=sumAmountByCurrency($income,"Income", '€')}}</td>
                                    <td>{{$i4=sumAmountByCurrency($income,"Income", '£')}}</td>
                                </tr>
                                <tr>
                                    <td> Movement</td>
                                    <td>{{$m1=sumMAmountByCurrency($data,"C1")}}</td>
                                    <td>{{$m2=sumMAmountByCurrency($data,"C2")}}</td>
                                    <td>{{$m3=sumMAmountByCurrency($data,"C3")}}</td>
                                    <td>{{$m4=sumMAmountByCurrency($data,"C4")}}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>{{($i1+$m1)-$e1}}</td>
                                    <td>{{($i2+$m2)-$e2}}</td>
                                    <td>{{($i3+$m3)-$e3}}</td>
                                    <td>{{($i4+$m4)-$e4}}</td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  @push('panel_js')

  @endpush
@stop
