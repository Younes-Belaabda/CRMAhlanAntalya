<style>
    .typeswicon i {
        font-size: 14px;
    }

    .typeswicon i.fa.fa-car {
        font-size: 16px;
    }

    .form-check.form-switch.ps-0.check_center.goblue .form-check-input {
        border: 1px solid #00fff0;
        background-color: rgb(0 255 240 / 10%);
    }

    .form-switch.goblue .form-check-input:after {
        background-color: rgb(0 255 240);
    }

    .has_old .upspan i {
        font-size: 8px;
        margin-bottom: 0;
        height: 0px;
        line-height: 4px;
    }

    .has_old .upspan {
        float: left;
        width: 10px;
        font-size: 12px;
        position: absolute;
        left: -42px;
        width: 35px !important;
        height: 35px;
        background: #252f40;
        border-radius: 50%;
        line-height: 35px;
        color: #fff;
        cursor: pointer;
        top: 8px;
    }

    .has_old {
        position: relative;
    }

    .has_old .upspan i {
        display: block;
        padding-top: 7px;
    }

    .not_has p {
        margin-top: 8px;
    }

    .redcolrer {
        color: red !important;
    }
</style>
<?php
$colors = '#ffffff';
if ($row->color == '1') {
    $colors = '#ff0000';
} elseif ($row->color == '2') {
    $colors = '#fffc00';
} elseif ($row->color == '3') {
    $colors = '#12ff00';
} elseif ($row->color == '4') {
    $colors = '#00fff0';
} elseif ($row->color == '5') {
    $colors = '#ffc107';
}
$color = '';
$red = false;
if ($colors == '#ff0000') {
    $red = true;
    $color = 'background:' . $colors . ';color:#fff;';
}
if ($colors != '#ffffff') {
    $color = 'background:' . $colors . ';color:#fff;';
    if ($colors != '#ff0000') {
        $color = 'background:' . $colors . ';color:#333;';
    }
}
?>
<?php $aush = Auth()->user();
$old_Con = 0; ?>

<?php $rosw = 0;
$tj_date = date('Y-m-d'); ?>
@foreach ($data_old as $ol_row)
    @if ($ol_row->to_date == $row->date && !isset($ol_row->useing) && $row->date == $tj_date)
        <?php
        $rosw++;
        $ol_row->useing = true;
        ?>
    @endif
@endforeach
@if (@$request['st'] == 'p')
    @foreach ($data as $ds1)
        @foreach ($ds1 as $ds12)
            <?php $ds12 = $ds12->where('color', 4); ?>
            @foreach ($ds12 as $prev_row)
                @if ($prev_row->to_date == $row->date && !isset($prev_row->useing) && $row->date == $tj_date)
                    <?php
                    $rosw++;
                    $prev_row->useing = true;
                    ?>
                @endif
            @endforeach
        @endforeach
    @endforeach
