@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','View Price Rows')
@section('content')
    @push('panel_css')
    @endpush
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Rows Info') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ Route('panel.prices.pricestable.pricesrow.add_new' , [$type_id,$table_id,@$data->data_id] ) }}" method="POST" role="form text-left">
                  @csrf
                    <?php 
                        $title="";
                        $desc="";
                        if($type_id == 1){
                            $title="HOTEL NAME";
                            $desc="INLCUDE";
                        }
                        if($type_id == 2 || $type_id == 3){
                            $title="destination";
                        }
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title" class="form-control-label">{{ $title }}</label>
                                <div class="@error('title')border border-danger rounded-3 @enderror">
                                    <input name="title" class="form-control" type="text" placeholder="{{$title}}" required
                                        id="title" value="{{ isset($data->title) ? $data->title : old('title') }}">
                                </div>
                                @error('title') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        @if($type_id == 1)
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="star" class="form-control-label">{{ __('star') }}</label>
                                <div class="@error('star')border border-danger rounded-3 @enderror">
                                    <select name="star" class="select form-control" id="star" required>
                                        <option value="">{{ __('star') }}</option>
                                        <option value="3" {{ isset($data->star) && $data->star == "3" ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ isset($data->star) && $data->star == "4" ? 'selected' : '' }}>4</option>
                                        <option value="5" {{ isset($data->star) && $data->star == "5" ? 'selected' : '' }}>5</option>
                                    </select>
                                </div>
                                @error('star') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="s24" class="form-control-label">{{ __('distance to airport ') }}</label>
                                <div class="@error('s24')border border-danger rounded-3 @enderror">
                                    <input name="s24" class="form-control" type="text" placeholder="distance to airport " required
                                        id="s24" value="{{ isset($data->s24) ? $data->s24 : old('s24') }}">
                                </div>
                                @error('s24') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        @endif
                        @if($type_id == 3)
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="s5" class="form-control-label">{{ __('1-6') }}</label>
                                <div class="@error('s5')border border-danger rounded-3 @enderror">
                                    <input name="s5" class="form-control" type="text" placeholder="1-6" required
                                        id="s5" value="{{ isset($data->s5) ? $data->s5 : old('s5') }}">
                                </div>
                                @error('s5') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="s12" class="form-control-label">{{ __('7-14') }}</label>
                                <div class="@error('s12')border border-danger rounded-3 @enderror">
                                    <input name="s12" class="form-control" type="text" placeholder="7-14" required
                                        id="s12" value="{{ isset($data->s12) ? $data->s12 : old('s12') }}">
                                </div>
                                @error('s12') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="s24" class="form-control-label">{{ __('15-27') }}</label>
                                <div class="@error('s24')border border-danger rounded-3 @enderror">
                                    <input name="s24" class="form-control" type="text" placeholder="15-27" required
                                        id="s24" value="{{ isset($data->s24) ? $data->s24 : old('s24') }}">
                                </div>
                                @error('s24') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        @endif
                        @if($type_id == 2)
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="s6" class="form-control-label">{{ __('1-6PAX') }}</label>
                                <div class="@error('s6')border border-danger rounded-3 @enderror">
                                    <input name="s6" class="form-control" type="text" placeholder="1-6PAX" required
                                        id="s6" value="{{ isset($data->s6) ? $data->s6 : old('s6') }}">
                                </div>
                                @error('s6') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="s12" class="form-control-label">{{ __('1-12 PAX') }}</label>
                                <div class="@error('s12')border border-danger rounded-3 @enderror">
                                    <input name="s12" class="form-control" type="text" placeholder="1-12 PAX" required
                                        id="s12" value="{{ isset($data->s12) ? $data->s12 : old('s12') }}">
                                </div>
                                @error('s12') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        @endif
                        @if($type_id == 1)
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="desc_data" class="form-control-label">{{ $desc }}</label>
                                <div class="@error('desc_data')border border-danger rounded-3 @enderror">
                                    <input name="desc_data" class="form-control" type="text" placeholder="{{$desc}}"
                                        id="desc_data" value="{{ isset($data->desc_data) ? $data->desc_data : old('desc_data') }}">
                                </div>
                                @error('desc_data') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        @endif
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
