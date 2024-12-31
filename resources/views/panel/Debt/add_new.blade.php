@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','View Data Debt')
@section('content')
    @push('panel_css')
    @endpush
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Debt Info') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ Route('panel.debt.add_new' , @$data->debt_id ) }}" method="POST" role="form text-left">
                  @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price" class="form-control-label">{{ __('Amount') }}</label>
                                <div class="@error('price')border border-danger rounded-3 @enderror">
                                    <input name="price" class="form-control" type="text" placeholder=" Amount" required
                                        id="price" value="{{ isset($data->price) ? $data->price : old('price') }}">
                                </div>
                                @error('price') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price_type" class="form-control-label">{{ __('Currency') }}</label>
                                <div class="@error('price_type') border border-danger rounded-3 @enderror">
                                    <select name="price_type" class="select form-control" id="price_type" required>
                                      <option value="">Choose</option>
                                      <option value="$" {{ isset($data->price_type) && $data->price_type == "$" ? 'selected' : '' }}>$</option>
                                      <option value="TL" {{ isset($data->price_type) && $data->price_type == "TL" ? 'selected' : '' }}>TL</option>
                                      <option value="€" {{ isset($data->price_type) && $data->price_type == "€" ? 'selected' : '' }}>€</option>
                                      <option value="£" {{ isset($data->price_type) && $data->price_type == "£" ? 'selected' : '' }}>£</option>
                                    </select>
                                </div>
                                @error('price_type') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="date" class="form-control-label">{{ __('Date') }}</label>
                                <div class="@error('date')border border-danger rounded-3 @enderror">
                                    <input name="date" class="form-control datepicker" type="text" autocomplete="off" placeholder="Date" required
                                        id="date" value="{{ isset($data->date) ? date('Y-m-d', strtotime($data->date)) : old('date') }}">
                                </div>
                                @error('date') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="for_id" class="form-control-label">{{ __('Accounts') }}</label>
                                <div class="@error('for_id') border border-danger rounded-3 @enderror">
                                    <select name="for_id" class="select form-control" id="for_id">
                                    <option value="">Choose</option>
                                        @foreach($users as $key => $row)
                                            <option value="{{$row->id}}" {{ isset($data->for_id) && $data->for_id == $row->id ? 'selected' : '' }}>{{$row->full_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3" style="display:none;">
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="note" class="form-control-label">{{ __('Note') }}</label>
                                <div class="@error('note')border border-danger rounded-3 @enderror">
                                    <input name="note" class="form-control" type="text" placeholder="Note"
                                        id="note" value="{{ isset($data->note) ? $data->note : old('note') }}">
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
  @push('panel_js')

  @endpush
@stop
