
<div class="sumtions">
    <?php
    $styel = 'max-width: 182px !important;    width: 2.8% !important;';
    ?>
    @if(CountofTypeAdminAC2($yes , null , '$') != null)
    <table class="table align-items-center mt-4 mb-0  td-5">
        <thead>
            <tr class="bg">
                <th colspan="10">
                    Maher Profit
                </th>
            </tr>
        </thead>
    </table>
    <table class="table align-items-center mt-0  td-5">
        <thead>
            <tr>
                @if(@$ispartner->id != 8)
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                @endif
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="{{@$ispartner->id == 8 ? $styel : ''}}">Total</th>
                    @if(AdminsumAmountByCurrencyAll($yes , null, '$') != 0)
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">USD</th>
                @endif
                @if(@$ispartner->id != 8)
                    @if(AdminsumAmountByCurrencyAll($yes , null, 'TL') != 0)
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TURKISH LIRA</th>
                    @endif
                    @if(AdminsumAmountByCurrencyAll($yes , null, '€') != 0)
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">EURO</th>
                    @endif
                    @if(AdminsumAmountByCurrencyAll($yes , null, '£') != 0)
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">POUND</th>
                    @endif
                @endif
            </tr>
        </thead>
        <tbody>
            @if(CountofTypeAdminAC2($yes , null , '$') != null)
                @foreach($types as $row_type)
                    @if(CountofTypeAdminAC2($yes , $row_type , '$') != null)
                        <?php
                            $st1 = AdminsumAmountByCurrencyCOfType($yes , $row_type , '$');
                            $st2 = AdminsumAmountByCurrencyCOfType($yes , $row_type , 'TL');
                            $st3 = AdminsumAmountByCurrencyCOfType($yes , $row_type , '€');
                            $st4 = AdminsumAmountByCurrencyCOfType($yes , $row_type , '£');
                        ?>
                        <tr>
                            @if(@$ispartner->id != 8)
                            <td class="text-xsm font-weight-bold mb-0" {{ $row_type == "Driver Tours" || ($st1 != null || $st2 != null || $st3 != null || $st4 != null) ? 'rowspan=2' : "" }}>{{ $row_type }}</td>
                            @endif
                                <td class="text-xsm font-weight-bold mb-0" style="{{@$ispartner->id == 8 ? $styel : ''}}" {{ $row_type == "Driver Tours" || ($st1 != null || $st2 != null || $st3 != null || $st4 != null) ? 'rowspan=2' : "" }}>{{CountofTypeAdminAC2($yes , $row_type , '$')}}</td>
                                @if(AdminsumAmountByCurrencyAll($yes , null, '$') != 0)
                                <td class="text-xsm font-weight-bold mb-0">{{AdminsumAmountByCurrencyPOfType($yes , $row_type , '$')}}</td>
                                @endif
                            @if(@$ispartner->id != 8)
                                @if(AdminsumAmountByCurrencyAll($yes , null, 'TL') != 0)
                                <td class="text-xsm font-weight-bold mb-0">{{AdminsumAmountByCurrencyPOfType($yes , $row_type , 'TL')}}</td>
                                @endif
                                @if(AdminsumAmountByCurrencyAll($yes , null, '€') != 0)
                                <td class="text-xsm font-weight-bold mb-0">{{AdminsumAmountByCurrencyPOfType($yes , $row_type , '€')}}</td>
                                @endif
                                @if(AdminsumAmountByCurrencyAll($yes , null, '£') != 0)
                                <td class="text-xsm font-weight-bold mb-0">{{AdminsumAmountByCurrencyPOfType($yes , $row_type , '£')}}</td>
                                @endif
                            @endif
                        </tr>
                        @if( $row_type == "Driver Tours" || ($st1 != null || $st2 != null || $st3 != null || $st4 != null))
                            <tr>
                                @if(AdminsumAmountByCurrencyAll($yes , null, '$') != 0)
                                <td class="text-xsm font-weight-bold mb-0">{{AdminsumAmountByCurrencyCOfType($yes , $row_type , '$')}}</td>
                                @endif
                                @if(@$ispartner->id != 8)
                                    @if(AdminsumAmountByCurrencyAll($yes , null, 'TL') != 0)
                                    <td class="text-xsm font-weight-bold mb-0" style="background: #2196f366 !important;">{{AdminsumAmountByCurrencyCOfType($yes , $row_type , 'TL')}}</td>
                                    @endif
                                    @if(AdminsumAmountByCurrencyAll($yes , null, '€') != 0)
                                    <td class="text-xsm font-weight-bold mb-0" style="background: #2196f366 !important;">{{AdminsumAmountByCurrencyCOfType($yes , $row_type , '€')}}</td>
                                    @endif
                                    @if(AdminsumAmountByCurrencyAll($yes , null, '£') != 0)
                                    <td class="text-xsm font-weight-bold mb-0" style="background: #2196f366 !important;">{{AdminsumAmountByCurrencyCOfType($yes , $row_type , '£')}}</td>
                                    @endif
                                @endif
                            </tr>
                        @endif
                    @endif
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr class="bg2">
                @if(@$ispartner->id != 8)
                <td class="text-xsm font-weight-bold mb-0">Sum</td>
                @endif
                @if(AdminsumAmountByCurrencyAll($yes , null, '$') != 0)
                <td class="text-xsm font-weight-bold mb-0" style="{{@$ispartner->id == 8 ? $styel : ''}}">{{CountofTypeAdminAC2($yes , null , '$')}}</td>
                @endif
                <td class="text-xsm font-weight-bold mb-0 ">
                    {{AdminsumAmountByCurrencyAll($yes ,null, '$')}}
                </td>
                @if(@$ispartner->id != 8)
                    @if(AdminsumAmountByCurrencyAll($yes , null, 'TL') != 0)
                    <td class="text-xsm font-weight-bold mb-0">{{AdminsumAmountByCurrencyAll($yes ,null, 'TL')}}</td>
                    @endif
                    @if(AdminsumAmountByCurrencyAll($yes , null, '€') != 0)
                    <td class="text-xsm font-weight-bold mb-0">{{AdminsumAmountByCurrencyAll($yes ,null, '€')}}</td>
                    @endif
                    @if(AdminsumAmountByCurrencyAll($yes , null, '£') != 0)
                    <td class="text-xsm font-weight-bold mb-0">{{AdminsumAmountByCurrencyAll($yes , null, '£')}}</td>
                    @endif
                @endif
            </tr>
        </tfoot>
    </table>
    @endif
</div>
