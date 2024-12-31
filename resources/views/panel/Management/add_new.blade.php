@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','View Data User')
@section('content')
    @push('panel_css')
    @endpush
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('User Info') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ Route('panel.users.add_new' , @$data->id ) }}" method="POST" role="form text-left" enctype="multipart/form-data">
                  @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_name" class="form-control-label">{{ __('User Name') }}</label>
                                <div class="@error('user_name')border border-danger rounded-3 @enderror">
                                    <input name="user_name" class="form-control" type="text" placeholder="User Name" required
                                        id="user_name" value="{{ isset($data->user_name) ? $data->user_name : old('user_name') }}">
                                </div>
                                @error('user_name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-control-label">{{ __('Email') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input name="email" class="form-control" type="email" required
                                        placeholder="@example.com" id="email" value="{{ isset($data->email) ? $data->email : old('email') }}">
                                </div>
                                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full_name" class="form-control-label">{{ __('Full Name') }}</label>
                                <div class="@error('full_name')border border-danger rounded-3 @enderror">
                                    <input name="full_name" class="form-control" type="text"
                                        placeholder="Full Name" id="full_name" required value="{{ isset($data->full_name) ? $data->full_name : old('full_name') }}">
                                </div>
                                @error('full_name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status" class="form-control-label">{{ __('Status') }}</label>
                                <div class="@error('status') border border-danger rounded-3 @enderror">
                                    <select name="status" class="form-control" id="status" required>
                                      <option value="">Choose</option>
                                      <option value="1" {{ isset($data->status) && $data->status == 1 ? 'selected' : '' }}>Active</option>
                                      <option value="0" {{ isset($data->status) && $data->status == 0 ? 'selected' : '' }}>Not Active</option>
                                    </select>
                                </div>
                                @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="type" class="form-control-label">{{ __('Type') }}</label>
                                <div class="@error('type') border border-danger rounded-3 @enderror">
                                    <select name="type" class="form-control" id="type" required>
                                      <option value="">Choose</option>
                                      <option value="1" {{ isset($data->type) && $data->type == "1" ? 'selected' : '' }}>Admin</option>
                                      <option value="2" {{ isset($data->type) && $data->type == "2" ? 'selected' : '' }}>Driver</option>
                                      <option value="3" {{ isset($data->type) && $data->type == "3" ? 'selected' : '' }}>Agent</option>
                                      <option value="4" {{ isset($data->type) && $data->type == "4" ? 'selected' : '' }}>Vendor</option>
                                      <option value="5" {{ isset($data->type) && $data->type == "5" ? 'selected' : '' }}>Partner</option>
                                    </select>
                                </div>
                                @error('type') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="background" class="form-control-label">{{ __('background') }}</label>
                                <div class="@error('background') border border-danger rounded-3 @enderror">
                                    <input name="background" class="form-control" type="color"
                                        placeholder="background" id="background" value="{{ isset($data->background) ? $data->background : old('background') }}">
                                </div>
                                @error('background') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="color" class="form-control-label">{{ __('color') }}</label>
                                <div class="@error('color') border border-danger rounded-3 @enderror">
                                    <input name="color" class="form-control" type="color"
                                        placeholder="color" id="color" value="{{ isset($data->color) ? $data->color : old('color') }}">
                                </div>
                                @error('color') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="form-control-label">{{ __('Password') }}</label>
                                <div class="@error('password') border border-danger rounded-3 @enderror">
                                    <input name="password" class="form-control" type="password" {{ isset($id) && ($id != null || $id != false ) ? '' : 'required'}}
                                        placeholder="Password" id="password" value="{{ old('password') }}">
                                </div>
                                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation" class="form-control-label">{{ __('Password Confirmation') }}</label>
                                <div class="@error('password_confirmation') border border-danger rounded-3 @enderror">
                                    <input name="password_confirmation" class="form-control" type="password"
                                        placeholder="Password Confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}">
                                </div>
                                @error('password_confirmation') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="image_uploader">
                                <img  id="blah" src="{{ isset($data->avatar) ? $data->avatar : admin_url('images/default.png') }}">
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
