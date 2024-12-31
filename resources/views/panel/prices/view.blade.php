@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','View Files')
@section('content')
    @push('panel_css')
    @endpush
    <div class="row">
        <div class="col-12" style="position:relative;">
            
            <div class="card mb-4 mx-4">
                <div class="card-header pb-2">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1">All Files </h5>
                        </div>
                    </div>
                </div>
                <div id="exp_pdf" class="card-body px-2 pt-0 pb-2">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr class="bg">
                                <th colspan="10">
                                    All Files  Type
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
                                            <p class="text-xs font-weight-bold mb-0" >{{ $row->title }}</p>
                                        </td>
                                        <td class="text-center">
                                            @if(Auth()->user()->type != 1)
                                                <a href="{{ route('panel.prices.print' , $row->id) }}" class="mx-1" data-bs-toggle="tooltip"
                                                    data-bs-original-title="View">
                                                    <i class="fa fa-eye text-secondary"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('panel.prices.print' , $row->id) }}" class="mx-1" data-bs-toggle="tooltip"
                                                    data-bs-original-title="View">
                                                    <i class="fa fa-eye text-secondary"></i>
                                                </a>
                                                @if($row->id == 2)
                                                <a href="{{ route('panel.prices.note.view' , $row->id) }}" class="mx-1" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Note">
                                                    <i class="fa fa-comments-o text-secondary"></i>
                                                </a>
                                                @endif
                                                <a href="{{ route('panel.prices.pricestable.view' , $row->id) }}" class="mx-1" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Tables">
                                                    <i class="fas fa-table text-secondary"></i>
                                                </a>
                                                <a href="{{ route('panel.prices.add_new' , $row->id) }}" class="mx-1" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Edit">
                                                    <i class="fas fa-user-edit text-secondary"></i>
                                                </a>
                                                <a data-url="{{ route('panel.prices.delete' , $row->id) }}" class="mx-1 delete" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Delete">
                                                    <i class="cursor-pointer fas fa-trash text-danger"></i>
                                                </a>
                                            @endif
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
