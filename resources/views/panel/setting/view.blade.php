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
                    </div>
                </div>
                <div class="p-4">
                    <form action="{{ route('panel.settings.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-control-label">
                                        Backgound image payment page
                                    </label>
                                    <div class="row">
                                        <div class="col-12">
                                            <img class="mb-2" width="96" height="96"
                                            src="{{ admin_url(setting('bg_image_payment_page')) }}" alt="bg_image_payment_page">
                                            <input name="bg_image_payment_page" class="form-control" type="file" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  @push('panel_js')

  @endpush
@stop
