@extends('panel.layouts.base', ['is_main' => true])
@section('sub_title')
    Notes - {{ $user->user_name }}
@endsection

@php
    $breadcrumbs =
        '
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="' .
        route('panel.notes.all') .
        '">Notes</a>
            </li>
            <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">' .
        'Notes ' .
        $user->user_name .
        '</li>
        </ol>
    ';

    function get_period($items){
        $movements = [];
        foreach ($items as $item) {
            $movements[] = \App\Models\Movement::find($item->movement_id);
        }
        $dates    = collect($movements)->pluck('date')->toArray();
        $to_dates = collect($movements)->pluck('to_date')->toArray();


        $final_dates = collect(array_merge($dates , $to_dates))
        ->whereNotNull();

        $final_dates = $final_dates->toArray();


        $final_dates = array_map(function($el){
            return \Carbon\Carbon::parse($el);
        } , $final_dates);





        $big_date   = current($final_dates);
        $lower_date = end($final_dates);

        foreach ($final_dates as $dt) {
            if($dt->gt($big_date)){
                $big_date = $dt;
            }
        }

        foreach ($final_dates as $dt) {
            if($dt->lt($lower_date)){
                $lower_date = $dt;
            }
        }

        $date_day    = $lower_date->format('d');
        $date_mounth = $lower_date->format('M');
        $date_to_day = $big_date->format('d');
        $date_to_mounth = $big_date->format('M');
        $date_string = '';

        if($date_mounth == $date_to_mounth){
            $date_string = "$date_day - $date_to_day $date_mounth";
        }else{
            $date_string = "$date_day $date_mounth - $date_to_day $date_to_mounth";
        }

        return $date_string;
    }
@endphp

@section('content')
    <style>
        tr.is_completed td.colored {
            background-color: #12FF00;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-1">All Notes: {{ $user->user_name }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-2 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-3 nopadhid">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        style="width:40px">
                                        Date
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        style="width:40px">
                                        Time
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        style="width:40px">
                                        Note
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        style="width:40px">
                                        Period
                                    </th>

                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"style="width:15%">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $con = 1; ?>
                                @foreach ($notes as $note)
                                    <tr @if ($note->is_finished) class="is_completed" @endif>
                                        <td style="width: 20px">
                                            <p class="text-xs font-weight-bold mb-0">{{ $loop->index + 1 }}</p>
                                        </td>
                                        <td class="colored">
                                            {{ $note->created_at->format('d M') }}
                                        </td>
                                        <td class="colored">
                                            {{ $note->created_at->format('H:i') }}
                                        </td>
                                        <td class="colored">
                                            {{ $note->content }}
                                        </td>
                                        <td class="colored">
                                            {{-- 01 - 07 JAN --}}
                                            {{-- 01 JAN - 07 FEB --}}
                                            {{ get_period($note->movements) }}
                                        </td>
                                        <td class="colored">
                                            @php
                                                $arr = implode(',', $note->movements->pluck('id')->toArray());

                                                if ($arr == '') {
                                                    $arr = '-1';
                                                }
                                                // dump($arr);
                                            @endphp
                                            <a
                                                href="{{ route('panel.notes.show_movements', [
                                                    'user' => $note->user_id,
                                                    'movements' => $arr,
                                                ]) }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a data-url="{{ route('panel.notes.delete' , ['note' => $note]) }}"
                                                class="mx-1 delete" data-bs-toggle="tooltip"
                                                data-bs-original-title="Delete entries">
                                                <i class="cursor-pointer fas fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('panel_js')
    @endpush
@stop
