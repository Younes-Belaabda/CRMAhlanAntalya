@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','View Price Table')
@section('content')
    @push('panel_css')
    @endpush
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Type Table') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ Route('panel.prices.pricestable.add_new' , [$type_id,@$data->table_id] ) }}" method="POST" role="form text-left">
                  @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title_table" class="form-control-label">{{ __('Title') }}</label>
                                <div class="@error('title_table')border border-danger rounded-3 @enderror">
                                    <input name="title_table" class="form-control" type="text" placeholder="title" required
                                        id="title_table" value="{{ isset($data->title_table) ? $data->title_table : old('title_table') }}">
                                </div>
                                @error('title_table') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="desc_table" class="form-control-label">{{ __('desc') }}</label>
                                <div class="@error('desc_table')border border-danger rounded-3 @enderror">
                                    <input name="desc_table" class="form-control" type="text" placeholder="desc"
                                        id="desc_table" value="{{ isset($data->desc_table) ? $data->desc_table : old('desc_table') }}">
                                </div>
                                @error('desc_table') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
  @push('panel_js')

  @endpush
@stop
