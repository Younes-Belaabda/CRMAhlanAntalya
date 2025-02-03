@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','View IMPORTANT')
@section('content')
    @push('panel_css')
    @endpush
    <style>

.munths li a.datecolor{
    color:red;
}
.munths li a.datecolor.selected{
    color: #fff;
    background-color: red;
    border-color: red;
}
    </style>

    <div class="row">
        <div class="col-12" style="position:relative;">
            <div class="card mb-4 mx-4 pb-2" style="position: sticky;right: 0;left: 17%;z-index: 3;top: 4px;">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1 show_accro">Filter IMPORTANT</h5>
                        </div>
                        <div>

                            <?php
                            $url = Route('panel.todolist.view')."?";
                            if(isset($request["for_id"]) && $request["for_id"]){
                                $url .="&for_id=".$request["for_id"];
                            }

                            $nows = \Carbon\Carbon::now();
                            $now = $nows->month;
                            $tnow = $nows->month;
                            $year = $nows->year;
                            if(isset($request["from_date"]) && $request["from_date"] != null){
                                $nows = \Carbon\Carbon::parse($request["from_date"]);
                                $now = $nows->month;
                                $year = $nows->year;
                            }
                            ?>
                            <ul class="munths">
                                <?php
                                    $its = \App\Models\Notification::whereNull("notification_ids")->whereBetween("date" , [$year.'-01-01',$year.'-01-31']);
                                    $its = $its->get()->Count();
                                    if($tnow == "01"){
                                        $its = 0;
                                    }
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-01-01&to_date='.$year.'-01-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 1 ? "selected" : "" }}'>01</a></li>

                                <?php
                                    $its = \App\Models\Notification::whereNull("notification_ids")->whereBetween("date" , [$year.'-02-01',$year.'-02-31']);
                                    $its = $its->get()->Count();
                                    if($tnow == "01"){
                                        $its = 0;
                                    }
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-02-01&to_date='.$year.'-02-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 2 ? "selected" : "" }}'>02</a></li>
                                <?php
                                    $its = \App\Models\Notification::whereNull("notification_ids")->whereBetween("date" , [$year.'-03-01',$year.'-03-31']);
                                    $its = $its->get()->Count();
                                    if($tnow == "01"){
                                        $its = 0;
                                    }
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-03-01&to_date='.$year.'-03-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 3 ? "selected" : "" }}'>03</a></li>
                                <?php
                                    $its = \App\Models\Notification::whereNull("notification_ids")->whereBetween("date" , [$year.'-04-01',$year.'-04-31']);
                                    $its = $its->get()->Count();
                                    if($tnow == "01"){
                                        $its = 0;
                                    }
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-04-01&to_date='.$year.'-04-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 4 ? "selected" : "" }}'>04</a></li>
                                <?php
                                    $its = \App\Models\Notification::whereNull("notification_ids")->whereBetween("date" , [$year.'-05-01',$year.'-05-31']);
                                    $its = $its->get()->Count();
                                    if($tnow == "01"){
                                        $its = 0;
                                    }
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-05-01&to_date='.$year.'-05-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 5 ? "selected" : "" }}'>05</a></li>
                                <?php
                                    $its = \App\Models\Notification::whereNull("notification_ids")->whereBetween("date" , [$year.'-06-01',$year.'-06-31']);
                                    $its = $its->get()->Count();
                                    if($tnow == "01"){
                                        $its = 0;
                                    }
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-06-01&to_date='.$year.'-06-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 6 ? "selected" : "" }}'>06</a></li>
                                <?php
                                    $its = \App\Models\Notification::whereNull("notification_ids")->whereBetween("date" , [$year.'-07-01',$year.'-07-31']);
                                    $its = $its->get()->Count();
                                    if($tnow == "01"){
                                        $its = 0;
                                    }
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-07-01&to_date='.$year.'-07-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 7 ? "selected" : "" }}'>07</a></li>
                                <?php
                                    $its = \App\Models\Notification::whereNull("notification_ids")->whereBetween("date" , [$year.'-08-01',$year.'-08-31']);
                                    $its = $its->get()->Count();
                                    if($tnow == "01"){
                                        $its = 0;
                                    }
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-08-01&to_date='.$year.'-08-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 8 ? "selected" : "" }}'>08</a></li>
                                <?php
                                    $its = \App\Models\Notification::whereNull("notification_ids")->whereBetween("date" , [$year.'-09-01',$year.'-09-31']);
                                    $its = $its->get()->Count();
                                    if($tnow == "01"){
                                        $its = 0;
                                    }
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-09-01&to_date='.$year.'-09-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 9 ? "selected" : "" }}'>09</a></li>
                                <?php
                                    $its = \App\Models\Notification::whereNull("notification_ids")->whereBetween("date" , [$year.'-10-01',$year.'-10-31']);
                                    $its = $its->get()->Count();
                                    if($tnow == "01"){
                                        $its = 0;
                                    }
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-10-01&to_date='.$year.'-10-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 10 ? "selected" : "" }}'>10</a></li>
                                <?php
                                    $its = \App\Models\Notification::whereNull("notification_ids")->whereBetween("date" , [$year.'-11-01',$year.'-11-31']);
                                    $its = $its->get()->Count();
                                    if($tnow == "01"){
                                        $its = 0;
                                    }
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-11-01&to_date='.$year.'-11-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 11 ? "selected" : "" }}'>11</a></li>
                                <?php
                                    $its = \App\Models\Notification::whereNull("notification_ids")->whereBetween("date" , [$year.'-12-01',$year.'-12-31']);
                                    $its = $its->get()->Count();
                                    if($tnow == "01"){
                                        $its = 0;
                                    }
                                ?>
                                <li><a href="{{$url.'&from_date='.$year.'-12-01&to_date='.$year.'-12-31'}}" class='{{ $its >= 1 ? "datecolor":"" }} {{ $now == 12 ? "selected" : "" }}'>12</a></li>
                            </ul>

                        <a class="btn bg-gradient-dark btn-sm mb-2 export_pdf" type="button">Export PDF</a>

                        <a href="{{ route('panel.todolist.add_new') }}" class="btn bg-gradient-dark btn-sm mb-2" type="button">+&nbsp; New To Do List</a>
                        </div>

                    </div>
                </div>
                <div class="card-body px-4 pt-0 pb-2 mb-0 hide_accro">
                    <form action="{{ Route('panel.todolist.view') }}" method="Get" role="form text-left">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="from_date" class="form-control-label">{{ __('From Date') }}</label>
                                    <div class="@error('from_date') border border-danger rounded-3 @enderror">
                                        <input class="form-control datepicker" name="from_date" value="{{@$request['from_date']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="to_date" class="form-control-label">{{ __('To Date') }}</label>
                                    <div class="@error('to_date') border border-danger rounded-3 @enderror">
                                        <input class="form-control datepicker" name="to_date" value="{{@$request['to_date']}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="for_id" class="form-control-label">{{ __('Accounts') }}</label>
                                    <div class="@error('for_id') border border-danger rounded-3 @enderror">
                                        <select name="for_id" class="select form-control" id="for_id">
                                        <option value="">Choose</option>
                                            @foreach($users as $key => $row)
                                                <option value="{{$row->id}}" {{ @$request['for_id'] == $row->id ? 'selected' : '' }}>{{$row->full_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn bg-gradient-dark btn-md mt-1 mb-1">{{ 'Go Filter' }}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1">All IMPORTANT</h5>
                        </div>
                    </div>
                </div>
                <div id="exp_pdf" class="card-body px-2 pt-0 pb-2 ">
                    <div class="table-responsive p-0">
                        @if(sizeof($data) > 0)
                        <table class="table align-items-center mb-0 nopadhid">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:15%">
                                        Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:15%">
                                        Sender
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:15%">
                                        RECEIVER
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        TOPIC
                                    </th>
                                    <!--<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">-->
                                    <!--    Text-->
                                    <!--</th>-->
                                    <!-- <th class="last-child text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th> -->
                                    <th class="last-child text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:100px">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($data as $key => $row)
                                <tr>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $key + 1 }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{  date("d M", strtotime($row->date)) }}</p>
                                    </td>
                                    <td class="user" style="background:{{@$row->f_user->background}};color:{{@$row->f_user->color}}">
                                        <a class="text-xs font-weight-bold mb-0" href="{{ url('/admin/entries?d_user='.$row->f_user->id) }}" style="background:{{@$row->f_user->background}};color:{{@$row->f_user->color}}">{{ $row->f_user->full_name }}</a>
                                    </td>
                                    <?php
                                        $style="";
                                        if(sizeof($row->users) == 1){
                                            $style = "background:".$row->users->first()->background.";color:".$row->users->first()->color;
                                        }
                                    ?>
                                    <td class="user" style="{{$style}}">
                                        @foreach($row->users as $t_user)
                                        <a class="text-xs font-weight-bold mb-0" href="{{ url('/admin/entries?d_user='.$t_user->id) }}" style="background:{{@$t_user->background}};color:{{@$t_user->color}}">{{ @$t_user->full_name }}</a>
                                        @endforeach
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $row->title != "" ? $row->title : $row->text }}
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        @if($row->movement_id != "")
                                            <a href="{{ route('panel.movement.add_new' , $row->movement_id ) }}" class="mx-1" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit entries">
                                                <i class="fas fa-arrows-alt text-secondary"></i>
                                            </a>
                                        @endif
                                        @if($row->from_user_id == auth()->user()->id)
                                        <a href="{{ route('panel.todolist.add_new' , $row->notification_id) }}" class="mx-1" data-bs-toggle="tooltip"
                                            data-bs-original-title="Edit ToDoList">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        @endif
                                        <a href="{{ route('panel.todolist.add_retweet' , $row->notification_id) }}" class="mx-1" data-bs-toggle="tooltip"
                                            data-bs-original-title="Add retweet">
                                            <i class="fas fa-retweet text-secondary"></i>
                                        </a>
                                        @if($row->from_user_id == auth()->user()->id || auth()->user()->type == 1)
                                        <a data-url="{{ route('panel.todolist.delete' , $row->notification_id) }}" class="mx-1 delete" data-bs-toggle="tooltip"
                                            data-bs-original-title="Delete ToDoList">
                                            <i class="cursor-pointer fas fa-trash text-danger"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
  @push('panel_js')

  @endpush
@stop
