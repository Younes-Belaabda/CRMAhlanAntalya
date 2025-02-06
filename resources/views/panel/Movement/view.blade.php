@extends('panel.layouts.base', ['is_main' => true])

@section('sub_title')
    @isset($ispartner)
        {{ strtoupper($ispartner->full_name) }}
    @else
        View entries
    @endisset
@endsection


@section('content')
    @push('panel_css')
    @endpush
    <Style>
        .table tr td.CPRV:first-child p {
            color: #fff !important;
        }

        table.table.ets tbody td p {
            font-size: 12px !important;
            padding: 8px !important;
        }

        .table tr td.CPRV:first-child {
            background: red !important;
            color: #fff !important;
        }

        .text-xst {
            font-size: 11px !important;
        }

        .table.align-items-center td,
        .table.align-items-center th {
            max-width: 15%;
            white-space: inherit;
        }

        .form-check {
            display: inline-block;
        }

        .td-5 th {
            width: 15% !important;
        }

        td.user.psw div span {
            float: right;
            color: #000;
            width: Calc(100% - 40%);
            text-align: center;
            padding: 0;
            font-weight: bold !important;
        }

        .paid_div {
            background: #12ff00;
        }

        td.user.psw {
            padding: 0 !important;
        }

        td.user.psw div span:first-child {
            border-right: 1px solid #000;
            font-size: 12px;
            width: 40%;
            float: left;
            margin: 0;
        }

        td.user.psw div:last-child {

            border-bottom: 0;
        }

        td.user.psw div {
            float: right;
            width: 100%;
            margin: 0;
            border-bottom: 1px solid #000;
        }

        table.table tbody td.redcol p.showmobile,
        .redcol .text-xst {
            color: #fff !important;
        }
    </Style>

    <?php $aush = Auth()->user(); ?>
    <?php
    $_1_1 = 0;
    $_1_2 = 0;
    $_1_3 = 0;
    $_1_4 = 0;
    $_2_1 = 0;
    $_2_2 = 0;
    $_2_3 = 0;
    $_2_4 = 0;
    $_3_1 = 0;
    $_3_2 = 0;
    $_3_3 = 0;
    $_3_4 = 0;
    $_4_1 = 0;
    $tod1 = date('M', strtotime($cur_today));
    $tod2 = date('d', strtotime($cur_today));
    ?>
    <style>
        .text-xsm {
            font-size: 0.75rem !important;
        }

        .flag img {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
            overflow: hidden;
            border-radius: 50%;
            height: 100%;
        }

        .flag {
            position: relative;
            display: inline-block;
            width: 22px;
            height: 22px;
            overflow: hidden;
            margin-bottom: -2px;
            margin-top: 4px;
        }

        ul.munths a.selected {
            background-color: #252f40;
            border-color: #252f40;
            color: #fff;
        }

        ul.munths.wn a {
            min-width: 28px;
            width: auto;
        }

        ul.munths a {
            float: right;
            width: 28px;
            height: 28px;
            border: 1px solid #ddd;
            font-size: 12px;
            text-align: center;
            line-height: 28px;
            border-radius: 5px;
        }

        ul.munths li {
            float: left;
            margin-right: 5px;
        }

        ul.munths {
            display: inline-block;
            margin-right: 5px;
            list-style: none;
            padding: 0;
            margin-bottom: -5px;
        }

        .checkbox.sus label {
            padding-left: 0;
            font-size: 16px;
            padding-right: 30px;
        }

        .checkbox.sus label:before {
            width: 25px;
            height: 25px;
            right: 0;
            left: auto !important;
        }

        .checkbox.sus label:after {
            width: 25px !important;
            height: 25px !important;
            right: 0;
            left: auto !important;
            font-size: 14px !important;
            line-height: 24px !important;
        }

        .munths li a.datecolor {
            color: red;
        }

        .munths li a.datecolor.selected {
            color: #fff;
            background-color: red;
            border-color: red;
        }

        span.caldn i {
            position: absolute;
            left: 0;
            top: 0;
            font-size: 42px;
        }

        .caldn2>i {
            position: absolute;
            left: 0;
            top: 0;
            font-size: 42px;
        }

        .caldn2 b,
        span.caldn b {
            position: absolute;
            left: 0;
            width: 100%;
            top: 3px;
            color: #fff;
            font-size: 12px;
            background: #252f40;
            z-index: 1;
            text-align: center;
            height: 17px;
            line-height: 17px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
            text-transform: uppercase;
        }

        span.caldn {
            float: left;
            width: 36px;
            height: 42px;
            position: relative;
            overflow: hidden;
            margin-right: 55px;
            margin-top: -10px;
            color: #252f40;
            cursor: pointer;
        }

        .caldnf2 {
            float: left;
            width: 36px;
            height: 42px;
            margin-right: 55px;
            margin-top: -10px;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .caldn2 {
            float: left;
            width: 36px;
            height: 42px;
            position: relative;
            overflow: hidden;
            color: #252f40;
            cursor: pointer;
            border: 0;
            background: transparent;
        }

        .caldn2 small i {
            color: #252f40;
        }

        .caldn2 small {
            position: absolute;
            left: 0;
            width: 100%;
            bottom: 2px;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            background: #00fff0;
        }

        span.caldn small {
            position: absolute;
            left: 0;
            width: 100%;
            bottom: 2px;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            color: #E91E63;
        }

        .item_ent li small,
        .item_ent li {
            font-weight: bold;
            color: #000;
        }

        .modal-title .caldn {
            float: none;
            display: inline-block;
            margin-bottom: -10px;
            margin-left: 15px;
            cursor: auto;
        }

        .item_ent ul {
            list-style: none;
            padding: 0;
            margin-bottom: 0;
        }

        .item_ent li {
            margin-bottom: 7px;
        }

        .modal-title>b {
            cursor: pointer;
        }

        p.text-xst.font-weight-bold.mb-0.typeswicon i {
            display: block;
        }

        ul.munths.wn.showonmobile {
            display: none;
        }

        @media(max-width:996px) {

            span.caldn2,
            .caldnf2,
            span.caldn {
                display: inline-block;
                float: none;
                margin: 0 10px 0 15px;
            }

            .munths.wn {
                display: none;
            }

            .munths.wn.showonmobile {
                display: block !important;
                float: right;
                width: 100%;
                padding: 4px 4%;
                text-align: center;
                height: 37px;
            }

            ul.munths.wn.showonmobile li {
                float: none;
                display: inline-block;
            }

            ul.munths.wn.showonmobile li a {
                width: auto !important;
                float: right;
                width: 100% !important;
            }
        }
    </style>







    <div class="row">
        <div class="col-12" style="position: relative;">
            <div class="card mb-4 mx-4 pb-2 filters_All" style="position: sticky;right: 0;left: 17%;z-index: 3;top: 4px;">
                <a class="filter_btn"><i class="fa fa-times"></i></i></a>
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1 show_accro">
                                Filter entries
                            </h5>
                        </div>
                        <div style="margin-right:45px">
                            <?php
                            $url = Route('panel.movement.view') . '?';
                            if (isset($request['d_user']) && $request['d_user']) {
                                $url .= '&d_user=' . $request['d_user'];
                            }

                            if (isset($request['type']) && $request['type']) {
                                $url .= '&type=' . $request['type'];
                            }

                            if (isset($request['m_type']) && $request['m_type']) {
                                $url .= '&m_type=' . $request['m_type'];
                            }

                            if (isset($request['country_id']) && $request['country_id']) {
                                $url .= '&country_id=' . $request['country_id'];
                            }

                            if (isset($request['st']) && $request['st']) {
                                $url .= '&st=' . $request['st'];
                            }

                            $nows = \Carbon\Carbon::now();
                            $now = $nows->month;
                            $tnow = $nows->month;
                            $year = $nows->year;
                            if (isset($request['from_date']) && $request['from_date'] != null) {
                                $nows = \Carbon\Carbon::parse($request['from_date']);
                                $now = $nows->month;
                                $year = $nows->year;
                            }
                            $cons = 0;

                            foreach ($data as $key => $ye) {
                                foreach ($ye as $key_yes => $yes) {
                                    foreach ($yes as $key_yes => $swwww) {
                                        if ($swwww->color == 4) {
                                            $cons++;
                                        }
                                    }
                                }
                            }

                            ?>
                            @if ($aush->type == 1)
                                <span class="caldn" data-toggle="modal"
                                    data-target="#exampleModal"><b>{{ $tod1 }}</b><small>{{ $tod2 }}</small><i
                                        class="far fa-calendar"></i></span>

                                @if ($cons != 0)
                                    <form action="{{ Route('panel.movement.view') }}" class="caldnf2" method="Get"
                                        role="form text-left">
                                        <input type="hidden" name="showblue" value="4">
                                        <button class="caldn2"><b>Now</b><small>{{ $cons }}</small><i
                                                class="far fa-calendar" aria-hidden="true"></i></button>
                                    </form>
                                @endif

                                @if (auth()->user()->type == 1 &&
                                        @$request['d_user'] == null &&
                                        (@$request['from_date'] == null || @$request['to_date'] == null))
                                    <ul class="munths wn showonmobile">
                                        <?php
                                        $url2 = Route('panel.movement.view') . '?';
                                        if (isset($request['d_user']) && $request['d_user']) {
                                            $url2 .= '&d_user=' . $request['d_user'];
                                        }

                                        if (isset($request['type']) && $request['type']) {
                                            $url2 .= '&type=' . $request['type'];
                                        }

                                        if (isset($request['m_type']) && $request['m_type']) {
                                            $url2 .= '&m_type=' . $request['m_type'];
                                        }

                                        if (isset($request['country_id']) && $request['country_id']) {
                                            $url2 .= '&country_id=' . $request['country_id'];
                                        }
                                        if (isset($request['from_date']) && $request['from_date']) {
                                            $url2 .= '&from_date=' . $request['from_date'];
                                        }
                                        if (isset($request['to_date']) && $request['to_date']) {
                                            $url2 .= '&to_date=' . $request['to_date'];
                                        }
                                        ?>
                                        <li><a href="{{ $url2 . '&st=p' }}"
                                                class='{{ @$request['st'] == 'p' ? 'selected' : '' }}'>Progress</a></li>
                                        <li><a href="{{ $url2 . '&st=c' }}"
                                                class='{{ @$request['st'] == 'c' ? 'selected' : '' }}'>Completed</a></li>
                                        <li><a href="{{ $url2 . '&st=f' }}"
                                                class='{{ @$request['st'] == 'f' ? 'selected' : '' }}'>Full</a></li>
                                    </ul>
                                @endif
                            @endif
                            <ul class="munths">
                                <?php
                                $its = \App\Models\Movement::where('completed', '0')->whereBetween('date', [$year . '-01-01', $year . '-01-31']);
                                if (isset($request['d_user']) && $request['d_user'] && isset($ispartner) && $ispartner->type != 1) {
                                    $its = $its->wherehas('users', function (Illuminate\Database\Eloquent\Builder $query) use ($request) {
                                        $query->where('id', $request['d_user']);
                                    });
                                } elseif (isset($ispartner) && $ispartner->id == 5) {
                                    $its = $its->where('user_id', $ispartner->id);
                                }
                                $its = $its->get()->Count();

                                if ($tnow == '01') {
                                    $its = 0;
                                }
                                ?>
                                <li><a href="{{ $url . '&from_date=' . $year . '-01-01&to_date=' . $year . '-01-31' }}"
                                        class='{{ $its >= 1 ? 'datecolor' : '' }} {{ $now == 1 ? 'selected' : '' }}'>01</a>
                                </li>
                                <?php
                                $its = \App\Models\Movement::where('completed', '0')->whereBetween('date', [$year . '-02-01', $year . '-02-31']);
                                if (isset($request['d_user']) && $request['d_user'] && isset($ispartner) && $ispartner->type != 1) {
                                    $its = $its->wherehas('users', function (Illuminate\Database\Eloquent\Builder $query) use ($request) {
                                        $query->where('id', $request['d_user']);
                                    });
                                } elseif (isset($ispartner) && $ispartner->id == 5) {
                                    $its = $its->where('user_id', $ispartner->id);
                                }
                                $its = $its->get()->Count();

                                if ($tnow == '02') {
                                    $its = 0;
                                }
                                ?>
                                <li><a href="{{ $url . '&from_date=' . $year . '-02-01&to_date=' . $year . '-02-31' }}"
                                        class='{{ $its >= 1 ? 'datecolor' : '' }} {{ $now == 2 ? 'selected' : '' }}'>02</a>
                                </li>
                                <?php
                                $its = \App\Models\Movement::where('completed', '0')->whereBetween('date', [$year . '-03-01', $year . '-03-31']);
                                if (isset($request['d_user']) && $request['d_user'] && isset($ispartner) && $ispartner->type != 1) {
                                    $its = $its->wherehas('users', function (Illuminate\Database\Eloquent\Builder $query) use ($request) {
                                        $query->where('id', $request['d_user']);
                                    });
                                } elseif (isset($ispartner) && $ispartner->id == 5) {
                                    $its = $its->where('user_id', $ispartner->id);
                                }
                                $its = $its->get()->Count();

                                if ($tnow == '03') {
                                    $its = 0;
                                }
                                ?>
                                <li><a href="{{ $url . '&from_date=' . $year . '-03-01&to_date=' . $year . '-03-31' }}"
                                        class='{{ $its >= 1 ? 'datecolor' : '' }} {{ $now == 3 ? 'selected' : '' }}'>03</a>
                                </li>
                                <?php
                                $its = \App\Models\Movement::where('completed', '0')->whereBetween('date', [$year . '-04-01', $year . '-04-31']);
                                if (isset($request['d_user']) && $request['d_user'] && isset($ispartner) && $ispartner->type != 1) {
                                    $its = $its->wherehas('users', function (Illuminate\Database\Eloquent\Builder $query) use ($request) {
                                        $query->where('id', $request['d_user']);
                                    });
                                } elseif (isset($ispartner) && $ispartner->id == 5) {
                                    $its = $its->where('user_id', $ispartner->id);
                                }
                                $its = $its->get()->Count();

                                if ($tnow == '04') {
                                    $its = 0;
                                }
                                ?>
                                <li><a href="{{ $url . '&from_date=' . $year . '-04-01&to_date=' . $year . '-04-31' }}"
                                        class='{{ $its >= 1 ? 'datecolor' : '' }} {{ $now == 4 ? 'selected' : '' }}'>04</a>
                                </li>
                                <?php
                                $its = \App\Models\Movement::where('completed', '0')->whereBetween('date', [$year . '-05-01', $year . '-05-31']);
                                if (isset($request['d_user']) && $request['d_user'] && isset($ispartner) && $ispartner->type != 1) {
                                    $its = $its->wherehas('users', function (Illuminate\Database\Eloquent\Builder $query) use ($request) {
                                        $query->where('id', $request['d_user']);
                                    });
                                } elseif (isset($ispartner) && $ispartner->id == 5) {
                                    $its = $its->where('user_id', $ispartner->id);
                                }
                                $its = $its->get()->Count();

                                if ($tnow == '05') {
                                    $its = 0;
                                }
                                ?>
                                <li><a href="{{ $url . '&from_date=' . $year . '-05-01&to_date=' . $year . '-05-31' }}"
                                        class='{{ $its >= 1 ? 'datecolor' : '' }} {{ $now == 5 ? 'selected' : '' }}'>05</a>
                                </li>
                                <?php
                                $its = \App\Models\Movement::where('completed', '0')->whereBetween('date', [$year . '-06-01', $year . '-06-31']);
                                if (isset($request['d_user']) && $request['d_user'] && isset($ispartner) && $ispartner->type != 1) {
                                    $its = $its->wherehas('users', function (Illuminate\Database\Eloquent\Builder $query) use ($request) {
                                        $query->where('id', $request['d_user']);
                                    });
                                } elseif (isset($ispartner) && $ispartner->id == 5) {
                                    $its = $its->where('user_id', $ispartner->id);
                                }
                                $its = $its->get()->Count();

                                if ($tnow == '06') {
                                    $its = 0;
                                }
                                ?>
                                <li><a href="{{ $url . '&from_date=' . $year . '-06-01&to_date=' . $year . '-06-31' }}"
                                        class='{{ $its >= 1 ? 'datecolor' : '' }} {{ $now == 6 ? 'selected' : '' }}'>06</a>
                                </li>
                                <?php
                                $its = \App\Models\Movement::where('completed', '0')->whereBetween('date', [$year . '-07-01', $year . '-07-31']);
                                if (isset($request['d_user']) && $request['d_user'] && isset($ispartner) && $ispartner->type != 1) {
                                    $its = $its->wherehas('users', function (Illuminate\Database\Eloquent\Builder $query) use ($request) {
                                        $query->where('id', $request['d_user']);
                                    });
                                } elseif (isset($ispartner) && $ispartner->id == 5) {
                                    $its = $its->where('user_id', $ispartner->id);
                                }
                                $its = $its->get()->Count();

                                if ($tnow == '07') {
                                    $its = 0;
                                }
                                ?>
                                <li><a href="{{ $url . '&from_date=' . $year . '-07-01&to_date=' . $year . '-07-31' }}"
                                        class='{{ $its >= 1 ? 'datecolor' : '' }} {{ $now == 7 ? 'selected' : '' }}'>07</a>
                                </li>
                                <?php
                                $its = \App\Models\Movement::where('completed', '0')->whereBetween('date', [$year . '-08-01', $year . '-08-31']);
                                if (isset($request['d_user']) && $request['d_user'] && isset($ispartner) && $ispartner->type != 1) {
                                    $its = $its->wherehas('users', function (Illuminate\Database\Eloquent\Builder $query) use ($request) {
                                        $query->where('id', $request['d_user']);
                                    });
                                } elseif (isset($ispartner) && $ispartner->id == 5) {
                                    $its = $its->where('user_id', $ispartner->id);
                                }
                                $its = $its->get()->Count();
                                if ($tnow == '08') {
                                    $its = 0;
                                }
                                ?>
                                <li><a href="{{ $url . '&from_date=' . $year . '-08-01&to_date=' . $year . '-08-31' }}"
                                        class='{{ $its >= 1 ? 'datecolor' : '' }} {{ $now == 8 ? 'selected' : '' }}'>08</a>
                                </li>
                                <?php
                                $its = \App\Models\Movement::where('completed', '0')->whereBetween('date', [$year . '-09-01', $year . '-09-31']);
                                if (isset($request['d_user']) && $request['d_user'] && isset($ispartner) && $ispartner->type != 1) {
                                    $its = $its->wherehas('users', function (Illuminate\Database\Eloquent\Builder $query) use ($request) {
                                        $query->where('id', $request['d_user']);
                                    });
                                } elseif (isset($ispartner) && $ispartner->id == 5) {
                                    $its = $its->where('user_id', $ispartner->id);
                                }
                                $its = $its->get()->Count();
                                if ($tnow == '09') {
                                    $its = 0;
                                }
                                ?>
                                <li><a href="{{ $url . '&from_date=' . $year . '-09-01&to_date=' . $year . '-09-31' }}"
                                        class='{{ $its >= 1 ? 'datecolor' : '' }} {{ $now == 9 ? 'selected' : '' }}'>09</a>
                                </li>
                                <?php
                                $its = \App\Models\Movement::where('completed', '0')->whereBetween('date', [$year . '-10-01', $year . '-10-31']);
                                if (isset($request['d_user']) && $request['d_user'] && isset($ispartner) && $ispartner->type != 1) {
                                    $its = $its->wherehas('users', function (Illuminate\Database\Eloquent\Builder $query) use ($request) {
                                        $query->where('id', $request['d_user']);
                                    });
                                } elseif (isset($ispartner) && $ispartner->id == 5) {
                                    $its = $its->where('user_id', $ispartner->id);
                                }
                                $its = $its->get()->Count();

                                if ($tnow == '10') {
                                    $its = 0;
                                }
                                ?>
                                <li><a href="{{ $url . '&from_date=' . $year . '-10-01&to_date=' . $year . '-10-31' }}"
                                        class='{{ $its >= 1 ? 'datecolor' : '' }} {{ $now == 10 ? 'selected' : '' }}'>10</a>
                                </li>
                                <?php
                                $its = \App\Models\Movement::where('completed', '0')->whereBetween('date', [$year . '-11-01', $year . '-11-31']);
                                if (isset($request['d_user']) && $request['d_user'] && isset($ispartner) && $ispartner->type != 1) {
                                    $its = $its->wherehas('users', function (Illuminate\Database\Eloquent\Builder $query) use ($request) {
                                        $query->where('id', $request['d_user']);
                                    });
                                } elseif (isset($ispartner) && $ispartner->id == 5) {
                                    $its = $its->where('user_id', $ispartner->id);
                                }
                                $its = $its->get()->Count();

                                if ($tnow == '11') {
                                    $its = 0;
                                }
                                ?>
                                <li><a href="{{ $url . '&from_date=' . $year . '-11-01&to_date=' . $year . '-11-31' }}"
                                        class='{{ $its >= 1 ? 'datecolor' : '' }} {{ $now == 11 ? 'selected' : '' }}'>11</a>
                                </li>
                                <?php
                                $its = \App\Models\Movement::where('completed', '0')->whereBetween('date', [$year . '-12-01', $year . '-12-31']);
                                if (isset($request['d_user']) && $request['d_user'] && isset($ispartner) && $ispartner->type != 1) {
                                    $its = $its->wherehas('users', function (Illuminate\Database\Eloquent\Builder $query) use ($request) {
                                        $query->where('id', $request['d_user']);
                                    });
                                } elseif (isset($ispartner) && $ispartner->id == 5) {
                                    $its = $its->where('user_id', $ispartner->id);
                                }
                                $its = $its->get()->Count();

                                if ($tnow == '12') {
                                    $its = 0;
                                }
                                ?>
                                <li><a href="{{ $url . '&from_date=' . $year . '-12-01&to_date=' . $year . '-12-31' }}"
                                        class='{{ $its >= 1 ? 'datecolor' : '' }} {{ $now == 12 ? 'selected' : '' }}'>12</a>
                                </li>
                            </ul>
                            <a id="export_pdf" class="btn bg-gradient-dark btn-sm mb-2 export_pdf" type="button">Export
                                PDF</a>
                            @if ($aush->type == 1 || $aush->type == 5)
                                <a href="{{ route('panel.movement.add_new') }}" class="btn bg-gradient-dark btn-sm mb-2"
                                    type="button">+&nbsp; New entry</a>
                            @endif
                            @if ($aush->type == 1 || $aush->type == 5)
                                @if (request()->has('d_user') && request()->get('d_user') != null)
                                    <button class="btn-note caldn btn bg-gradient-dark btn-sm mb-2" style="height: 28px">
                                        GO
                                    </button>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body px-4 pt-0 pb-0 mb-0 hide_accro">
                    <form action="{{ Route('panel.movement.view') }}" method="Get" role="form text-left">
                        @csrf
                        <div class="row">
                            @if ($aush->type == 1)
                                <div class="col-lg-2 col-md-4">
                                    <div class="form-group">
                                        <label for="d_user" class="form-control-label">{{ __('User') }}</label>
                                        <div class="@error('d_user') border border-danger rounded-3 @enderror">
                                            <select name="d_user" class="select form-control" id="d_user">
                                                <option value="">Choose</option>
                                                @foreach ($users as $key => $row)
                                                    <option value="{{ $row->id }}"
                                                        {{ isset($request['d_user']) && $request['d_user'] == $row->id ? 'selected' : '' }}>
                                                        {{ $row->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <input type="hidden" name="d_user" value="{{ $request['d_user'] }}" />
                            @endif
                            <div class="col-lg-2 col-md-4">
                                <div class="form-group">
                                    <label for="from_date" class="form-control-label">{{ __('From Date') }}</label>
                                    <div class="@error('from_date') border border-danger rounded-3 @enderror">
                                        <input class="form-control datepicker" autocomplete="off" name="from_date"
                                            value='{{ @$request['from_date'] }}'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4">
                                <div class="form-group">
                                    <label for="to_date" class="form-control-label">{{ __('To Date') }}</label>
                                    <div class="@error('to_date') border border-danger rounded-3 @enderror">
                                        <input class="form-control datepicker" autocomplete="off" name="to_date"
                                            value='{{ @$request['to_date'] }}'>
                                    </div>
                                </div>
                            </div>
                            @if ($aush->type == 1)
                                <div class="col-lg-2 col-md-4">
                                    <div class="form-group">
                                        <label for="type" class="form-control-label">{{ __('User Type') }}</label>
                                        <div class="@error('type') border border-danger rounded-3 @enderror">
                                            <select name="type" class="select form-control" id="type">
                                                <option value="">Choose</option>
                                                <option value="1"
                                                    {{ isset($request['type']) && $request['type'] == '1' ? 'selected' : '' }}>
                                                    Admin</option>
                                                <option value="2"
                                                    {{ isset($request['type']) && $request['type'] == '2' ? 'selected' : '' }}>
                                                    Driver</option>
                                                <option value="3"
                                                    {{ isset($request['type']) && $request['type'] == '3' ? 'selected' : '' }}>
                                                    Agent</option>
                                                <option value="4"
                                                    {{ isset($request['type']) && $request['type'] == '4' ? 'selected' : '' }}>
                                                    Vendor</option>
                                                <option value="5"
                                                    {{ isset($request['type']) && $request['type'] == '5' ? 'selected' : '' }}>
                                                    Partner</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-lg-2 col-md-4">
                                <div class="form-group">
                                    <label for="m_type" class="form-control-label">{{ __('Movement Type') }}</label>
                                    <div class="@error('m_type') border border-danger rounded-3 @enderror">
                                        <select name="m_type" class="select form-control" id="m_type">
                                            <option value="">Choose</option>
                                            <option value="Transfers"
                                                {{ isset($request['m_type']) && $request['m_type'] == 'Transfers' ? 'selected' : '' }}>
                                                Transfers</option>
                                            <option value="Driver Tours"
                                                {{ isset($request['m_type']) && $request['m_type'] == 'Driver Tours' ? 'selected' : '' }}>
                                                Driver Tours</option>
                                            <option value="Group Tours"
                                                {{ isset($request['m_type']) && $request['m_type'] == 'Group Tours' ? 'selected' : '' }}>
                                                Group Tours</option>
                                            <!--<option value="Car Rental" {{ isset($request['m_type']) && $request['m_type'] == 'Car Rental' ? 'selected' : '' }}>Car Rental</option>-->
                                            <option value="hotels"
                                                {{ isset($request['m_type']) && $request['m_type'] == 'hotels' ? 'selected' : '' }}>
                                                Hotels</option>
                                            <option value="Flights"
                                                {{ isset($request['m_type']) && $request['m_type'] == 'Flights' ? 'selected' : '' }}>
                                                Flights</option>
                                            <option value="T & T"
                                                {{ isset($request['m_type']) && $request['m_type'] == 'T & T' ? 'selected' : '' }}>
                                                T & T</option>
                                            <option value="Other Services"
                                                {{ isset($request['m_type']) && $request['m_type'] == 'Other Services' ? 'selected' : '' }}>
                                                Other Services</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @if ($aush->type == 1)
                                <div class="col-lg-2 col-md-4">
                                    <div class="form-group">
                                        <label for="country_id" class="form-control-label">{{ __('country') }}</label>
                                        <div class="@error('country_id') border border-danger rounded-3 @enderror">
                                            <select name="country_id" class="select form-control" id="country_id">
                                                <option value="">Choose</option>
                                                @foreach ($countries as $key => $row)
                                                    <option value="{{ $row->countries_id }}"
                                                        {{ isset($request['country_id']) && $request['country_id'] == $row->countries_id ? 'selected' : '' }}>
                                                        {{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit"
                                class="btn bg-gradient-dark btn-md mt-2 mb-2">{{ 'Go Filter' }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mb-4 mx-4 mt-2">
                <div id="exp_pdf" class="card-body px-3 pt-0 pb-2 cls">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between mb-2">
                            <div>
                                <?php
                                $t1 = 0;
                                $t2 = 0;
                                $t3 = 0;
                                if (isset($ispartner) && $ispartner->type != 1) {
                                    foreach ($data as $key => $ye) {
                                        foreach ($ye as $key_yes => $yes) {
                                            $t1 += sumAmountByCurrencyAllsNets($yes, null, '$');
                                            $t2 += sumAmountByCurrencyAllsNets($yes, null, 'TL');
                                            $t3 += sumAmountByCurrencyAllsNets($yes, null, '€');
                                        }
                                    }
                                }
                                ?>
                                <h5 class="mb-1">All entries
                                    ({{ $NowCount }}{{ isset($ispartner) && $ispartner->type == 5 ? ' & ' . @$NowCount2 : '' }})
                                    @if (isset($ispartner))
                                        @if ($ispartner->type == 5)
                                            , Ahlan Antalya &
                                            {{ $ispartner->full_name }}{{ ($ispartner->s_usd != 0 || $ispartner->s_p != 0 || $ispartner->s_e != 0 || $ispartner->s_tl != 0) == true ? '' : '' }}
                                            <!--    <span>-->
                                            <!--    {{ $ispartner->blance_usd == 0 ? '' : " $ " . $ispartner->blance_usd }}-->
                                            <!--    {{ $ispartner->blance_usd != 0 && $ispartner->blance_tl != 0 ? ' & ' : '' }}-->
                                            <!--    {{ $ispartner->blance_tl == 0 ? '' : ' TL ' . $ispartner->blance_tl }}-->
                                            <!--    {{ $ispartner->blance_tl != 0 && $ispartner->blance_e != 0 ? ' & ' : '' }}-->
                                            <!--    {{ $ispartner->blance_e == 0 ? '' : ' € ' . $ispartner->blance_e }}-->
                                            <!--    {{ $ispartner->blance_e != 0 && $ispartner->blance_p != 0 ? ' & ' : '' }}-->
                                            <!--    {{ $ispartner->blance_p == 0 ? '' : ' £ ' . $ispartner->blance_p }}-->
                                            <!--    </span>-->
                                            <!--    @if (
                                                ($aush->type == 1 && $ispartner->blance_usd != 0) ||
                                                    $ispartner->blance_tl != 0 ||
                                                    $ispartner->blance_e != 0 ||
                                                    $ispartner->blance_p != 0)
    -->
                                            <!--    <div class="checkbox sus" style="margin-top: 4px;float: right;width: auto;">-->
                                            <!--        <input name="paids" type="checkbox" placeholder="paids" id="paids" value="1">-->
                                            <!--        <label for="paids"> <span>,</span> {{ __('Paid Done') }}</label>-->
                                            <!--    </div>-->
                                            <!--    <form id="form_paids" action="{{ Route('panel.movement.paid') }}" method="post" role="form text-left" style="display:none;float: right;margin-top: -2px;margin-left: 5px;">-->
                                            <!--        @csrf-->
                                            <!--        <input type="hidden" name="from_date" value="{{ @$request['from_date'] }}" />-->
                                            <!--        <input type="hidden" name="to_date" value="{{ @$request['to_date'] }}" />-->
                                            <!--        <input type="hidden" name="d_user" value="{{ @$request['d_user'] }}" />-->
                                            <!--        <input type="hidden" name="type" value="{{ @$request['type'] }}" />-->
                                            <!--        <input type="hidden" name="m_type" value="{{ @$request['m_type'] }}" />-->
                                            <!--        <input type="hidden" name="country_id" value="{{ @$request['country_id'] }}" />-->
                                            <!--    </form>-->
                                            <!--
    @endif-->
                                        @elseif($ispartner->id == 5)
                                            ,
                                            {{ $ispartner->full_name }}{{ ($ispartner->blance_usd != 0 || $ispartner->blance_tl != 0 || $ispartner->blance_e != 0 || $ispartner->blance_p != 0) == true ? '' : '' }}
                                        @else
                                            ,
                                            {{ $ispartner->full_name }}{{ (($ispartner->s_usd != 0 || $ispartner->s_p != 0 || $ispartner->s_e != 0 || $ispartner->s_tl != 0) && $ispartner->id != 25) == true ? '' : ($ispartner->id == 25 && $ispartner->blance_tlgn != 0 ? '' : '') }}
                                            <!--{{ ($t1 != 0 || $t2 != 0 || $t3 != 0 || @$ispartner->blance != 0 || $ispartner->blance_usd != 0) == true ? '' : '' }}-->
                                        @endif


                                        <!--@if ($ispartner->type == 3)-->
                                        <!--<span>-->
                                        <!-- {{ $ispartner->blance < 0 ? '-' : '' }}-->
                                        <!-- {{ $ispartner->blance != 0 ? ($ispartner->blance < 0 ? "$" . abs($ispartner->blance) : "$" . $ispartner->blance) : '' }}-->
                                        <!-- </span>-->
                                        <!-- @if ($aush->type == 1 && $ispartner->blance != 0)
    -->
                                        <!--    <div class="checkbox sus" style="margin-top: 0;width: auto;display: inline-block;float: none;margin-bottom: -11px;margin-right:10px;">-->
                                        <!--        <input name="paids" type="checkbox" placeholder="paids" id="paids" value="1">-->
                                        <!--        <label for="paids"> <span>,</span> {{ __('Paid Done') }}</label>-->
                                        <!--    </div>-->
                                        <!--    <form id="form_paids" action="{{ Route('panel.movement.paid') }}" method="post" role="form text-left" style="display:none;float: right;margin-top: -2px;margin-left: 5px;">-->
                                        <!--        @csrf-->
                                        <!--        <input type="hidden" name="from_date" value="{{ @$request['from_date'] }}" />-->
                                        <!--        <input type="hidden" name="to_date" value="{{ @$request['to_date'] }}" />-->
                                        <!--        <input type="hidden" name="d_user" value="{{ @$request['d_user'] }}" />-->
                                        <!--        <input type="hidden" name="type" value="{{ @$request['type'] }}" />-->
                                        <!--        <input type="hidden" name="m_type" value="{{ @$request['m_type'] }}" />-->
                                        <!--        <input type="hidden" name="country_id" value="{{ @$request['country_id'] }}" />-->
                                        <!--    </form>-->
                                        <!--
    @endif-->
                                        <!--@endif-->

                                        @if (
                                            ($ispartner->type == 2 || $ispartner->type == 4 || $ispartner->type == 3 || $ispartner->type == 5) &&
                                                ($ispartner->id != 25 && $ispartner->id != 27 && $ispartner->id != 34))
                                            <span>
                                                {{-- {{ $ispartner->s_usd == null || $ispartner->s_usd == 0 ? '' : " $ " . $ispartner->s_usd }}
                                                {{ $ispartner->s_usd != 0 && $ispartner->s_p != 0 ? ' & ' : '' }}
                                                {{ $ispartner->s_p == null || $ispartner->s_p == 0 ? '' : ' £ ' . $ispartner->s_p }}
                                                {{ ($ispartner->s_usd != 0 || $ispartner->s_p != 0) && $ispartner->s_e != 0 ? ' & ' : '' }}
                                                {{ $ispartner->s_e == null || $ispartner->s_e == 0 ? '' : ' € ' . $ispartner->s_e }}
                                                {{ ($ispartner->s_usd != 0 || $ispartner->s_p != 0 || $ispartner->s_e != 0) && $ispartner->s_tl != 0 ? ' & ' : '' }}
                                                {{ $ispartner->s_tl == null || $ispartner->s_tl == 0 ? '' : ' TL ' . $ispartner->s_tl }} --}}
                                            </span>
                                            @if ($aush->type == 1)
                                                @if (
                                                    ($aush->type == 1 && $ispartner->s_usd != 0) ||
                                                        $ispartner->s_p != 0 ||
                                                        $ispartner->s_e != 0 ||
                                                        $ispartner->s_tl != 0)
                                                    {{-- <div class="checkbox sus"
                                                        style="margin-top: 0;width: auto;display: inline-block;float: none;margin-bottom: -11px;margin-right:10px;">
                                                        <input name="paids" type="checkbox" placeholder="paids"
                                                            id="paids" value="1">
                                                        <label for="paids"> <span>,</span>
                                                            {{ __('Paid Done') }}</label>
                                                    </div> --}}
                                                    <form id="form_paids" action="{{ Route('panel.movement.paid') }}"
                                                        method="post" role="form text-left"
                                                        style="display:none;float: right;margin-top: -2px;margin-left: 5px;">
                                                        @csrf
                                                        <input type="hidden" name="from_date"
                                                            value="{{ @$request['from_date'] }}" />
                                                        <input type="hidden" name="to_date"
                                                            value="{{ @$request['to_date'] }}" />
                                                        <input type="hidden" name="d_user"
                                                            value="{{ @$request['d_user'] }}" />
                                                        <input type="hidden" name="type"
                                                            value="{{ @$request['type'] }}" />
                                                        <input type="hidden" name="m_type"
                                                            value="{{ @$request['m_type'] }}" />
                                                        <input type="hidden" name="country_id"
                                                            value="{{ @$request['country_id'] }}" />
                                                    </form>
                                                @endif
                                            @endif
                                        @endif

                                        @if ($ispartner->id == 25)
                                            {{-- <span>
                                                {{ $ispartner->blance_tlgn != 0 ? ' TL ' . $ispartner->blance_tlgn : '' }}
                                            </span> --}}
                                            @if ($aush->type == 1 && $ispartner->blance_tlgn != 0)
                                                {{-- <div class="checkbox sus"
                                                    style="margin-top: 4px;float: right;width: auto;">
                                                    <input name="paids" type="checkbox" placeholder="paids"
                                                        id="paids" value="1">
                                                    <label for="paids"> <span>,</span> {{ __('Paid Done') }}</label>
                                                </div> --}}
                                                <form id="form_paids" action="{{ Route('panel.movement.paid') }}"
                                                    method="post" role="form text-left"
                                                    style="display:none;float: right;margin-top: -2px;margin-left: 5px;">
                                                    @csrf
                                                    <input type="hidden" name="from_date"
                                                        value="{{ @$request['from_date'] }}" />
                                                    <input type="hidden" name="to_date"
                                                        value="{{ @$request['to_date'] }}" />
                                                    <input type="hidden" name="d_user"
                                                        value="{{ @$request['d_user'] }}" />
                                                    <input type="hidden" name="type"
                                                        value="{{ @$request['type'] }}" />
                                                    <input type="hidden" name="m_type"
                                                        value="{{ @$request['m_type'] }}" />
                                                    <input type="hidden" name="country_id"
                                                        value="{{ @$request['country_id'] }}" />
                                                </form>
                                            @endif
                                        @endif

                                        @if ($ispartner->id == 27 || $ispartner->id == 34)
                                            {{-- <span>
                                                {{ $ispartner->blance_usd != 0 ? " $" . $ispartner->blance_usd : '' }}
                                                {{ $ispartner->blance_p != 0 ? '& £' . $ispartner->blance_p : '' }}
                                                {{ $ispartner->blance_e != 0 ? '& €' . $ispartner->blance_e : '' }}
                                                {{ $ispartner->blance_tl != 0 ? '& TL' . $ispartner->blance_tl : '' }}
                                            </span> --}}
                                            , Maher
                                            {{-- <span>{{ $ispartner->Mblance_usd != 0 ? ": $" . $ispartner->Mblance_usd : '' }}
                                                {{ $ispartner->Mblance_p != 0 ? '& £' . $ispartner->Mblance_p : '' }}
                                                {{ $ispartner->Mblance_e != 0 ? '& €' . $ispartner->Mblance_e : '' }}
                                                {{ $ispartner->Mblance_tl != 0 ? '& TL' . $ispartner->Mblance_tl : '' }}
                                            </span> --}}
                                        @endif
                                    @endif
                                </h5>
                            </div>
                            <div>
                                @if (auth()->user()->type == 1 &&
                                        @$request['d_user'] == null &&
                                        (@$request['from_date'] == null || @$request['to_date'] == null))
                                    <ul class="munths wn">
                                        <?php
                                        $url2 = Route('panel.movement.view') . '?';
                                        if (isset($request['d_user']) && $request['d_user']) {
                                            $url2 .= '&d_user=' . $request['d_user'];
                                        }

                                        if (isset($request['type']) && $request['type']) {
                                            $url2 .= '&type=' . $request['type'];
                                        }

                                        if (isset($request['m_type']) && $request['m_type']) {
                                            $url2 .= '&m_type=' . $request['m_type'];
                                        }

                                        if (isset($request['country_id']) && $request['country_id']) {
                                            $url2 .= '&country_id=' . $request['country_id'];
                                        }
                                        if (isset($request['from_date']) && $request['from_date']) {
                                            $url2 .= '&from_date=' . $request['from_date'];
                                        }
                                        if (isset($request['to_date']) && $request['to_date']) {
                                            $url2 .= '&to_date=' . $request['to_date'];
                                        }
                                        ?>
                                        <li><a href="{{ $url2 . '&st=p' }}"
                                                class='{{ @$request['st'] == 'p' ? 'selected' : '' }}'>Progress</a></li>
                                        <li><a href="{{ $url2 . '&st=c' }}"
                                                class='{{ @$request['st'] == 'c' ? 'selected' : '' }}'>Completed</a></li>
                                        <li><a href="{{ $url2 . '&st=f' }}"
                                                class='{{ @$request['st'] == 'f' ? 'selected' : '' }}'>Full</a></li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- <div class="table-responsive p-0"> -->

                    @foreach ($data as $key => $ye)
                        @foreach ($ye as $key_yes => $yes)
                            <?php
                            $ispartnerprofit = sumProfitPartnerAll($yes, null, null);
                            $is = 0;
                            $iss = 0;
                            $isss = 0;
                            $issss = 0;

                            $cs = 0;
                            $css = 0;
                            $csss = 0;
                            $cssss = 0;

                            $date = '';
                            foreach ($ye as $k => $it) {
                                $date = $k;
                            }
                            ?>
                            <table class="table forprint align-items-center mb-0">
                                <thead>
                                    <tr class="bg">
                                        <th colspan="20">
                                            @if (isset($ispartner) && $ispartner->type == 5)
                                                Send By Ahlan Antalya <br>
                                            @else
                                                {{ $date }}
                                            @endif
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                            <table class="table forprint align-items-center mb-2">
                                <thead>
                                    @include('panel.Movement.headertable')
                                </thead>
                                <tbody>
                                    <?php $old_this = true;
                                    $keysyes = ''; ?>
                                    @foreach ($data_old as $row)
                                        <?php
                                        $row_show = false;
                                        if (isset($request['st']) && $request['st'] == 'c' && $row->completed == 1) {
                                            $row_show = true;
                                        } elseif (isset($request['st']) && $request['st'] == 'p' && $row->completed == 0) {
                                            $row_show = true;
                                        } elseif (isset($request['st']) && $request['st'] == 'f' && ($row->completed == 1 || $row->completed == 0)) {
                                            $row_show = true;
                                        }
                                        ?>
                                        @if ($row_show == true)
                                            @include('panel.Movement.table')
                                        @endif
                                    @endforeach

                                    <?php $old_this = false; ?>
                                    @include('panel.Movement.table2')
                                </tbody>
                            </table>

                            <!-- </div> -->

                            @if (isset($ispartner))
                                @if ($ispartner->id == 5 || $ispartner->type == 3 || $ispartner->type == 5 || $ispartner->type == 1)
                                @else
                                    @if ($ispartner->id == 25)
                                        @include('panel.Movement.price')
                                    @else
                                        @include('panel.Movement.nets')
                                    @endif
                                @endif
                            @endif

                            @if (isset($ispartner) && $ispartner->type == 5)
                                @include('panel.Movement.nets')
                            @endif

                            @if (isset($request['d_user']) &&
                                    $request['d_user'] != null &&
                                    (isset($user_m) && $user_m->type != 1) &&
                                    auth()->user()->type != 1)
                            @else
                                @if (isset($ispartner) && $ispartner->type == 5)
                                    @include('panel.Movement.profit')
                                    @if (Auth()->user()->type == 1)
                                        @include('panel.Movement.profitAdmin')
                                    @endif
                                @else
                                    {{-- @if (Auth()->user()->type == 1 && Auth()->user()->id != 5) --}}
                                    @if (Auth()->user()->type == 1)
                                        @if (isset($ispartner->type) && $ispartner->id == 5)
                                        @endif
                                        @include('panel.Movement.profitAdmin')
                                        @include('panel.Movement.profit')
                                    @endif
                                    <!--&& Auth()->user()->id == 5 && isset($ispartner) && $ispartner->id == 5-->
                                    @if (Auth()->user()->type == 1 && isset($ispartner) && $ispartner->id != 5)
                                        @include('panel.Movement.profitAdmin')
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    @endforeach



                    @if (isset($ispartner) && $ispartner->type == 5)
                        @foreach ($ahlandatas as $key => $ye)
                            @foreach ($ye as $key_yes => $yes)
                                <?php
                                $iis = 0;
                                $iiss = 0;
                                $iisss = 0;
                                $iissss = 0;

                                $iis2 = 0;
                                $iiss2 = 0;
                                $iisss2 = 0;
                                $iissss2 = 0;

                                $date = '';
                                foreach ($ye as $k => $it) {
                                    $date = $k;
                                }
                                ?>
                                <?php $is_partner = true; ?>
                                @if (sizeof($yes) != 0)
                                    <table class="table align-items-center mt-4">
                                        <thead>
                                            <tr class="bg">
                                                <th colspan="12">
                                                    Send By {{ @$ispartner->full_name }}<br>
                                                    <!-- {{ $date }} -->
                                                </th>
                                            </tr>
                                            @include('panel.Movement.headertable')
                                        </thead>
                                        <tbody>
                                            <?php $old_this = false;
                                            $keysyes = ''; ?>
                                            @foreach ($yes as $key => $row)
                                                @if (isset($ispartner) && $row->m_user->id == $ispartner->id)
                                                    @include('panel.Movement.table')
                                                @endif
                                            @endforeach
                                        </tbody>

                                        <?php $is_partner = false; ?>
                                    </table>
                                    @include('panel.Movement.ProfitParnter')
                                @endif
                            @endforeach
                        @endforeach
                    @endif

                    @if (isset($ispartner) && ($ispartner->type == 3 || $ispartner->type == 5))
                        @include('panel.Movement.transactionssum')

                        @if (sizeof($moves_data) > 0 && $ispartner->type != 5)
                        @endif
                    @endif

                    @if (isset($ispartner))
                        <?php $conI = 1; ?>
                        <?php $conE = 1; ?>
                        @foreach ($data_y as $year)
                            @foreach ($data_e as $key => $row)
                                @if ($row->new_date == $year->new_date && $row->movement_id == null && $row->type == 'Income')
                                    <?php $conI++; ?>
                                @elseif($row->new_date == $year->new_date && $row->movement_id == null && $row->type == 'Expenses')
                                    <?php $conE++; ?>
                                @endif
                            @endforeach
                        @endforeach
                        @if ($conI != 1)
                            @include('panel.Movement.transaction')
                        @endif

                        @if ($conE != 1)
                            @include('panel.Movement.Expinstransaction')
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 350px;">
            <div class="modal-content" id="exp_pdf2">
                <div class="modal-header" style="background: #fff;">
                    <h5 class="modal-title" id="exampleModalLabel" style="color:#E91E63;font-weight: bold;"><b>Today
                            ENTRIES
                        </b>
                        <span class="caldn"><b>{{ $tod1 }}</b><small>{{ $tod2 }}</small><i
                                class="far fa-calendar"></i></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="background: #fff;">
                    <div class="item_ent">
                        <ul>
                            <?php $simsw = 0; ?>
                            @foreach ($data_today as $row)
                                <li>
                                    <b>
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
                                        {{ $row->type }}:
                                    </b>
                                    (
                                    @foreach ($row->users as $key => $suser)
                                        @if ($key != 0)
                                            +
                                        @endif
                                        <small style="color:{{ @$suser->m_user->background }}"
                                            title="{{ @$suser->m_user->user_name }}">{{ $suser->total }}</small>
                                        <?php $simsw += $suser->total; ?>
                                    @endforeach
                                    )
                                </li>
                            @endforeach
                            <li style="margin-top: 15px;margin-bottom: 0;"><b style="color:#E91E63">Total:</b>
                                <small style="font-size: 16px;">{{ $simsw }}</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <form style="visibility: hidden" id="frm-note-create" action="{{ route('panel.notes.create') }}" method="get">
        <input id="i_entries" type="text" name="entries">
        <input id="i_user_id" type="text" value="{{ request()->get('d_user') }}" class="d_user_ipt"
            name="user_id">
    </form>



@section('panel_js')
    <script>
        $(document).ready(function() {
            var date = "tr_{{ Carbon\Carbon::now()->format('d-M') }}";
            var len = $(".table").find("#" + date).length;
            var lens = $(".table").find(".sredcol").length;
            console.log($(".table").find(".sredcol").offset());
            if (lens >= 1) {
                $('html, body').animate({
                    scrollTop: $(".table").find(".sredcol").offset().top - 70
                });
            } else if ($(".table").find(".tr_last").length >= 1) {
                $(".tr_last")[0].scrollIntoView();
            }

            $('.btn-note').on('click', function(e) {

                var mouvments_boxes = $('.mouvements_boxes:checked');
                var i_entries = $('#i_entries');
                var duserid = $('.d_user_ipt').val();
                var form = $('#frm-note-create');
                if (mouvments_boxes.length == 0) {
                    alert('Check Entries !');
                } else {
                    var entries = [];
                    mouvments_boxes.each((i, item) => {
                        entries.push(item.value);
                    });

                    i_entries.val(entries);

                    form.submit();

                    // var url = $(this).data('url');

                    // var url = $(this).data('url');
                    // var response = await fetch(url, {
                    //     method: 'POST',
                    //     headers: {
                    //         "Content-Type": "application/json",
                    //     },
                    //     body: JSON.stringify({
                    //         entries: entries,
                    //         user_id: duserid,
                    //         note: txt_note.val()
                    //     })
                    // });
                    // var res = await response.json();
                    // if(res.status){
                    //     location.reload();
                    //     // setTimeout(() => {
                    //     //     alert('Success !');
                    //     // }, 2000);
                    // }
                }
            });
        });
    </script>
    <script>
        $('.mouvements_boxes').on('click', function() {
            if ($(this).is(':checked')) {
                $(this).parent().parent().addClass('selectedbox');
            } else {
                $(this).parent().parent().removeClass('selectedbox');
            }
        });
    </script>
@endsection
@stop

<style>
table.table tr.selectedbox td {
    border: 2px solid #03a9f4 !important;
}
</style>
