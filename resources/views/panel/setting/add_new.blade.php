@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','View Voucher')
@section('content')
    @push('panel_css')
    @endpush
    <Style>
        .add_room {
            background-image: linear-gradient(310deg,#141727 0%,#3A416F 100%);
            float: right;
            width: 35px;
            height: 35px;
            color: #fff;
            text-align: center;
            line-height: 35px;
            border-radius: 5px;
            font-size: 12px;
            margin-top: 32px;
            cursor: pointer;
            
        }
        .room_hed h3 {
            float: left;
            font-size: 18px;
            font-weight: bold;
        }
        .room_hed {
            float: right;
            width: 100%;
            margin-top: 25px;
            margin-bottom: 15px;
        }
        a.remove_room {
            float: right;
            width: 35px;
            height: 35px;
            background: #E91E63;
            color: #fff;
            text-align: center;
            line-height: 35px;
            border-radius: 5px;
            font-size: 12px;
            margin-top: 32px;
            cursor: pointer;
        }
    </Style>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Voucher Form') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ Route('panel.voucher.add_new' , @$data->id ) }}" method="POST" role="form text-left">
                  @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="gneder" class="form-control-label">{{ __('gneder') }}</label>
                                <div class="@error('gneder') border border-danger rounded-3 @enderror">
                                    <select name="gneder" class="select form-control" id="gneder" required>
                                        <option value="">Choose</option>
                                        <option value="Mr" {{ isset($data->gneder) && $data->gneder == "Mr" ? 'selected' : '' }}>Mr</option>
                                        <option value="Ms" {{ isset($data->gneder) && $data->gneder == "Ms" ? 'selected' : '' }}>Ms</option>
                                    </select>
                                </div>
                                @error('gneder') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name" class="form-control-label">{{ __('name') }}</label>
                                <div class="@error('name')border border-danger rounded-3 @enderror">
                                    <input name="name" class="form-control" type="text" placeholder=" name" required
                                        id="name" value="{{ isset($data->name) ? $data->name : old('name') }}">
                                </div>
                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="date" class="form-control-label">{{ __('Voucher date') }}</label>
                                <div class="@error('date')border border-danger rounded-3 @enderror">
                                    <input name="date" class="form-control datepicker"  autocomplete="off" type="text" placeholder="Date"
                                        id="date" value="{{ isset($data->date) ? date('Y-m-d', strtotime($data->date)) : old('date') }}">
                                </div>
                                @error('date') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="Num" class="form-control-label">{{ __('booking No') }}</label>
                                <div class="@error('Num')border border-danger rounded-3 @enderror">
                                    <input name="Num" class="form-control" type="text" placeholder="Num"
                                        id="Num" value="{{ isset($data->Num) ? $data->Num : old('Num') }}">
                                </div>
                                @error('Num') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="cin" class="form-control-label">{{ __('check in') }}</label>
                                <div class="@error('cin')border border-danger rounded-3 @enderror">
                                    <input name="cin" class="form-control datepicker"  autocomplete="off" type="text" placeholder="check in"
                                        id="cin" value="{{ isset($data->cin) ? date('Y-m-d', strtotime($data->cin)) : old('cin') }}">
                                </div>
                                @error('cin') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="cout" class="form-control-label">{{ __('check Out') }}</label>
                                <div class="@error('cout')border border-danger rounded-3 @enderror">
                                    <input name="cout" class="form-control datepicker"  autocomplete="off" type="text" placeholder="check Out"
                                        id="cout" value="{{ isset($data->cout) ? date('Y-m-d', strtotime($data->cout)) : old('cout') }}">
                                </div>
                                @error('cout') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col" style="display:none">
                            <div class="form-group">
                                <label for="status" class="form-control-label">{{ __('Status') }}</label>
                                <div class="@error('status') border border-danger rounded-3 @enderror">
                                    <select name="status" class="select form-control" id="status">
                                      <option value="1" {{ isset($data->status) && $data->status == 1 ? 'selected' : '' }}>Active</option>
                                      <option value="0" {{ isset($data->status) && $data->status == 0 ? 'selected' : '' }}>Not Active</option>
                                    </select>
                                </div>
                                @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="b_amount" class="form-control-label">{{ __('booking amount') }}</label>
                                <div class="@error('b_amount')border border-danger rounded-3 @enderror">
                                    <input name="b_amount" class="form-control" type="text" placeholder="booking amount"
                                        id="b_amount" value="{{ isset($data->b_amount) ? $data->b_amount : old('b_amount') }}">
                                </div>
                                @error('b_amount') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="p_amount" class="form-control-label">{{ __('Down Payment') }}</label>
                                <div class="@error('p_amount')border border-danger rounded-3 @enderror">
                                    <input name="p_amount" class="form-control" type="text" placeholder="Down Payment"
                                        id="p_amount" value="{{ isset($data->p_amount) ? $data->p_amount : old('p_amount') }}">
                                </div>
                                @error('p_amount') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hotel" class="form-control-label">{{ __('hotel') }}</label>
                                <div class="@error('hotel')border border-danger rounded-3 @enderror">
                                    <input name="hotel" class="form-control" type="text" placeholder="hotel" required
                                        id="hotel" value="{{ isset($data->hotel) ? $data->hotel : old('hotel') }}">
                                </div>
                                @error('hotel') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address" class="form-control-label">{{ __('address') }}</label>
                                <div class="@error('address')border border-danger rounded-3 @enderror">
                                    <input name="address" class="form-control" type="text" placeholder="address"
                                        id="address" value="{{ isset($data->address) ? $data->address : old('address') }}">
                                </div>
                                @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="rooms">
                            <div class="room_hed">
                                <h3>Room Details</h3>
                            </div>
                            <div class="room">
                                <div class="row">
                                    <div class="col-md-11">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="rooms" class="form-control-label">{{ __('room Type') }}</label>
                                                    <div class="@error('rooms')border border-danger rounded-3 @enderror">
                                                        <input name="rooms[]" class="form-control" type="text" placeholder="rooms"
                                                            id="rooms" value="{{ isset($data->rooms) ? $data->rooms : old('rooms') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="pax" class="form-control-label">{{ __('pax') }}</label>
                                                    <div class="@error('pax')border border-danger rounded-3 @enderror">
                                                        <input name="pax[]" class="form-control" type="text" placeholder="pax"
                                                            id="pax" value="{{ isset($data->pax) ? $data->pax : old('pax') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="view" class="form-control-label">{{ __('view') }}</label>
                                                    <div class="@error('view')border border-danger rounded-3 @enderror">
                                                        <input name="view[]" class="form-control" type="text" placeholder="view"
                                                            id="view" value="{{ isset($data->view) ? $data->view : old('view') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="board" class="form-control-label">{{ __('board') }}</label>
                                                    <div class="@error('board')border border-danger rounded-3 @enderror">
                                                        <input name="board[]" class="form-control" type="text" placeholder="board"
                                                            id="board" value="{{ isset($data->board) ? $data->board : old('board') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="no_room" class="form-control-label">{{ __('no of rooms') }}</label>
                                                    <div class="@error('no_room')border border-danger rounded-3 @enderror">
                                                        <input name="no_room[]" class="form-control" type="text" placeholder="no room"
                                                            id="no_room" value="{{ isset($data->no_room) ? $data->no_room : old('no_room') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <a class="add_room"><i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            @if(isset($data->VRoom))
                                @foreach($data->VRoom as $room)
                                <div class="room">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="rooms" class="form-control-label">{{ __('room Type') }}</label>
                                                        <div class="@error('rooms')border border-danger rounded-3 @enderror">
                                                            <input name="rooms[]" class="form-control" type="text" placeholder="rooms"
                                                                id="rooms" value="{{ isset($room->rooms) ? $room->rooms : old('rooms') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="pax" class="form-control-label">{{ __('pax') }}</label>
                                                        <div class="@error('pax')border border-danger rounded-3 @enderror">
                                                            <input name="pax[]" class="form-control" type="text" placeholder="pax"
                                                                id="pax" value="{{ isset($room->pax) ? $room->pax : old('pax') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="view" class="form-control-label">{{ __('view') }}</label>
                                                        <div class="@error('view')border border-danger rounded-3 @enderror">
                                                            <input name="view[]" class="form-control" type="text" placeholder="view"
                                                                id="view" value="{{ isset($room->view) ? $room->view : old('view') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="board" class="form-control-label">{{ __('board') }}</label>
                                                        <div class="@error('board')border border-danger rounded-3 @enderror">
                                                            <input name="board[]" class="form-control" type="text" placeholder="board"
                                                                id="board" value="{{ isset($room->board) ? $room->board : old('board') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="no_room" class="form-control-label">{{ __('no of rooms') }}</label>
                                                        <div class="@error('no_room')border border-danger rounded-3 @enderror">
                                                            <input name="no_room[]" class="form-control" type="text" placeholder="no room"
                                                                id="no_room" value="{{ isset($room->no_room) ? $room->no_room : old('no_room') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <a class="remove_room"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="note" class="form-control-label">{{ __('note') }}</label>
                                <div class="@error('note')border border-danger rounded-3 @enderror">
                                    <textarea  id="editor" name="note" rows="4" class="form-control">{{ isset($data->note) ? $data->note : old('note') }}</textarea>
                                </div>
                                @error('note') <div class="text-danger">{{ $message }}</div> @enderror
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
  @section('panel_js')
    <script>
        $(document).ready(function() {
            $(".remove_room").click(function(){
                $(this).parent().parent().parent().remove();
            });
            $(".add_room").click(function(){
                var html ='<div class="room">'+
                                '<div class="row">'+
                                    '<div class="col-md-11">'+
                                        '<div class="row">'+
                                            '<div class="col">'+
                                                '<div class="form-group">'+
                                                    '<label for="rooms" class="form-control-label">{{ __('rooms') }}</label>'+
                                                    '<div class="@error('rooms')border border-danger rounded-3 @enderror">'+
                                                        '<input name="rooms[]" class="form-control" type="text" placeholder="rooms"'+
                                                            'id="rooms" value="{{ isset($data->rooms) ? $data->rooms : old('rooms') }}">'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col">'+
                                                '<div class="form-group">'+
                                                    '<label for="pax" class="form-control-label">{{ __('pax') }}</label>'+
                                                    '<div class="@error('pax')border border-danger rounded-3 @enderror">'+
                                                        '<input name="pax[]" class="form-control" type="text" placeholder="pax"'+
                                                            'id="pax" value="{{ isset($data->pax) ? $data->pax : old('pax') }}">'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col">'+
                                                '<div class="form-group">'+
                                                    '<label for="view" class="form-control-label">{{ __('view') }}</label>'+
                                                    '<div class="@error('view')border border-danger rounded-3 @enderror">'+
                                                        '<input name="view[]" class="form-control" type="text" placeholder="view"'+
                                                         '   id="view" value="{{ isset($data->view) ? $data->view : old('view') }}">'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col">'+
                                                '<div class="form-group">'+
                                                    '<label for="board" class="form-control-label">{{ __('board') }}</label>'+
                                                    '<div class="@error('board')border border-danger rounded-3 @enderror">'+
                                                        '<input name="board[]" class="form-control" type="text" placeholder="board"'+
                                                         '   id="board" value="{{ isset($data->board) ? $data->board : old('board') }}">'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col">'+
                                                '<div class="form-group">'+
                                                    '<label for="no_room" class="form-control-label">{{ __('no room') }}</label>'+
                                                    '<div class="@error('no_room')border border-danger rounded-3 @enderror">'+
                                                        '<input name="no_room[]" class="form-control" type="text" placeholder="no room"'+
                                                            'id="no_room" value="{{ isset($data->no_room) ? $data->no_room : old('no_room') }}">'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-md-1">'+
                                        '<a class="remove_room"><i class="fa fa-trash"></i></a>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                $(".rooms").append(html);    
            });
        });
    </script>
  @endsection
@stop

