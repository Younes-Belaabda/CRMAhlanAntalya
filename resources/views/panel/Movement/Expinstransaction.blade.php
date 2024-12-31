
        <?php $aush = Auth()->user() ?>
<table class="table align-items-center mb-0">
    <thead>
        <tr class="bg">
            <th colspan="10">Expenses Transfer {{ $year->new_date }}</th>
        </tr>
    </thead>
</table>
<table class="table align-items-center mb-2 ets">
    <thead>
        <tr>
            <!--<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">-->
            <!--    ID-->
            <!--</th>-->
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:15%">
                Date
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:55%">
                Ammount
            </th>
            <!--<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:15%">-->
            <!--    Admin-->
            <!--</th>-->
            @if($aush->type == 1)
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:15%">
                Action
            </th>
            @endif
        </tr>
    </thead>
    <tbody>
        <?php $con = 1; ?>
        @foreach($data_e as $key => $row)
            @if($row->new_date == $year->new_date && $row->movement_id == null && $row->type == "Expenses")
            <tr>
                <!--<td class="ps-4">-->
                <!--    <p class="text-xs font-weight-bold mb-0">{{ $con }}</p>-->
                <!--</td>-->
                <td class="ps-4" style="background:{{$row->m_user->background}} !important;color:{{$row->m_user->color}};">
                    <p class="text-xs font-weight-bold mb-0">{{  date("d M", strtotime($row->date)) }}</p>
                </td>
                <td class="ps-4">
                    <p class="text-xs font-weight-bold mb-0">{{  $row->price_type . " " .$row->price }}</p>
                </td>
                <!--<td class="ps-4">-->
                <!--    <p class="text-xs font-weight-bold mb-0">{{  $row->m_user->full_name }}</p>-->
                <!--</td>-->
                @if($aush->type == 1)
                <td class="text-center">
                    <a href="{{ route('panel.cash.add_new' , $row->income_id) }}" target="_blank" class="mx-1" data-bs-toggle="tooltip"
                        data-bs-original-title="Edit cash">
                        <i class="fas fa-user-edit text-secondary"></i>
                    </a>
                    <a data-url="{{ route('panel.cash.delete' , $row->income_id) }}" class="mx-1 delete" data-bs-toggle="tooltip"
                        data-bs-original-title="Delete cash">
                        <i class="cursor-pointer fas fa-trash text-danger"></i>
                    </a>
                </td>
                @endif
            </tr>
            <?php $con++; ?>
            @endif
        @endforeach
    </tbody>
</table>
