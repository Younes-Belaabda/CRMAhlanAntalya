@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','View Data Countries')
@section('content')
    @push('panel_css')
    @endpush
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Countries Info') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ Route('panel.countries.add_new' , @$data->countries_id ) }}" method="POST" role="form text-left"  enctype="multipart/form-data">
                  @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-control-label">{{ __('Name') }}</label>
                                <div class="@error('name')border border-danger rounded-3 @enderror">
                                    <input name="name" class="form-control" type="text" placeholder=" Name" required
                                        id="name" value="{{ isset($data->name) ? $data->name : old('name') }}">
                                </div>
                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="col-md-6" style="display: none;">
                            <div class="form-group">
                                <label for="status" class="form-control-label">{{ __('Status') }}</label>
                                <div class="@error('status') border border-danger rounded-3 @enderror">
                                    <select name="status" class="form-control" id="status" required>
                                      <option value="1" {{ isset($data->status) && $data->status == 1 ? 'selected' : '' }}>Active</option>
                                      <option value="0" {{ isset($data->status) && $data->status == 0 ? 'selected' : '' }}>Not Active</option>
                                    </select>
                                </div>
                                @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="image_uploader">
                                <img  id="blah" src="{{ @$data->avatar }}">
                                <label for="uploader"><i class="fa fa-user-plus"></i></label>
                                <input id="uploader" type="file" name="file" accept="image/*"   onchange="loadFile(event)"/>
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
