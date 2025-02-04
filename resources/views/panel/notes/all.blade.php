@extends('panel.layouts.base',['is_main'=>true])
@section('sub_title','All')
@section('content')
    @push('panel_css')
    @endpush
    <?php $types = collect(); $types->push(["1"=>"Driver"],["2"=>"Agent"],["3"=>"Vendor"],["4"=>"Partner"]); ?>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4" >
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1">All Notes</h5>
                        </div>
                        <div>
                            <?php
                            $url = Route('panel.notes.all')."?";
                            if(isset($request["d_user"]) && $request["d_user"]){
                                $url .="&d_user=".$request["d_user"];
                            }

                            if(isset($request["m_type"]) && $request["m_type"]){
                                $url .="&m_type=".$request["m_type"];
                            }

                            if(isset($request["from_date"]) && $request["from_date"]){
                                $url .="&from_date=".$request["from_date"];
                            }

                            if(isset($request["to_date"]) && $request["to_date"]){
                                $url .="&to_date=".$request["to_date"];
                            }

                            if(isset($request["country_id"]) && $request["country_id"]){
                                $url .="&country_id=".$request["country_id"];
                            }

                            ?>
                            <ul class="munths">
                                @foreach($user_type as $keys=>$ut)
                                <?php
                                    $cons = $data->where("type",$keys+1)->count();
                                ?>
                                <li><a href="{{$url.'&type='.($keys+1)}}" class='{{ @$request["type"] == $keys+1 ? "selected" : "" }}'>{{$ut }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body px-2 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        @foreach($types as $keys=>$type)
                            @foreach($type as $key=>$typew)

                            @if(isset($request["type"]) && @$request["type"] == $key)
                            <table class="table align-items-center mb-0 nopadhid">
                                <thead>
                                    <tr class="bg">
                                        <th colspan="3">{{ $typew }}</th>
                                    </tr>
                                </thead>
                            </table>
                            <table class="table align-items-center mb-3 nopadhid">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ID
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:40px">
                                            Image
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"style="width:15%">
                                            Full Name
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"style="width:15%">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php $con = 1; ?>
                                  @foreach($data as $key => $row)
                                  @if($row->Typename == $typew && count($row->notes) > 0)
                                    <tr >
                                        <td style="width: 20px">
                                            <p class="text-xs font-weight-bold mb-0">{{ $con }}</p>
                                        </td>
                                        <td class="text-center">
                                            <div class="image_uploader w50">
                                                <img src="{{ $row->avatar }}" />
                                            </div>
                                        </td>
                                        <td class="user" style="background:{{@$row->background}};color:{{@$row->color}}" >
                                            <a class="text-xs font-weight-bold mb-0" target="_blank"  style="background:{{@$row->background}};color:{{@$row->color}}" href="{{ url('/admin/entries?d_user='.$row->id)}}">{{ $row->full_name }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('panel.notes.show' , [
                                            'user' => $row->id]) }}" class="btn btn bg-gradient-dark btn-sm my-2">Notes</a>
                                        </td>
                                    </tr>
                            <?php $con++; ?>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
  @push('panel_js')

  @endpush
@stop
