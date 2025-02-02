@extends('panel.layouts.base', ['is_main' => true])

@section('sub_title')
    Note
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
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
                                        <td>{{ movement_date_format($mov->date) }}
                                            @isset($mov->to_date) <br> {{ movement_date_format($mov->to_date) }} @endisset</td>
                                        <td>{!! movement_type_icon($mov->type) !!}</td>
                                        <td>{{ $mov->customer }}</td>
                                        <td>{{ abreviation_country($mov->country->name) }}</td>
                                        <td>{{ $mov->description }}</td>
                                        <td>{{ $mov->m_user->user_name }}</td>
                                        <td>@if($mov->sender_user == null) DIRECT @else
                                            {{  \App\User::find($mov->sender_user->user_id)->user_name  }}
                                        @endif</td>
                                        @if($mov->commission)
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
                        <form action="{{ route('panel.notes.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ request()->get('user_id') }}">
                            <input type="hidden" name="entries" value="{{ $entries }}">
                            <div class="form-group">
                                <label for="" class="form-label">Note</label>
                                <textarea class="form-control" name="content" id="" cols="10" rows="5"></textarea>
                            </div>
                            <button class="btn btn-success">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
