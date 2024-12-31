@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','View Data To Do List')
@section('content')
    @push('panel_css')
    @endpush
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('To Do List Info') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ Route('panel.todolist.add_new' , @$data->notification_id ) }}" method="POST" role="form text-left">
                  @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="to_user_id" class="form-control-label">{{ __('Accounts') }}</label>
                                <div class="@error('to_user_id') border border-danger rounded-3 @enderror">
                                    <select name="to_user_id[]" class="select form-control" multiple id="to_user_id">
                                    <option value="">Choose</option>
                                        @foreach($users as $key => $row)
                                            <?php 
                                                $select = false;
                                                if(isset($data->users) && $data->users != null){
                                                    foreach($data->users as $user){
                                                        if($row->id == $user->id){
                                                            $select = true;
                                                        }
                                                    }
                                                }
                                            ?>
                                            <option value="{{$row->id}}" {{ $select == true ? 'selected' : '' }}>{{$row->full_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" style="display: none;">
                            <div class="form-group">
                                <label for="status" class="form-control-label">{{ __('Status') }}</label>
                                <div class="@error('status') border border-danger rounded-3 @enderror">
                                    <select name="status" class="select form-control" id="status" required>
                                      <option value="1" {{ isset($data->status) && $data->status == 1 ? 'selected' : '' }}>Active</option>
                                      <option value="0" {{ isset($data->status) && $data->status == 0 ? 'selected' : '' }}>Not Active</option>
                                    </select>
                                </div>
                                @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-3" style="display:none;">
                            <div class="form-group">
                                <label for="type" class="form-control-label">{{ __('Type') }}</label>
                                <div class="@error('type') border border-danger rounded-3 @enderror">
                                    <select name="type" class="select form-control" id="type" required>
                                      <option value="">Choose</option>
                                      <option value="1" selected>Message</option>
                                      <option value="2" {{ isset($data->type) && $data->type == 2 ? 'selected' : '' }}>Retweet</option>
                                    </select>
                                </div>
                                @error('type') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title" class="form-control-label">{{ __('Title') }}</label>
                                <div class="@error('title')border border-danger rounded-3 @enderror">
                                    <input name="title" class="form-control" value="{{ isset($data->title) ? $data->title : old('title') }}">
                                </div>
                                @error('text') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="text" class="form-control-label">{{ __('Text') }}</label>
                                <div class="@error('text')border border-danger rounded-3 @enderror">
                                    <textarea  id="editor" name="text" rows="4" class="form-control">{{ isset($data->text) ? $data->text : old('text') }}</textarea>
                                </div>
                                @error('text') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ isset($data->notification_id) ? "Update":'Send' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
  @push('panel_js')

  @endpush
@stop
