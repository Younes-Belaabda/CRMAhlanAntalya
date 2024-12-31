@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','View Countries')
@section('content')
    @push('panel_css')
    @endpush

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1">All Countries</h5>
                        </div>
                        <a href="{{ route('panel.countries.add_new') }}" class="btn bg-gradient-dark btn-sm mb-2" type="button">+&nbsp; New Countries</a>
                    </div>
                </div>
                <div class="card-body px-2 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:40px">
                                        Flag
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Name
                                    </th>
                                    <!-- <th class="last-child text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th> -->
                                    <th class="last-child text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($data as $key => $row)
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $key + 1 }}</p>
                                    </td>
                                    <td class="text-center">
                                        <div class="image_uploader w50">
                                            <img src="{{ $row->avatar }}" />
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $row->name }}</p>
                                    </td>
                                    
                                    <!-- <td class="text-center">
                                        <div class="form-check form-switch ps-0 check_center">
                                            <input class="form-check-input ms-auto is-displayed"
                                              data-url="{{ route('panel.countries.change_status' , $row->countries_id) }}"
                                              type="checkbox" id="flexSwitchCheckDefault"
                                              {{ $row->status == 1 ? 'checked' : ''}}>
                                        </div>
                                    </td> -->
                                    <td class="text-center">
                                        <a href="{{ route('panel.countries.add_new' , $row->countries_id) }}" class="mx-1" target="_blank" data-bs-toggle="tooltip"
                                            data-bs-original-title="Edit countries">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <!-- <a data-url="{{ route('panel.countries.delete' , $row->countries_id) }}" class="mx-1 delete" data-bs-toggle="tooltip"
                                            data-bs-original-title="Delete countries">
                                            <i class="cursor-pointer fas fa-trash text-danger"></i>
                                        </a> -->
                                    </td>
                                </tr>
                                @endforeach
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
