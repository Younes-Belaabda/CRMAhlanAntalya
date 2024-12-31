@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','View prices Data')
@section('content')
    @push('panel_css')
    @endpush
    <div class="row">
        <div class="col-12" style="position:relative;">
            
            <div class="card mb-4 mx-4">
                <div class="card-header pb-2">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1">{{ @$table->title_table }}</h5>
                        </div>
                        <div>
                             <a class="btn bg-gradient-dark btn-sm mb-2 export_pdf" type="button">Export PDF</a>
                            <a href="{{ route('panel.prices.pricestable.pricesrow.add_new',[$type_id,$table_id,null]) }}" class="btn bg-gradient-dark btn-sm mb-2" type="button">+&nbsp; New Row</a>
                        </div>
                    </div>
                </div>
                <div id="exp_pdf" class="card-body px-2 pt-0 pb-2">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr class="bg">
                                <th colspan="10">
                                    {{ @$table->title_table }}
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <table class="table align-items-center mb-2 nopadhid">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:5%;">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:25%;">
                                        Title
                                    </th>
                                    @if($type->id == 1)
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:25%;">
                                        Star
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:25%;">
                                        Board
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:25%;">
                                        distance to airport 
                                    </th>
                                    @endif
                                    @if($type->id == 2)
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:25%;">
                                        1-6 PAX
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:25%;">
                                        6-12 PAX
                                    </th>
                                    @endif
                                    @if($type->id == 3)
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:25%;">
                                        PAX
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:25%;">
                                       PAX
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:25%;">
                                        PAX
                                    </th>
                                    @endif
                                    <th class="last-child text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:20%;">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $con=1; ?>
                                @foreach($data as $key => $row)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $con }}</p>
                                        </td>
                                        <td class="user">
                                            <p class="text-xs font-weight-bold mb-0" >{{ $row->title }}</p>
                                        </td>
                                        
                                        @if($type->id == 1)
                                            <td class="user">
                                                <span>{{ $row->star}}</span>
                                            </td>
                                            <td class="user">
                                                @if($row->desc_data != "")
                                                    <span>{{ $row->desc_data}}</span>
                                                @endif
                                            </td>
                                            <td class="user">
                                                @if($row->s24 != "")
                                                    <span>{{ $row->s24}}</span>
                                                @endif
                                            </td>
                                        @endif
                                        @if($type->id == 2)
                                        <td class="user">
                                            @if($row->s6 != "")
                                                <span> {{ $row->s6}}</span>
                                            @endif
                                        </td>
                                        <td class="user">
                                            @if($row->s12 != "")
                                                <span> {{ $row->s12}}</span>
                                            @endif
                                        </td>
                                        @endif
                                        @if($type->id == 3)
                                        <td class="user">
                                            @if($row->s5 != "")
                                                <span> {{ $row->s5}}</span>
                                            @endif
                                        </td>
                                        <td class="user">
                                            @if($row->s12 != "")
                                                <span> {{ $row->s12}}</span>
                                            @endif
                                        </td>
                                        <td class="user">
                                            @if($row->s24 != "")
                                                <span> {{ $row->s24}}</span>
                                            @endif
                                        </td>
                                        @endif
                                        <td class="text-center">
                                            <a href="{{ route('panel.prices.pricestable.pricesrow.add_new' , [$type_id,$table_id,$row->data_id]) }}" class="mx-1" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit prices">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>
                                            <a data-url="{{ route('panel.prices.pricestable.pricesrow.delete' , [$type_id,$table_id,$row->data_id]) }}" class="mx-1 delete" data-bs-toggle="tooltip"
                                                data-bs-original-title="Delete prices">
                                                <i class="cursor-pointer fas fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $con++; ?>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
  @push('panel_js')

  @endpush
@stop
