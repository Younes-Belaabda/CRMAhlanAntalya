@extends('panel.layouts.base', ['is_main' => true])

@section('sub_title')
    Note - Movements
@endsection

@php
    $breadcrumbs = '
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="' . route('panel.notes.show' , [
                'user' => $user->id
            ]) .'">' .
                "Notes " . $user->user_name
                . '
            </a>
            </li>
            <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                Show
            </li>
        </ol>
    ';
@endphp

@section('content')
    @php
        // $note = \App\Models\MovementNote::where('movement_id', $movements[0]->movement_id)->first()->note;
    @endphp
    <div class="container">
        <div class="row">

            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div>
                            <b>
                                Date:
                            </b>
                            {{ $note->created_at->format('d-m-Y, H:i') }}
                        </div>
                        <br>
                        <table class="table forprint align-items-center mb-2">
                            <thead>
                                <th>ID</th>
                                <th>DATE</th>
                                <th>TYPE</th>
                                <th>CLIENT NAME</th>
                                <th>LAND</th>
                                <th>SERVICE DESCRIPTION</th>
                                <th>ADMIN</th>
                                <th>USER</th>
                                <th>PRICE</th>
                                <th>NET</th>
                                <th>PROFIT</th>
                            </thead>
                            <tbody>
                                @foreach ($movements as $mov)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        @php
                                            $cur_bg = '';
                                            if ($mov->color == '1') {
                                                $cur_bg = '#ff0000';
                                            } elseif ($mov->color == '2') {
                                                $cur_bg = '#fffc00';
                                            } elseif ($mov->color == '3') {
                                                $cur_bg = '#12ff00';
                                            } elseif ($mov->color == '4') {
                                                $cur_bg = '#00fff0';
                                            } elseif ($mov->color == '5') {
                                                $cur_bg = '#ffc107';
                                            }
                                        @endphp
                                        <td style="background-color: {{ $cur_bg }}">
                                            {{ movement_date_format($mov->date) }}
                                            @isset($mov->to_date)
                                                <br> {{ movement_date_format($mov->to_date) }}
                                            @endisset
                                        </td>
                                        <td style="background-color: {{ $cur_bg }}">{!! movement_type_icon($mov->type) !!}</td>
                                        <td style="background-color: {{ $cur_bg }}">{{ $mov->customer }}</td>
                                        <td style="background-color: {{ $cur_bg }}">{{ abreviation_country($mov->country->name) }}</td>
                                        <td style="background-color: {{ $cur_bg }}">{{ $mov->description }}</td>
                                        <td
                                            class="user"
                                            style="background-color: {{ $mov->m_user->background }} ; color : {{ $mov->m_user->color }}">
                                            <a
                                            style="background-color: {{ $mov->m_user->background }} ; color : {{ $mov->m_user->color }}"
                                            class="text-xst font-weight-bold mb-0" href="{{ route('panel.movement.view') . "?d_user=" . $mov->m_user->id  }}">
                                                {{ $mov->m_user->user_name }}
                                            </a>
                                        </td>
                                        @php
                                            $user_style = 'background-color: #016E8F; color:white';
                                            if ($mov->sender_user != null) {
                                                $usr = \App\User::find($mov->sender_user->user_id);
                                                $user_style = "background-color: {$usr->background}; color:{$usr->color}";
                                            }
                                        @endphp
                                        <td class="user" style="{{ $user_style }}">
                                            <a href="{{ route('panel.movement.view') . "?d_user=" . $user->id  }}" style="{{ $user_style }}">
                                                @if ($mov->sender_user == null)
                                                    {{ $user->user_name }}
                                                @else
                                                    {{ $usr->user_name }}
                                                @endif
                                            </a>
                                        </td>
                                        @php
                                            $price_style = 'background-color:#A6D5FA';
                                            // dump($mov);
                                            if ($mov->paybyus) {
                                                if ($mov->sender_paid) {
                                                    $price_style = 'background-color:#12FF00';
                                                } else {
                                                    $price_style = 'background-color:#FFFC00';
                                                }
                                            }
                                        @endphp
                                        @if ($mov->commission)
                                            <td style="{{ $price_style }}">
                                                <div style="border-bottom: 1px solid">
                                                    <span>P1 | {{ $mov->price }} $</span>
                                                </div>
                                                <div>
                                                    <span>CC | {{ $mov->commission }} $</span>
                                                </div>
                                            </td>
                                        @else
                                            <td style="{{ $price_style }}">{{ $mov->price }} $</td>
                                        @endif
                                        @php
                                            $net_style = 'background-color:#A6D5FA';
                                            // dump($mov);
                                            if($mov->paybyus){
                                                if($mov->leader_paid){
                                                    $net_style = "background-color:#12FF00";
                                                }else{
                                                    $net_style = "background-color:#FFFC00";
                                                }
                                            }
                                        @endphp
                                        <td style="{{ $net_style }}">{{ $mov->net }} $</td>
                                        @php
                                            $profite_style = 'background-color:#A6D5FA';
                                            // dump($mov);
                                            if($mov->paybyus){
                                                if($mov->status){
                                                    $profite_style = "background-color:#12FF00";
                                                }else{
                                                    $profite_style = "background-color:#FFFC00";
                                                }
                                            }
                                        @endphp
                                        <td style="{{ $profite_style }}">{{ $mov->revenue }} $</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <form
                            action="{{ route('panel.notes.update', [
                                'note' => $note,
                            ]) }}"
                            method="post">
                            @csrf

                            <div class="form-group">
                                <div style="margin: 10px 0">
                                    <b style="color: red">Note</b>
                                </div>
                                <textarea class="form-control" name="content" id="" cols="10" rows="5">{{ $note->content }}</textarea>
                            </div>
                            <div class="d-flex">
                                <button class="btn bg-gradient-dark">Edit</button>
                                <div class="checkbox mb-3" style="margin-top: 11px;">
                                    <input name="is_finished" type="checkbox" placeholder="Completed"
                                        @if ($note->is_finished) checked @endif id="Completed"
                                        value="{{ $note->is_finished }}">
                                    <label for="Completed">Completed</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
