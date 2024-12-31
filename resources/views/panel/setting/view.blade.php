@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','View Hotel Vouchers')
@section('content')
    @push('panel_css')
    @endpush
    <style>
        table.table td{
            padding:5px !important;
        }
    </style>
    <div class="row">
        <div class="col-12" style="position:relative;">
            
            <div class="card mb-4 mx-4">
                <div class="card-header pb-2">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1">All Settings </h5>
                        </div>
                        <div>
                            <a href="{{ route('panel.voucher.add_new') }}" class="btn bg-gradient-dark btn-sm mb-2" type="button">+&nbsp; New Voucher</a>
                        </div>
                    </div>
                </div>
                <div id="exp_pdf" class="card-body px-2 pt-0 pb-2">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr class="bg">
                                <th colspan="10">
                                    All Hotel Vouchers
                                </th>
                            </tr>
                        </thead>
                    </table>
                    <table class="table align-items-center mb-2 nopadhid">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:5%;">
                                        Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:12%;">
                                        Coustmer
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:12%;">
                                        Booking No
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:12%;">
                                        hotel
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:12%;">
                                        Check In
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:12%;">
                                        Check Out
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:12%;">
                                        Booking Amount
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:12%;">
                                        Down Payment
                                    </th>
                                    <th class="last-child text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:15%;">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $con=1; ?>
                                @foreach($data as $key => $row)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ date('d M', strtotime($row->date)) }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0" >{{ $row->name  }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0" >{{ $row->Num }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0" >{{ $row->hotel }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0" >{{ date('d M', strtotime($row->cin)) }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0" >{{ date('d M', strtotime($row->cout)) }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0" >{{ $row->b_amount }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0" >{{ $row->p_amount }}</p>
                                        </td>
                                        <td class="text-center">
                                                <a href="{{ route('panel.voucher.print' , $row->id) }}" class="mx-1" data-bs-toggle="tooltip"
                                                    data-bs-original-title="View">
                                                    <i class="fa fa-eye text-secondary"></i>
                                                </a>
                                                <a href="{{ route('panel.voucher.add_new' , $row->id) }}" class="mx-1" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Edit">
                                                    <i class="fas fa-user-edit text-secondary"></i>
                                                </a>
                                                <a data-url="{{ route('panel.voucher.delete' , $row->id) }}" class="mx-1 delete" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Delete">
                                                    <i class="cursor-pointer fas fa-trash text-danger"></i>
                                                </a>
                                        </td>
                                    </tr>
                                    <?php $con++; ?>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
  @push('panel_js')

  @endpush
@stop
