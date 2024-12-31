@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','View Price Type')
@section('content')
    @push('panel_css')
    @endpush
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Type Info') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ Route('panel.prices.add_new' , @$data->id ) }}" method="POST" role="form text-left">
                  @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title" class="form-control-label">{{ __('Title') }}</label>
                                <div class="@error('title')border border-danger rounded-3 @enderror">
                                    <input name="title" class="form-control" type="text" placeholder=" title" required
                                        id="title" value="{{ isset($data->title) ? $data->title : old('title') }}">
                                </div>
                                @error('title') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title_page" class="form-control-label">{{ __('title page') }}</label>
                                <div class="@error('title_page')border border-danger rounded-3 @enderror">
                                    <input name="title_page" class="form-control" type="text" placeholder="title page" required
                                        id="title_page" value="{{ isset($data->title_page) ? $data->title_page : old('title_page') }}">
                                </div>
                                @error('title_page') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="desc_page" class="form-control-label">{{ __('desc') }}</label>
                                <div class="@error('desc_page')border border-danger rounded-3 @enderror">
                                    <input name="desc_page" class="form-control" type="text" placeholder="desc page"
                                        id="desc_page" value="{{ isset($data->desc_page) ? $data->desc_page : old('desc_page') }}">
                                </div>
                                @error('desc_page') <div class="text-danger">{{ $message }}</div> @enderror
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
