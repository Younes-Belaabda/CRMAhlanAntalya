
<div class="sumtions table_profit">
    <?php
    $styel = 'max-width: 182px !important;    width: 2.8% !important;';
    ?>
    <table class="table align-items-center mt-4  mb-0 td-5 head_table">
        <thead>
            <tr class="bg">
                <th colspan="10">
                    Company Profit
                </th>
            </tr>
        </thead>
    </table>
    <table class="table align-items-center mt-0 td-5">
        <thead>
            <tr>
                @if(@$ispartner->id != 8)
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                @endif
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="{{@$ispartner->id == 8 ? $styel : ''}}">Total</th>
                
                @if(sumAmountByCurrencyAll($yes , null, '$') != 0)
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">USD</th>
                @endif
                @if(@$ispartner->id != 8)
                    @if(sumAmountByCurrencyAll($yes , null, 'TL') != 0)
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TURKISH LIRA</th>
                    @endif
                    @if(sumAmountByCurrencyAll($yes , null, '€') != 0)
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">EURO</th>
                    @endif
                    @if(sumAmountByCurrencyAll($yes , null, '£') != 0)
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">POUND</th>
                    @endif
                @endif
            </tr>
        </thead>
        <tbody>
            <?php $cos = 0;$typs = ""; ?>
            @foreach($types as $row_type)
                @if(CountofType($yes , $row_type , '$') != null)
                <?php $cos++;$typs=$row_type;?>
                @endif
            @endforeach
            @if($cos != 1 || $cos == 1)
                @foreach($types as $row_type)
                    @if(CountofType($yes , $row_type , '$') != null && Auth()->user()->id != 5)
                        <?php
                            $st1 = sumAmountByCurrencyCOfType($yes , $row_type , '$');
                            $st2 = sumAmountByCurrencyCOfType($yes , $row_type , 'TL');
                            $st3 = sumAmountByCurrencyCOfType($yes , $row_type , '€');
                            $st4 = sumAmountByCurrencyCOfType($yes , $row_type , '£');
                        ?>
                        <tr>
                            @if(@$ispartner->id != 8)
                            <td class="text-xsm font-weight-bold mb-0" {{ $row_type == "Driver Tours" || ($st1 != null || $st2 != null || $st3 != null || $st4 != null) ? 'rowspan=2' : "" }}>{{ $row_type }}</td>
                            @endif
                                <td class="text-xsm font-weight-bold mb-0" style="{{@$ispartner->id == 8 ? $styel : ''}}" {{ $row_type == "Driver Tours" || ($st1 != null || $st2 != null || $st3 != null || $st4 != null) ? 'rowspan=2' : "" }}>{{CountofType($yes , $row_type , '$')}}</td>
                                @if(sumAmountByCurrencyAll($yes , null, '$') != 0)
                                <td class="text-xsm font-weight-bold mb-0">{{sumAmountByCurrencyPOfType($yes , $row_type , '$')}}</td>
                                @endif
                            @if(@$ispartner->id != 8)
                                @if(sumAmountByCurrencyAll($yes , null, 'TL') != 0)
                                <td class="text-xsm font-weight-bold mb-0">{{sumAmountByCurrencyPOfType($yes , $row_type , 'TL')}}</td>
                                @endif
                                @if(sumAmountByCurrencyAll($yes , null, '€') != 0)
                                <td class="text-xsm font-weight-bold mb-0">{{sumAmountByCurrencyPOfType($yes , $row_type , '€')}}</td>
                                @endif
                                @if(sumAmountByCurrencyAll($yes , null, '£') != 0)
                                <td class="text-xsm font-weight-bold mb-0">{{sumAmountByCurrencyPOfType($yes , $row_type , '£')}}</td>
                                @endif
                            @endif
                        </tr>
                        @if( $row_type == "Driver Tours" || ($st1 != null || $st2 != null || $st3 != null || $st4 != null))
                            <tr>
                                @if(sumAmountByCurrencyAll($yes , null, '$') != 0)
                                <td class="text-xsm font-weight-bold mb-0 commission" data-td="commission">{{sumAmountByCurrencyCOfType($yes , $row_type , '$')}}</td>
                                @endif
                                @if(@$ispartner->id != 8)
                                    @if(sumAmountByCurrencyAll($yes , null, 'TL') != 0)
                                    <td class="text-xsm font-weight-bold mb-0" style="background: #2196f366 !important;">{{sumAmountByCurrencyCOfType($yes , $row_type , 'TL')}}</td>
                                    @endif
                                    @if(sumAmountByCurrencyAll($yes , null, '€') != 0)
                                    <td class="text-xsm font-weight-bold mb-0" style="background: #2196f366 !important;">{{sumAmountByCurrencyCOfType($yes , $row_type , '€')}}</td>
                                    @endif
                                    @if(sumAmountByCurrencyAll($yes , null, '£') != 0)
                                    <td class="text-xsm font-weight-bold mb-0" style="background: #2196f366 !important;">{{sumAmountByCurrencyCOfType($yes , $row_type , '£')}}</td>
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
                @if(sumAmountByCurrencyAll($yes , null, '$') != 0)
                <td class="text-xsm font-weight-bold mb-0" style="{{@$ispartner->id == 8 ? $styel : ''}}">{{CountofType($yes , "d" , '$')}}</td>
                @endif
                <td class="text-xsm font-weight-bold mb-0 ">
                    {{sumAmountByCurrencyAll($yes ,null, '$')}}
                </td>
                @if(@$ispartner->id != 8)
                    @if(sumAmountByCurrencyAll($yes , null, 'TL') != 0)
                    <td class="text-xsm font-weight-bold mb-0">{{sumAmountByCurrencyAll($yes ,null, 'TL')}}</td>
                    @endif
                    @if(sumAmountByCurrencyAll($yes , null, '€') != 0)
                    <td class="text-xsm font-weight-bold mb-0">{{sumAmountByCurrencyAll($yes ,null, '€')}}</td>
                    @endif
                    @if(sumAmountByCurrencyAll($yes , null, '£') != 0)
                    <td class="text-xsm font-weight-bold mb-0">{{sumAmountByCurrencyAll($yes , null, '£')}}</td>
                    @endif
                @endif
            </tr>
        </tfoot>
    </table>
</div>
