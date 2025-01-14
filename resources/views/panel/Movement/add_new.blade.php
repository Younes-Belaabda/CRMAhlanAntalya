@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','View Data entries')
@section('content')

        <?php $aush = Auth()->user() ?>
    @push('panel_css')
    @endpush

    <style>
        .form-group>div {
            display: inline-block;
            width: 100%;
        }
        .hidthis{
            display:none;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered{
            padding-right:0;
            padding-left:0;
        }
        input[type="time"]{
            font-family: system-ui;
        }
        .sss .select2-container--default .select2-selection--single .select2-selection__rendered {
            padding-left: 52px;
            margin-top: -3px;
        }
        .checkbox.bay input:checked + label:after{
            background: #ffc107;
        }
        .form-group .form-control-label {
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            z-index:3;
        }
        .form-group {
            position: relative;
        }
        input.form-control:focus + label.form-control-label {
            display: none;
        }
        .form-groups {
            float: right;
            width: 100%;
            text-align: center;
            padding-top: 7px;
        }
        .hideme{
            display:none !important;
        }
    </style>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('NEW ENTRY') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ Route('panel.movement.add_new' , @$data->movement_id ) }}" method="POST" role="form text-left">
                  @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="@error('customer')border border-danger rounded-3 @enderror">
                                    <input name="customer" class="form-control" type="text" required placeholder="{{ __('Name') }}" autocomplete="off"
                                        id="customer" value="{{ old('customer' , @$data->customer) }}">
                                <label for="customer" class="form-control-label">{{ __('Name') }}</label>
                                </div>
                                @error('customer') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="@error('country_id') border border-danger rounded-3 @enderror">
                                    <select name="country_id" class="select form-control" id="country_id" required>
                                      <option value="">{{ __('country') }}</option>
                                      @foreach($countries as $key => $row)
                                        <option value="{{$row->countries_id}}" {{ old("country_id" , @$data->country_id) == $row->countries_id ? 'selected' : '' }}>{{$row->name}}</option>
                                      @endforeach
                                    </select>
                                </div>
                                @error('country_id') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="@error('date')border border-danger rounded-3 @enderror">
                                    <input name="date" class="form-control datepicker" type="text" placeholder="{{ __('date') }}" required autocomplete="off"
                                        id="date" value="{{ old('date' , @$data->date) }}">
                                </div>
                                @error('date') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <?php
                            $time = true;
                            if(isset($data->type) && ($data->type == "Transfers" || $data->type == "Driver Tours" || $data->type == "Group Tours" || $data->type == "Other Services")){
                                // $time=true;
                            }
                            if(@$data->date == null || @$data->time == null){
                                $sdate = Carbon\Carbon::now()->format("Y-m-d H:i:s");
                            }else{
                                $sdate = @$data->date . " ".@$data->time.":00";
                            }
                            $now = Carbon\Carbon::now()->format("Y-m-d H:i:s");
                        ?>
                        <div class="col-md-2 {{$time == true && $sdate >= $now ? "showthis":"hideme"}}" >
                            <div class="form-group">
                                <div class="@error('time')border border-danger rounded-3 @enderror">
                                    <input name="time" class="form-control" type="time" placeholder="{{ __('time') }}"  autocomplete="off"
                                        id="time" value="{{ old('time',@$data->time) }}">
                                </div>
                                @error('time') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="@error('to_date')border border-danger rounded-3 @enderror">
                                    <input name="to_date" class="form-control datepicker" type="text" placeholder="{{ __('To date') }}"  autocomplete="off"
                                        id="to_date" value="{{ old('to_date' , @$data->to_date) }}">
                                </div>
                                @error('to_date') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-2 {{$time == true && $sdate < $now ? "showthis":"hideme"}}">
                            <div class="form-group">
                                <div class="@error('to_time')border border-danger rounded-3 @enderror">
                                    <input name="to_time" class="form-control" type="time" placeholder="{{ __('time') }}"  autocomplete="off"
                                        id="to_time" value="{{ old('to_time' , @$data->to_time) }}">
                                </div>
                                @error('to_time') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="@error('type') border border-danger rounded-3 @enderror">
                                    <select name="type" class="select form-control" id="type" required>
                                      <option value="">{{ __('type') }}</option>
                                      <option value="Transfers" {{ old('type' , @$data->type) == "Transfers" ? 'selected' : '' }}>Transfers</option>
                                      <option value="Driver Tours" {{ old('type' , @$data->type) == "Driver Tours" ? 'selected' : '' }}> Driver Tours</option>
                                      <option value="Group Tours" {{ old('type' , @$data->type) == "Group Tours" ? 'selected' : '' }}> Group Tours</option>
                                      <option value="hotels" {{ old('type' , @$data->type) == "hotels" ? 'selected' : '' }}> Hotels</option>
                                      <option value="Flights" {{ old('type' , @$data->type) == "Flights" ? 'selected' : '' }}>Flights</option>
                                      <option value="T & T" {{ old('type' , @$data->type) == "T & T" ? 'selected' : '' }}>T & T</option>
                                      <option value="Other Services" {{ old('type' , @$data->type) == "Other Services" ? 'selected' : '' }}> Other Services</option>
                                    </select>
                                </div>
                                @error('type') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-{{ $time ==true ? "7":"7"}}">
                            <div class="form-group">
                                <div class="@error('description')border border-danger rounded-3 @enderror">
                                    <input name="description" class="form-control" type="text" id="description"  placeholder="{{ __('description') }}" required
                                    value="{{ isset($data->description) ? $data->description : old('description') }}">

                                    <!--<label for="description" class="form-control-label">{{ __('description') }}</label>-->
                                </div>
                                @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="@error('hotel')border border-danger rounded-3 @enderror">
                                    <input name="hotel" class="form-control" type="text" id="hotel"  placeholder="{{ __('hotel Name (optional)') }}"
                                    value="{{ isset($data->hotel) ? $data->hotel : old('hotel') }}">

                                    <!--<label for="hotel" class="form-control-label">{{ __('hotel') }}</label>-->
                                </div>
                                @error('hotel') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group sss">
                                <label for="s_users" class="form-control-label">{{ __('SEND BY') }}</label>
                                <div class="@error('s_users') border border-danger rounded-3 @enderror">
                                    <select name="s_users" class="select form-control" id="s_users">
                                      <option value="">{{ __('choose') }}</option>
                                      @foreach($users as $key => $row)
                                          @if($row->type == "3" || $row->type == "5")
                                            <?php $select = ""; ?>
                                            @if(isset($data->sender_user) && @$data->sender_user != null)
                                                <?php
                                                    if(isset($data->sender_user->user_id) && $data->sender_user->user_id == $row->id){
                                                        $select = "selected";
                                                    }
                                                ?>
                                            @elseif($aush->type == 5 && $row->id == $aush->id)
                                                <?php $select = "selected"; ?>
                                            @endif
                                            <option value="{{$row->id}}" {{ old('s_users' , @$data->sender_user->user_id) == $row->id ? 'selected' : '' }}>{{$row->full_name}}</option>
                                        @endif
                                      @endforeach
                                    </select>
                                </div>
                                @error('s_users') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group sss">
                                <label for="s_users" class="form-control-label">{{ __('LEAD BY') }}</label>
                                <div class="@error('l_users') border border-danger rounded-3 @enderror">
                                    <select name="l_users" class="select form-control" id="l_users" required>
                                      <option value="">{{ __('choose') }}</option>
                                      @foreach($users as $key => $row)
                                      @if($row->type == "2" || $row->type == "4" || $row->type == "5")
                                        <?php $select = ""; ?>
                                        @if(isset($data->users) && $data->users != null)
                                            <?php
                                                if(isset($data->leader_user->user_id) && $data->leader_user->user_id == $row->id){
                                                    $select = "selected";
                                                }
                                            ?>
                                        @endif
                                        <option value="{{$row->id}}" {{ old('l_users' , @$data->leader_user->user_id) == $row->id ? 'selected' : '' }}>{{$row->full_name}}</option>
                                        @endif
                                      @endforeach
                                    </select>
                                </div>
                                @error('l_users') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="color" class="form-control-label">{{ __('Client Status') }}</label>
                                <div class="@error('color') border border-danger rounded-3 @enderror">
                                    <select name="color" class="select form-control" id="color">
                                      <option value="">Choose</option>
                                      <option value="1" {{ isset($data->color) && $data->color == "1" ? 'selected' : '' }}>Red <span>(Starting tomorrow)</span></option>
                                      <option value="2" {{ isset($data->color) && $data->color == "2" ? 'selected' : '' }}>Yallow (Starting soon)</option>
                                      <option value="3" {{ isset($data->color) && $data->color == "3" ? 'selected' : '' }}>Green (Done)</option>
                                      <option value="4" {{ isset($data->color) && $data->color == "4" ? 'selected' : '' }}>blue (On going)</option>
                                      <option value="5" {{ isset($data->color) && $data->color == "5" ? 'selected' : '' }}>Orange (Wait)</option>
                                    </select>
                                </div>
                                @error('color') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div> -->
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="@error('price')border border-danger rounded-3 @enderror">
                                    <input name="price" class="form-control" type="text"  required placeholder="{{ __('price 1') }}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        id="price" value="{{ isset($data->price) ? $data->price : old('price') }}">
                                    <label for="price" class="form-control-label">{{ __('P1') }}</label>
                                </div>
                                @error('price') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <div class="@error('price_type') border border-danger rounded-3 @enderror">
                                    <select name="price_type" class="select form-control" id="price_type" required>
                                      <option value="$" {{ isset($data->price_type) && $data->price_type == "$" ? 'selected' : '' }}> $</option>
                                      <option value="TL" {{ isset($data->price_type) && $data->price_type == "TL" ? 'selected' : '' }}> TL</option>
                                      <option value="€" {{ isset($data->price_type) && $data->price_type == "€" ? 'selected' : '' }}> €</option>
                                      <option value="£" {{ isset($data->price_type) && $data->price_type == "£" ? 'selected' : '' }}> £</option>
                                    </select>
                                </div>
                                @error('price_type') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="@error('sec_price')border border-danger rounded-3 @enderror">
                                    <input name="sec_price" class="form-control" type="text" placeholder="{{ __('PRICE 2') }}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        id="sec_price" value="{{ isset($data->sec_price) ? $data->sec_price : old('sec_price') }}">
                                    <label for="sec_price" class="form-control-label">{{ __('P2') }}</label>
                                </div>
                                @error('sec_price') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <div class="@error('sec_price_type') border border-danger rounded-3 @enderror">
                                    <select name="sec_price_type" class="select form-control" id="sec_price_type">
                                      <option value="">{{ __('CUR') }}</option>
                                      <option value="$" {{ isset($data->sec_price_type) && $data->sec_price_type == "$" ? 'selected' : '' }}> $</option>
                                      <option value="TL" {{ isset($data->sec_price_type) && $data->sec_price_type == "TL" ? 'selected' : '' }}> TL</option>
                                      <option value="€" {{ isset($data->sec_price_type) && $data->sec_price_type == "€" ? 'selected' : '' }}> €</option>
                                      <option value="£" {{ isset($data->sec_price_type) && $data->sec_price_type == "£" ? 'selected' : '' }}> £</option>
                                    </select>
                                </div>
                                @error('sec_price_type') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        @if(isset($data))
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="@error('net')border border-danger rounded-3 @enderror">
                                    <input name="net" class="form-control" type="text" placeholder="optional" placeholder="{{ __('net') }}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        id="net" value="{{ isset($data->net) ? $data->net : old('net') }}">
                                <label for="net" class="form-control-label">{{ __('net') }}</label>
                                </div>
                                @error('net') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        @if(isset($data->users) && $data->users != null)
                            <?php
                                $show_tl = false;
                                if(isset($data->leader_user->user_id) && $data->leader_user->user->type == 4){
                                    $show_tl = true;
                                }
                            ?>
                        @endif
                        @if($show_tl)
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="@error('net_tl')border border-danger rounded-3 @enderror">
                                    <input name="net_tl" class="form-control" type="text" placeholder="optional" placeholder="{{ __('net TL') }}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        id="net_tl" value="{{ isset($data->net_tl) ? $data->net_tl : old('net_tl') }}">
                                <label for="net_tl" class="form-control-label">{{ __('net tl') }}</label>
                                </div>
                                @error('net_tl') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        @endif
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="@error('revenue')border border-danger rounded-3 @enderror">
                                    <input name="revenue" class="form-control" type="text" placeholder="{{ __('C Profit') }}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        id="revenue" value="{{ isset($data->revenue) ? $data->revenue : old('revenue') }}">
                                <label for="revenue" class="form-control-label">{{ __('CP') }}</label>
                                </div>
                                @error('revenue') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        @if(isset($data) && ($data->middleman == 1 || $data->user_id == 5))
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="@error('admin_partner')border border-danger rounded-3 @enderror">
                                    <input name="admin_partner" class="form-control" type="text" placeholder="{{ __('A Partner') }}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        id="admin_partner" value="{{ isset($data->admin_partner) ? $data->admin_partner : old('admin_partner') }}">
                                    <label for="admin_partner" class="form-control-label">{{ __('AP') }}</label>
                                </div>
                                @error('admin_partner') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        @endif
                        <?php
                            $show_part = false;

                            if(isset($data->users) && $data->users != null){
                                foreach($data->users as $user){
                                    if($user->type == "5" || $user->type == "3"){
                                        $show_part = true;
                                    }
                                }
                            }
                        ?>
                        @if($show_part == true)
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="@error('revenue_partner')border border-danger rounded-3 @enderror">
                                        <input name="revenue_partner" class="form-control" type="text" placeholder="{{ __('P Partner') }}"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                            id="revenue_partner" value="{{ isset($data->revenue_partner) ? $data->revenue_partner : old('revenue_partner') }}">
                                <label for="revenue_partner" class="form-control-label">{{ __('PP') }}</label>
                                    </div>
                                    @error('revenue_partner') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        @endif
                        @endif
                        @foreach($users as $key => $row)
                              @if($row->type == "2" || $row->type == "3" || $row->type == "5")
                                <?php $showcom = ""; ?>
                                @if(isset($data->users) && $data->users != null)
                                    @foreach($data->users as $key => $row_users)
                                        <?php
                                            if($row_users->id == $row->id){
                                                $showcom = "selected";
                                            }
                                        ?>
                                    @endforeach
                                @endif
                            @endif
                        @endforeach

                        <?php
                            $show_partd = false;
                            if(isset($data->users) && $data->users != null){
                                foreach($data->users as $user){
                                    if($user->type == "2" || $user->type == "5" || $user->type == "3"){
                                        $show_partd = true;
                                    }
                                }

                            }
                        ?>
                        @if($show_partd)
                        
                        @if(isset($aush) && $aush->type == 1)
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="@error('commission')border border-danger rounded-3 @enderror">
                                    <input name="commission" class="form-control" type="text" placeholder="{{ __('commission') }}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        id="commission" value="{{ isset($data->commission) ? $data->commission : old('commission') }}">
                                <label for="commission" class="form-control-label">{{ __('C') }}</label>
                                </div>
                                @error('commission') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <div class="@error('commission_type') border border-danger rounded-3 @enderror">
                                    <select name="commission_type" class="select form-control" id="commission_type">
                                      <option value="">{{ __('CUR') }}</option>
                                      <option value="$" {{ isset($data->commission_type) && $data->commission_type == "$" ? 'selected' : '' }}> $</option>
                                      <option value="TL" {{ isset($data->commission_type) && $data->commission_type == "TL" ? 'selected' : '' }}> TL</option>
                                      <option value="€" {{ isset($data->commission_type) && $data->commission_type == "€" ? 'selected' : '' }}> €</option>
                                      <option value="£" {{ isset($data->commission_type) && $data->commission_type == "£" ? 'selected' : '' }}> £</option>
                                    </select>
                                </div>
                                @error('commission_type') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        @endif
                        @if(isset($data) && ($data->middleman == 1 || $data->user_id == 5))
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="@error('admin_commission')border border-danger rounded-3 @enderror">
                                    <input name="admin_commission" class="form-control" type="text" placeholder="{{ __('Admin C') }}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        id="admin_commission" value="{{ isset($data->admin_commission) ? $data->admin_commission : old('admin_commission') }}">
                                <label for="admin_commission" class="form-control-label">{{ __('AC') }}</label>
                                </div>
                                @error('admin_commission') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <div class="@error('admin_commission_type') border border-danger rounded-3 @enderror">
                                    <select name="admin_commission_type" class="select form-control" id="admin_commission_type">
                                      <option value="">{{ __('CUR') }}</option>
                                      <option value="$" {{ isset($data->admin_commission_type) && $data->admin_commission_type == "$" ? 'selected' : '' }}> $</option>
                                      <option value="TL" {{ isset($data->admin_commission_type) && $data->admin_commission_type == "TL" ? 'selected' : '' }}> TL</option>
                                      <option value="€" {{ isset($data->admin_commission_type) && $data->admin_commission_type == "€" ? 'selected' : '' }}> €</option>
                                      <option value="£" {{ isset($data->admin_commission_type) && $data->admin_commission_type == "£" ? 'selected' : '' }}> £</option>
                                    </select>
                                </div>
                                @error('admin_commission_type') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        @endif
                        @endif
                        @if(isset($data))
                        @if(isset($data->sender_user) && $data->sender_user->user_id != null)
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="@error('sender_paid') border border-danger rounded-3 @enderror">
                                    <div class="checkbox {{ isset($data->paybyus) && $data->paybyus == "0" ? '' : 'bay' }} " style="margin-top: 11px;">
                                        <input name="sender_paid" type="checkbox"
                                            {{ isset($data->sender_paid) && $data->sender_paid == "1" ? 'checked' : '' }}
                                            placeholder="sender_paid" id="sender_paid" value="1">
                                            <label for="sender_paid">{{ isset($data->paybyus) && $data->paybyus == "0" ? __("COMPANY PAID") : __('Sender Paid') }}</label>
                                    </div>
                                </div>
                                @error('paybyus') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        @endif
                        @endif
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="@error('paybyus') border border-danger rounded-3 @enderror">
                                    <div class="checkbox bay" style="margin-top: 11px;">
                                        <input name="paybyus" type="checkbox"
                                            {{ isset($data->paybyus) && $data->paybyus == "1" ? 'checked' : '' }}
                                            placeholder="paybyus" id="paybyus" value="1">
                                            <label for="paybyus">{{ __('Paid By Us') }}</label>

                                    </div>
                                </div>
                                @error('paybyus') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        @if(isset($data))
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="@error('leader_paid') border border-danger rounded-3 @enderror">
                                        <div class="checkbox" style="margin-top: 11px;">
                                            <input name="leader_paid" type="checkbox"
                                                {{ isset($data->leader_paid) && $data->leader_paid == "1" ? 'checked' : '' }}
                                                placeholder="leader_paid" id="leader_paid" value="1">
                                                <label for="leader_paid">{{ isset($data->paybyus) && $data->paybyus == "1" ? __("COMPANY PAID") : __('Leader Paid') }}</label>
                                        </div>
                                    </div>
                                    @error('paybyus') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
    
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="@error('status') border border-danger rounded-3 @enderror">
                                        <div class="checkbox" style="margin-top: 11px;">
                                            <input name="status" type="checkbox"
                                                {{ $data->status == "1" ? 'checked' : '' }}
                                                placeholder="status" id="status" value="1">
                                                <label for="status">{{ __('PAID BY ALL') }}</label>
                                        </div>
                                    </div>
                                    @error('paybyus') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            {{--<div class="col-md-2">
                                <div class="form-group">
                                    <div class="@error('commit') border border-danger rounded-3 @enderror">
                                        <div class="checkbox" style="margin-top: 11px;">
                                            <input name="commit" type="checkbox"
                                                {{ isset($data->commit) && $data->commit == "1" ? 'checked' : '' }}
                                                placeholder="commit" id="commit" value="1">
                                                <label for="commit">{{ __('Reviewed') }}</label>
                                        </div>
                                    </div>
                                    @error('commit') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>--}}
                        @endif
                        @if(isset($data)  && $aush->id == 5)
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="@error('middleman') border border-danger rounded-3 @enderror">
                                    <div class="checkbox" style="margin-top: 11px;">
                                        <input name="middleman" type="checkbox"
                                            {{ isset($data->middleman) && $data->middleman == "1" ? 'checked' : '' }}
                                            placeholder="middleman" id="middleman" value="1">
                                            <label for="middleman">{{ __('Admin intermediary') }}</label>
                                    </div>
                                </div>
                                @error('middleman') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        @endif
                    </div>
                    @if(isset($data) && $data->type == "T & T")
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="@error('t_net')border border-danger rounded-3 @enderror">
                                        <input name="t_net" class="form-control" type="text" placeholder="{{ __('T net') }}"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                            id="t_net" value="{{ isset($data->t_net) ? $data->t_net : old('t_net') }}">
                                    <label for="t_net" class="form-control-label">{{ __('T net') }}</label>
                                    </div>
                                    @error('t_net') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <!--<div class="col-md-2">-->
                            <!--    <div class="form-group">-->
                            <!--        <div class="@error('t_profit')border border-danger rounded-3 @enderror">-->
                            <!--            <input name="t_profit" class="form-control" type="text" placeholder="{{ __(' profit') }}"-->
                            <!--oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"-->
                            <!--                id="t_profit" value="{{ isset($data->t_profit) ? $data->t_profit : old('t_profit') }}">-->
                            <!--        <label for="t_profit" class="form-control-label">{{ __(' profit') }}</label>-->
                            <!--        </div>-->
                            <!--        @error('t_profit') <div class="text-danger">{{ $message }}</div> @enderror-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div class="@error('t_paid') border border-danger rounded-3 @enderror">
                                        <div class="checkbox bay" style="margin-top: 11px;">
                                            <input name="t_paid" type="checkbox"
                                                {{ $data->t_paid == "1" ? 'checked' : '' }}
                                                placeholder="t_paid" id="t_paid" value="1">
                                                <label for="t_paid">{{ __('Ticket PAID By us') }}</label>
                                        </div>
                                    </div>
                                    @error('t_paid') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <div class="row mt-4">
                        <!--{{ $aush->type == 5 ? 'hidthis' : ''}}-->
                        <div class="col-md-6 ">
                            <div class="accordion" id="accordionExample2">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1" style="color: #1f233c;">
                                        <i class="fa fa-plus-circle mr-2"></i> {{ __('REGISTER BY') }}
                                        </button>
                                    </h2>
                                    <div id="collapseOne1" class="accordion-collapse collapse" aria-labelledby="headingOne1" data-bs-parent="#accordionExample2">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="@error('user_id') border border-danger rounded-3 @enderror">
                                                            <select name="user_id" class="select form-control" id="user_id">
                                                              <option value=""></option>
                                                              @foreach($nusers as $key => $row)
                                                                  @if($row->type == "1" || $row->type == "5")
                                                                    <?php
                                                                    $select = "";
                                                                        if(!isset($data->user_id) && $aush->type == 5 && $row->id == $aush->id){
                                                                            $select = "selected";
                                                                        }
                                                                        if(!isset($data->user_id) && $aush->type == 1 && $row->id == $aush->id){
                                                                            $select = "selected";
                                                                        }
                                                                        if($row->id == @$data->user_id){
                                                                            $select = "selected";
                                                                        }
                                                                    ?>
                                                                    <option value="{{$row->id}}" {{ $select }}> {{$row->full_name}}</option>
                                                                  @endif
                                                              @endforeach
                                                            </select>
                                                        </div>
                                                        @error('user_id') <div class="text-danger">{{ $message }}</div> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($aush->type == 1)
                        @if(isset($data->leader_user->user_id) && $data->leader_user->user_id == 27)
                        <div class="col-md-6">
                            <div class="accordion" id="accordionExampletax">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne1tax">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne1tax" aria-expanded="true" aria-controls="collapseOne1tax" style="color: #1f233c;">
                                        <i class="fa fa-plus-circle mr-2"></i> {{ __('ADD TAX') }}
                                        </button>
                                    </h2>
                                    <div id="collapseOne1tax" class="accordion-collapse collapse" aria-labelledby="headingOne1tax" data-bs-parent="#accordionExampletax">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="@error('tax')border border-danger rounded-3 @enderror">
                                                            <input name="tax" class="form-control" type="text" placeholder="{{ __('tax') }}" autocomplete="off"
                                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                                                id="tax" value="{{ isset($data->tax) ? $data->tax : old('tax') }}">
                                                            <label for="tax" class="form-control-label">{{ __('tax') }}</label>
                                                        </div>
                                                        @error('tax') <div class="text-danger">{{ $message }}</div> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif
                    </div>
                    
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="color: red;">
                                <i class="fa fa-hand-o-right mr-2"></i> CLICK HERE FOR CLIENT NOTIFICATION
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="@error('to_user_id') border border-danger rounded-3 @enderror">
                                                    <select name="to_user_id[]" class="select form-control" multiple id="to_user_id">
                                                    <option value="">{{ __('Accounts') }}</option>
                                                        @foreach($nusers as $key => $row)
                                                            <?php $select = ""; ?>
                                                            @if(isset($data->notification->users))
                                                                @foreach($data->notification->users as $us)
                                                                    @if($us->id == $row->id)
                                                                        <?php $select = "selected"; ?>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                            @if($aush->type == 5)
                                                                @if($row->type == 1)
                                                                <option value="{{$row->id}}" data-type="{{$row->type}}" {{ $select }}>{{$row->full_name}}</option>
                                                                @endif
                                                            @else
                                                                <option value="{{$row->id}}" {{ $select }}>{{$row->full_name}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="@error('ntext')border border-danger rounded-3 @enderror">
                                                    <textarea  name="ntext" rows="4" class="form-control">{{ isset($data->notification) ? $data->notification->text : old('ntext') }}</textarea>
                                                </div>
                                                @error('ntext') <div class="text-danger">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4 savebtnsw">{{ 'Save Changes' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
  @push('panel_js')

  @endpush
@stop
