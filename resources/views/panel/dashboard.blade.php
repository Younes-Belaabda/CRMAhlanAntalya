@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','Home')
@section('content')
    @push('panel_css')
    @endpush

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1"></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  @section('panel_js')

  @endsection
  @stop
