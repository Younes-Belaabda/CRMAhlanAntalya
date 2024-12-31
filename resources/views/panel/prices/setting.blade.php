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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone" class="form-control-label">{{ __('phone') }}</label>
                                <div class="@error('phone')border border-danger rounded-3 @enderror">
                                    <input name="phone" class="form-control" type="text" placeholder="phone" required
                                        id="phone" value="{{ isset($data->phone) ? $data->phone : old('phone') }}">
                                </div>
                                @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email" class="form-control-label">{{ __('email') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input name="email" class="form-control" type="email" placeholder="email" required
                                        id="email" value="{{ isset($data->email) ? $data->email : old('email') }}">
                                </div>
                                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="url" class="form-control-label">{{ __('url') }}</label>
                                <div class="@error('url')border border-danger rounded-3 @enderror">
                                    <input name="url" class="form-control" type="text" placeholder="url" required
                                        id="url" value="{{ isset($data->url) ? $data->url : old('url') }}">
                                </div>
                                @error('url') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address" class="form-control-label">{{ __('address') }}</label>
                                <div class="@error('address')border border-danger rounded-3 @enderror">
                                    <input name="address" class="form-control" type="text" placeholder="address" required
                                        id="address" value="{{ isset($data->address) ? $data->address : old('address') }}">
                                </div>
                                @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="note1" class="form-control-label">{{ __('Account USD') }}</label>
                                <div class="@error('note')border border-danger rounded-3 @enderror">
                                    <textarea  id="editor" name="note1" rows="4" class="form-control">{{ isset($data->note1) ? $data->note1 : old('note1') }}</textarea>
                                </div>
                                @error('note1') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="note2" class="form-control-label">{{ __('Account Euro') }}</label>
                                <div class="@error('note2')border border-danger rounded-3 @enderror">
                                    <textarea  id="editor1" name="note2" rows="4" class="form-control">{{ isset($data->note2) ? $data->note2 : old('note2') }}</textarea>
                                </div>
                                @error('note2') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="note3" class="form-control-label">{{ __('Account TL') }}</label>
                                <div class="@error('note3')border border-danger rounded-3 @enderror">
                                    <textarea  id="editor2" name="note3" rows="4" class="form-control">{{ isset($data->note3) ? $data->note3 : old('note3') }}</textarea>
                                </div>
                                @error('note3') <div class="text-danger">{{ $message }}</div> @enderror
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
