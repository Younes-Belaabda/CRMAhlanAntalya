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
                <div class="messages">
                    <ul class="px-2 py-3 me-sm-n4">
                        @foreach($message as $row)
                        <li class="mb-2">
                            <?php $url = route("panel.movement.add_new" , $data->movement_id); ?>
                            <a class="dropdown-item border-radius-md" href="{{$data->movement_id != "" ? $url : ''}}">
                                <div class="d-flex py-1">
                                    <div class="my-auto">
                                        <img src="{{ $row->f_user->avatar }}" class="avatar avatar-sm  me-3 ">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">{{$row->f_user->full_name}}</span>
                                        </h6>
                                        <p class="text-xs mb-1">
                                            <?php
                                                echo $row->text;
                                            ?>
                                        </p>
                                        <p class="text-xs text-secondary mb-0">
                                            <i class="fa fa-clock me-1"></i>{{$row->created_at}}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <form action="{{ Route('panel.todolist.add_retweet' , @$data->notification_id ) }}" method="POST" role="form text-left">
                  @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="text" class="form-control-label">{{ __('Retweet Text') }}</label>
                                <div class="@error('text')border border-danger rounded-3 @enderror">
                                    <textarea  id="editor" name="text" rows="4" class="form-control">{{ old('text') }}</textarea>
                                </div>
                                @error('text') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Send' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  @push('panel_js')

  @endpush
@stop