@endif
<tr id="tr_{{ date('d-M', strtotime($row->date)) }}" class="{{ $keysyes }} {{ $red == true ? 'sredcol' : '' }}"
    color="{{ $row->color }}">
    <td style="{{ $color }}" class="{{ $old_this == true ? 'CPRV' : '' }}  {{ $rosw != 0 ? 'has_old' : '' }}">

        @if (request()->has('d_user') && request()->get('d_user') != null)
            <input type="checkbox" value="{{ $row->movement_id }}" class="mouvements_boxes">
        @endif


        @if ($rosw != 0)
            <span class="upspan" style="float: left;width: 10px;"><i class="fa fa-arrow-up"></i>
                {{ $rosw }}</span>
        @endif
        <p class="text-xs font-weight-bold mb-0">{{ $old_this == true ? 'PRV' : $OldCount + $key + 1 }}</p>
        <div class="itemsmobilew">
            <a href="{{ route('panel.movement.add_new', $row->movement_id) }}" class="mx-1" data-bs-toggle="tooltip"
                data-bs-original-title="Edit entries">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>
            <a data-url="{{ route('panel.movement.delete', $row->movement_id) }}" class="mx-1 delete"
                data-bs-toggle="tooltip" data-bs-original-title="Delete entries">
                <i class="cursor-pointer fas fa-trash text-danger"></i>
            </a>
            <?php
            $sho = false;
            $date = Carbon\Carbon::parse($row->date);
            $now = Carbon\Carbon::now();
            //dd($date , $now , $date >= $now);
            //if($date >= $now){
            $diff = $date->diffInDays($now);
            if ($diff == 0) {
                $sho = true;
            }

            if ($row->to_date != null) {
                $to_date = Carbon\Carbon::parse($row->to_date);
                $now2 = Carbon\Carbon::now();
                $diff2 = $to_date->diffInDays($now2);
                if ($diff2 == 0 && $diff >= 0) {
                    $sho = true;
                }
            }
            //}
            ?>
            @if ($sho)
                <div class="form-check form-switch ps-0 check_center">
                    <input class="form-check-input ms-auto is-displayed"
                        data-url="{{ route('panel.movement.change_status', $row->movement_id) }}" type="checkbox"
                        id="flexSwitchCheckDefault" {{ $row->completed == 1 ? 'checked' : '' }}>
                </div>
            @endif
        </div>
    </td>
    <td class="text-center {{ $red == true ? 'redcol' : '' }} {{ $row->to_date == '' ? 'not_has' : '' }}"
        style="{{ $color }}">
        <?php
        $to_date_1 = Carbon\Carbon::parse($row->to_date);
        $now = Carbon\Carbon::now()->format('Y-m-d');
        ?>
        <p>
            <b class="text-xst font-weight-bold mb-0">{{ date('d M', strtotime($row->date)) }}</b>
            @if ($row->to_date != null)
                <b
                    class="text-xst font-weight-bold mb-0 {{ $to_date_1 == $now && $row->completed != 1 ? 'redcolrer' : '' }}">{{ date('d M', strtotime($row->to_date)) }}</b>
            @endif
        </p>
        <p class="showmobile">
            <?php
            $month = date('M', strtotime($row->date));
            $month2 = date('M', strtotime($row->to_date));
            $date = date('d M', strtotime($row->date));
            if ($row->to_date != null) {
                if ($month != $month2) {
                    $date = date('d M', strtotime($row->date)) . ' - ' . date('d M', strtotime($row->to_date));
                } else {
                    $date = date('d', strtotime($row->date)) . ' - ' . date('d M', strtotime($row->to_date));
                }
            }
            echo $date;
            ?>
        </p>
    </td>
    <td class="text-center {{ $red == true ? 'redcol' : '' }}" style="{{ $color }}">
        <p class="text-xst font-weight-bold mb-0 typeswicon" title="{{ $row->type }}">
            @if ($row->type == 'Transfers')
                <i class="fas fa-user-clock"></i>
            @elseif($row->type == 'Driver Tours')
                <i class="fa fa-car"></i>
            @elseif($row->type == 'Group Tours')
                <i class="fas fa-bus-alt"></i>
            @elseif($row->type == 'hotels')
                <i class="fas fa-bed"></i>
            @elseif($row->type == 'Flights')
                <i class="fas fa-plane-departure"></i>
            @elseif($row->type == 'Other Services')
                <i class="fa fa-check-circle"></i>
            @elseif($row->type == 'T & T')
                <i class="fas fa-id-card-alt"></i>
            @else
                {{ $row->type }}
            @endif
            @if ($row->time != null && $row->to_time == null)
                {{ $row->time }}
            @elseif($row->to_time != null)
                {{ $row->to_time }}
            @endif
        </p>
    </td>
    <td class="text-center {{ $red == true ? 'redcol' : '' }}" style="{{ $color }}">
        <p class="text-xst font-weight-bold mb-0">
            {{ $row->customer }}

            @if (isset($row->notification) && $row->notification != null)
                <i class="fa fa-bell"></i>
            @endif
        </p>

    </td>
    <td class="text-center {{ $red == true ? 'redcol' : '' }} cusmob" style="{{ $color }}">
        <p class="text-xst font-weight-bold mb-0">
            {{ \Str::limit(@$row->country->name, 3, '') }}
        </p>
        <p class="showmobile">{{ @$row->country->name }}</p>
    </td>
    <td class="text-center {{ $red == true ? 'redcol' : '' }}" style="{{ $color }}">
        <p class="text-xst font-weight-bold mb-0">{{ $row->description }}</p>
    </td>
    <!--<td class="text-center" style="{{ $color }}">-->
    <!--    <p class="text-xsm font-weight-bold mb-0">{{ $row->type }}</p>-->
    <!--</td>-->
    <?php

    $colorv = 'background:' . @$row->m_user->background . ';color:#fff;';
    ?>

    @if (isset($ispartner->type) && $ispartner->type == 1)
    @else
        <td class="user" style="{{ $colorv }}">
            @if (isset($row->middleman) && $row->middleman == '1' && $row->m_user->id != $maher_user->id)
                <a class="text-xst font-weight-bold mb-0" href="{{ url('/admin/entries?d_user=' . @$maher_user->id) }}"
                    style="background:{{ @$maher_user->background }};color:{{ @$maher_user->color }}">{{ @$maher_user->user_name }}</a>
            @endif
            <a class="text-xst font-weight-bold mb-0" href="{{ url('/admin/entries?d_user=' . $row->m_user->id) }}"
                style="background:{{ @$row->m_user->background }};color:{{ @$row->m_user->color }}">{{ $row->m_user->user_name }}</a>
        </td>
    @endif

    <?php
    $st = '';
    if (sizeof(@$row->users) == 1) {
        $usw = $row->users->first();
        $st = 'background:' . @$usw->background . ';color:' . @$usw->color . '';
    } elseif (isset($request['d_user'])) {
        $usw = $row->users->where('id', '!=', $request['d_user'])->first();
        $st = 'background:' . @$usw->background . ';color:' . @$usw->color . '';
    }
    ?>
    @if ($aush->type == 1 || $aush->type == 2 || $aush->type == 5)
        <td class="user" style="{{ $st }}">
            <?php
            $useme1 = '';
            $useme2 = '';
            if (isset($request['d_user']) && sizeof(@$row->users) == 1) {
                if ($request['d_user'] == $row->users->first()->id) {
                    $useme2 = '<a class="text-xsm font-weight-bold mb-0" href="' . url('/admin/entries?d_user=' . $row->users->first()->id) . '" style="background:' . $row->users->first()->background . ';color:' . $row->users->first()->color . '">DIRECT</a>';
                } else {
                    $useme2 = '<a class="text-xsm font-weight-bold mb-0" href="' . url('/admin/entries?d_user=' . $row->users->first()->id) . '" style="background:' . $row->users->first()->background . ';color:' . $row->users->first()->color . '">' . $row->users->first()->full_name . '</a>';
                }
            }
            ?>
            @foreach ($row->musers as $user)
                <?php
                if (isset($request['d_user']) && sizeof($row->users) == 1) {
                } else {
                    if (isset($request['d_user'])) {
                        if ($request['d_user'] == $user->user->id) {
                        } else {
                            if ($user->type == 0) {
                                $useme2 .= '<a class="text-xsm font-weight-bold mb-0" href="' . url('/admin/entries?d_user=' . $user->user->id) . '"style="background:' . @$user->user->background . ';color:' . @$user->user->color . '">' . @$user->user->full_name . '</a>';
                            } else {
                                $useme1 .= '<a class="text-xsm font-weight-bold mb-0" href="' . url('/admin/entries?d_user=' . $user->user->id) . '" style="background:' . @$user->user->background . ';color:' . @$user->user->color . '">' . @$user->user->full_name . '</a>';
                            }
                        }
                    } else {
                        if ($user->type == 0) {
                            $useme2 .= '<a class="text-xsm font-weight-bold mb-0" href="' . url('/admin/entries?d_user=' . $user->user->id) . '" style="background:' . @$user->user->background . ';color:' . @$user->user->color . '">' . @$user->user->full_name . '</a>';
                        } else {
                            $useme1 .= '<a class="text-xsm font-weight-bold mb-0" href="' . url('/admin/entries?d_user=' . $user->user->id) . '" style="background:' . @$user->user->background . ';color:' . @$user->user->color . '">' . @$user->user->full_name . '</a>';
                        }
                        //$useme2 .= '<a class="text-xsm font-weight-bold mb-0" href="/admin/entries?d_user='.$user->id.'" style="background:'.@$user->background.';color:'.@$user->color.'">'.@$user->full_name .'</a>';
                    }
                }
                ?>
            @endforeach
            <?php echo $useme1 . $useme2; ?>
        </td>
    @endif
    <?php
    if ($row->status == '1') {
        $color = 'background:#12ff00;color:#333;';
    } else {
        $color = 'background:#2196f366;color:#333;';
    }
    if ($row->paybyus == '1') {
        $color = 'background:#fffc00;color:#333;';
    }
    ?>

    <?php
    $cs_clore0 = $color;
    if (($row->sender_paid == '1' && $row->paybyus == '1') || $row->status == 1) {
        $cs_clore0 = 'background:#12ff00;color:#333;';
    }
    if ($row->leader_paid == '1' && $row->paybyus == '0') {
        $cs_clore0 = 'background:#12ff00;color:#333;';
    }
    ?>

    <td class="user psw" style="{{ $cs_clore0 }}">
        @if ($aush->type == 3)
            @if ($row->sec_price == null)
                {{ $row->price_type }} {{ $row->price }}
                @if ($row->paybyus == '1' && $row->sender_paid == 0 && $row->sender_user != null)
                    <i class="fa fa-clock-o"></i>
                @elseif($row->sender_paid == '1' && $row->paybyus == '1' && $row->sender_user != null)
                    <i class="fa fa-arrow-right"></i>
                @elseif($row->paybyus == '0' && $row->revenue_partner != null)
                    <!--<i class="fa fa-arrow-right"></i>-->
                @elseif($row->paybyus == '1' && $row->sender_paid == 0 && $row->sender_user != null)
                    <i class="fa fa-clock-o"></i>
                @endif
            @else
                <div>
                    <span>P1</span>
                    <span class="text-xst font-weight-bold mb-0 _0">{{ $row->price_type }} {{ $row->price }}
                </div>
                <div>
                    <span>P2</span>
                    <span class="text-xst font-weight-bold mb-0 _0">{{ $row->sec_price_type }} {{ $row->sec_price }}
                </div>
            @endif
        @else
            @if ($row->commission != 0 || $row->admin_commission != 0)
                <div>
                    <span>P1</span>
                    <span class="text-xst font-weight-bold mb-0 _0">{{ $row->price_type }} {{ $row->price }}

                        @if (isset($ispartner->type) && $ispartner->type == 5)
                            @if ($row->paybyus == '1' && isset($is_partner) && $is_partner == true)
                                <i class="fa fa-arrow-right"></i>
                            @endif
                        @else
                            @if ($row->sender_paid == '1' && $row->paybyus == '1')
                                <i class="fa fa-arrow-right"></i>
                            @elseif($row->paybyus == '0' && $row->revenue_partner != null)
                                <!--<i class="fa fa-arrow-left"></i>-->
                            @elseif($row->paybyus == '1' && $row->sender_paid == 0 && isset($row->sebder_user) && $row->sebder_user != null)
                                <i class="fa fa-clock-o"></i>
                            @endif
                        @endif
                    </span>
                </div>
                @if ($row->sec_price != null)
                    <div>
                        <span>P2</span>
                        <span class="text-xst font-weight-bold mb-0 _0">{{ $row->sec_price_type }}
                            {{ $row->sec_price }}
                    </div>
                @endif
                @if ($row->commission != 0)
                    <div>
                        <span>CC</span>
                        <span class="text-xst font-weight-bold mb-0">{{ $row->commission_type }}
                            {{ $row->commission }}</span>
                    </div>
                @endif
                @if ($row->admin_commission != 0)
                    <div>
                        <span>AC</span>
                        <span class="text-xst font-weight-bold mb-0">{{ $row->admin_commission_type }}
                            {{ $row->admin_commission }}</span>
                    </div>
                @endif
            @endif
            @if ($row->commission == 0 && $row->admin_commission == 0)
                @if ($row->sec_price == null)
                    <p class="text-xst font-weight-bold mb-0 _1" {{ $row->sender_paid }}>
                        {{ $row->price_type . ' ' . $row->price }}
                        @if (isset($ispartner->type) && $ispartner->type == 5)
                            @if ($row->paybyus == '1' && $row->sender_paid == 0 && $row->sender_user != null)
                                <i class="fa fa-clock-o"></i>
                            @endif
                        @else
                            @if ($row->sender_paid == '1' && $row->paybyus == '1' && $row->sebder_user != null)
                                <i class="fa fa-arrow-right"></i>
                            @elseif($row->paybyus == '0' && $row->revenue_partner != null)
                                <!--<i class="fa fa-arrow-right"></i>-->
                            @elseif($row->paybyus == '1' && $row->sender_paid == 0 && $row->sebder_user != null)
                                <?php //&& isset($row->sebder_user) && $row->sebder_user != null
                                ?>
                                <i class="fa fa-clock-o"></i>
                            @endif
                        @endif
                    </p>
                @else
                    <div>
                        <span>P1</span>
                        <span class="text-xst font-weight-bold mb-0 _0">{{ $row->price_type }} {{ $row->price }}
                    </div>
                    <div>
                        <span>P2</span>
                        <span class="text-xst font-weight-bold mb-0 _0">{{ $row->sec_price_type }}
                            {{ $row->sec_price }}
                    </div>
                @endif
            @endif
        @endif
    </td>
    @if (isset($request['d_user']) && $request['d_user'] != null)

        <?php
        $cs_clore = $color;
        if ($row->leader_paid == '1') {
            $cs_clore = 'background:#12ff00;color:#333;';
        }
        $cs_clore_t = $color;
        if ($row->t_paid == '1') {
            $cs_clore_t = 'background:#fffc00;color:#333;';
        } else {
            $cs_clore_t = 'background:#a6d5fa;color:#333;';
        }
        ?>
        @if ($aush->type != 3)
            <td class="user psw" style="{{ $cs_clore }}">
                @if ($row->net_tl != 0)
                    <div>
                        <span>{{ $row->price_type }}</span>
                        <span class="text-xst font-weight-bold mb-0">{{ $row->net }}</span>
                    </div>
                    <div>
                        <span>TL</span>
                        <span class="text-xst font-weight-bold mb-0">
                            {{ $row->net_tl }}
                            @if (isset($ispartner->type) && $ispartner->type == 5)
                                @if ($row->paybyus == '1' && isset($is_partner) && $is_partner == true && $row->leader_paid == 0)
                                    <!--<i class="fa fa-arrow-right"></i>-->
                                @elseif($row->paybyus == '1' && $row->leader_paid == 1)
                                    <i class="fa fa-arrow-up"></i>
                                @elseif($row->paybyus == '1')
                                    <i class="fa fa-arrow-left"></i>
                                @endif
                            @elseif($row->paybyus == '1' && $row->leader_paid == 1)
                                <i class="fa fa-arrow-up"></i>
                            @elseif($row->paybyus == '0')
                                <!--<i class="fa fa-exchange"></i>-->
                            @endif
                        </span>
                    </div>
                @endif
                @if ($row->net_tl == 0)
                    <p class="text-xst font-weight-bold mb-0">
                        {{ $row->price_type . ' ' . $row->net }}
                        @if (isset($ispartner->type) && $ispartner->type == 5)
                            @if ($row->paybyus == '1' && isset($is_partner) && $is_partner == true && $row->leader_paid == 0)
                                <!--<i class="fa fa-arrow-right"></i>-->
                            @elseif($row->paybyus == '1' && $ispartner->id == @$row->leader_user->id)
                                <i class="fa fa-arrow-left"></i>
                            @elseif($row->paybyus == '1' && $row->leader_paid == 1)
                                <i class="fa fa-arrow-up"></i>
                            @elseif($row->paybyus == '0')
                                <i class="fa fa-exchange"></i>
                            @endif
                        @elseif($row->paybyus == '1' && $row->leader_paid == 1)
                            <i class="fa fa-arrow-up"></i>
                        @elseif($row->paybyus == '0')
                            <i class="fa fa-exchange"></i>
                        @endif
                    </p>
                @endif
                @if ($row->t_net != 0)
                    <div style="{{ $cs_clore_t }}">
                        <span>TN</span>
                        <span class="text-xst font-weight-bold mb-0">{{ $row->price_type . ' ' . $row->t_net }}</span>
                    </div>
                @endif
            </td>
        @endif

        <?php
        $cs_clore1 = $color;
        if ($row->status == '1' && $row->paybyus == '1') {
            $cs_clore1 = 'background:#12ff00;color:#333;';
        }
        ?>

        <td class="user psw" style="{{ $cs_clore1 }}">
            @if ($aush->type == 3)
                @if ($row->revenue_partner != null)
                    {{ $row->price_type . ' ' . $row->revenue_partner }} <i class="fa fa-arrow-left"></i>
                @else
                    -
                @endif
            @else
                @if ($row->admin_partner != null || $row->revenue_partner != null)

                    <?php
                    $cs_clore0w = '';
                    if ($row->leader_paid == '1' && $row->paybyus == '0') {
                        $cs_clore0w = 'background:#12ff00;color:#333;';
                    }
                    ?>
                    <div style="{{ $cs_clore0w }}">
                        <span>CP</span>
                        <span class="text-xst font-weight-bold mb-0">{{ $row->price_type . ' ' . $row->revenue }}
                            @if ($row->paybyus == '1' && isset($is_partner) && $is_partner == true)
                                <i class="fa fa-arrow-left"></i>
                            @elseif($row->paybyus == '0' && isset($is_partner) && $is_partner == true)

                            @elseif($row->paybyus == '0' && isset($is_partner) && $is_partner == true)
                                <i class="fa fa-arrow-right"></i>
                            @endif
                        </span>
                    </div>
                @endif
                @if (isset($row->revenue_partner) && $row->revenue_partner != null)
                    <div class="{{ $row->sender_paid == 1 ? 'paid_div' : '' }}">
                        <span>PP</span>
                        <span
                            class="text-xst font-weight-bold mb-0">{{ $row->price_type . ' ' . $row->revenue_partner }}
                            @if (isset($ispartner->type) && $ispartner->type == 5)
                                @if ($row->paybyus == '1' && isset($is_partner) && $is_partner == true)
                                    <i class="fa fa-arrow-left"></i>
                                @elseif($row->paybyus == '0' && isset($is_partner) && $is_partner == true)
                                    <i class="fa fa-arrow-left"></i>
                                @elseif($row->paybyus == '0')
                                    <i class="fa fa-arrow-right"></i>
                                @endif
                            @else
                                <i class="fa fa-arrow-left"></i>
                            @endif
                        </span>
                    </div>
                @endif
                @if (isset($row->admin_partner) && $row->admin_partner != null)
                    <?php
                    $cs_clore0w = '';
                    if ($row->leader_paid == '1' && $row->paybyus == '0') {
                        $cs_clore0w = 'background:#12ff00;color:#333;';
                    }
                    ?>
                    <div style="{{ $cs_clore0w }}">
                        <span>AP</span>
                        <span
                            class="text-xst font-weight-bold mb-0">{{ $row->price_type . ' ' . $row->admin_partner }}</span>
                    </div>
                @endif
                @if (isset($row->tax) && $row->tax != 0)
                    <div>
                        <span>TX</span>
                        <span class="text-xst font-weight-bold mb-0">{{ $row->price_type . ' ' . $row->tax }}</span>
                    </div>
                @endif
                @if ($row->admin_partner == null && $row->revenue_partner == null)
                    <p class="text-xst font-weight-bold mb-0">{{ $row->price_type . ' ' . $row->revenue }}
                        @if (isset($ispartner->type) && $ispartner->type == 5)
                            @if ($row->paybyus == '1' && isset($is_partner) && $is_partner == true)
                                <!--<i class="fa fa-arrow-right"></i>-->
                            @elseif($row->paybyus == '0' && isset($is_partner) && $is_partner == true)
                                <i class="fa fa-arrow-down"></i>
                            @endif
                        @endif
                    </p>
                @endif
                @if ($row->t_profit != 0)
                    <div>
                        <span>TP</span>
                        <span
                            class="text-xst font-weight-bold mb-0">{{ $row->price_type . ' ' . $row->t_profit }}</span>
                    </div>
                @endif
            @endif
        </td>
    @endif
    @if ($aush->type == 1 || ($aush->type == 5 && $aush->id == $row->user_id))
        <td class="text-center cusmobhide">
            <a href="{{ route('panel.movement.add_new', $row->movement_id) }}" class="mx-1"
                data-bs-toggle="tooltip" data-bs-original-title="Edit entries">
                <i class="fas fa-user-edit text-secondary"></i>
            </a>
            <a data-url="{{ route('panel.movement.delete', $row->movement_id) }}" class="mx-1 delete"
                data-bs-toggle="tooltip" data-bs-original-title="Delete entries">
                <i class="cursor-pointer fas fa-trash text-danger"></i>
            </a>
            <?php
            $sho = false;
            $goblue = false;
            $to_date = '';
            $now2 = '';
            $diff2 = '';
            $date = Carbon\Carbon::parse($row->date);
            $now = Carbon\Carbon::now();
            //dd($date , $now , $date >= $now);
            //if($date >= $now){
            $diff = $date->diffInDays($now);
            if ($diff == 0) {
                $sho = true;
                $goblue = false;
            }

            if ($row->to_date != null) {
                $to_date = Carbon\Carbon::parse($row->to_date);
                $now2 = Carbon\Carbon::now();
                $diff2 = $to_date->diffInDays($now2);
                if ($diff2 == 0 && $diff >= 0) {
                    $sho = true;
                }
                if ($diff >= 0 && $row->color == 1) {
                    $sho = false;
                    $goblue = true;
                }
            }
            if ($date >= $now) {
                $sho = false;
                if ($diff2 == 0) {
                    $sho = true;
                }
                $goblue = false;
            }
            if ($row->color == 3) {
                $sho = false;
            }
            if ($row->color == 4) {
                $sho = true;
            }
            //}
            ?>
            @if ($goblue)
                <div class="form-check form-switch ps-0 check_center goblue">
                    <input class="form-check-input ms-auto is-displayed"
                        data-url="{{ route('panel.movement.change_statusr', $row->movement_id) }}" type="checkbox"
                        id="flexSwitchCheckDefault" {{ $row->color == 4 ? 'checked' : '' }}>
                </div>
            @endif
            @if ($sho && $goblue == false)
                <div class="form-check form-switch ps-0 check_center">
                    <input class="form-check-input ms-auto is-displayed"
                        data-url="{{ route('panel.movement.change_status', $row->movement_id) }}" type="checkbox"
                        id="flexSwitchCheckDefault" {{ $row->completed == 1 ? 'checked' : '' }}>
                </div>
            @endif
        </td>
    @endif
</tr>
