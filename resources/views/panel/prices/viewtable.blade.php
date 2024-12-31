@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','View prices Table')
@section('content')
    @push('panel_css')
    @endpush
    <div class="row">
        <div class="col-12" style="position:relative;">
            
            <div class="card mb-4 mx-4">
                <div class="card-header pb-2">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1">All Prices Table</h5>
                        </div>
                        <div>
                             <a class="btn bg-gradient-dark btn-sm mb-2 export_pdf" type="button">Export PDF</a>
                            <a href="{{ route('panel.prices.pricestable.add_new',$type_id) }}" class="btn bg-gradient-dark btn-sm mb-2" type="button">+&nbsp; New Table</a>
                        </div>
                    </div>
                </div>
                <div id="exp_pdf" class="card-body px-2 pt-0 pb-2">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr class="bg">
                                <th colspan="10">
                                    All {{ @$type->title }}
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
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:75%;">
                                        Title
                                    </th>
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
                                            <p class="text-xs font-weight-bold mb-0" >{{ $row->title_table }}</p>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('panel.prices.pricestable.pricesrow.view' , [$type_id,$row->table_id]) }}" class="mx-1" data-bs-toggle="tooltip"
                                                data-bs-original-title="View Rows">
                                                <i class="fas fa-table text-secondary"></i>
                                            </a>
                                            <a href="{{ route('panel.prices.pricestable.add_new' , [$type_id,$row->table_id]) }}" class="mx-1" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit prices">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>
                                            <a data-url="{{ route('panel.prices.pricestable.delete' , [$type_id,$row->table_id]) }}" class="mx-1 delete" data-bs-toggle="tooltip"
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
