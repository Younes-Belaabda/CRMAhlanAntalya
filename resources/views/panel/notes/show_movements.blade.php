@extends('panel.layouts.base', ['is_main' => true])

@section('sub_title')
    Note - Movements
@endsection

@section('content')
    @php
        $note = \App\Models\MovementNote::where('movement_id', $movements[0]->movement_id)->first()->note;
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
                            {{ $note->created_at->format('d-m-Y, H:i:s') }}
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
                                        <td >{{ movement_date_format($mov->date) }}
                                            @isset($mov->to_date)
                                                <br> {{ movement_date_format($mov->to_date) }}
                                            @endisset
                                        </td>
                                        <td>{!! movement_type_icon($mov->type) !!}</td>
                                        <td>{{ $mov->customer }}</td>
                                        <td>{{ abreviation_country($mov->country->name) }}</td>
                                        <td>{{ $mov->description }}</td>
                                        <td>{{ $mov->m_user->user_name }}</td>
                                        <td>
                                            @if ($mov->sender_user == null)
                                                DIRECT
                                            @else
                                                {{ \App\User::find($mov->sender_user->user_id)->user_name }}
                                            @endif
                                        </td>
                                        @if ($mov->commission)
                                            <td>
                                                <div style="border-bottom: 1px solid">
                                                    <span>P1 | {{ $mov->price }} $</span>
                                                </div>
                                                <div>
                                                    <span>CC | {{ $mov->commission }} $</span>
                                                </div>
                                            </td>
                                        @else
                                            <td>{{ $mov->price }} $</td>
                                        @endif
                                        <td>{{ $mov->net }} $</td>
                                        <td>{{ $mov->revenue }} $</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <form action="{{ route('panel.notes.update', [
                            'note' => $note,
                        ]) }}"
                            method="post">
                            @csrf

                            <div class="form-group">
                                <label for="" class="form-label">Note</label>
                                <textarea class="form-control" name="content" id="" cols="10" rows="5">{{ $note->content }}</textarea>
                            </div>
                            <div class="checkbox mb-3" style="margin-top: 11px;">
                                <input name="is_finished" type="checkbox"
                                    placeholder="Completed"
                                    @if($note->is_finished) checked @endif
                                    id="Completed" value="{{ $note->is_finished }}">
                                <label for="Completed">Completed</label>
                            </div>
                            <button class="btn btn-success">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
