

@if(sumAmountByCurrencyAllsPrice($yes ,null, '$') == 0 && sumAmountByCurrencyAllsPrice($yes ,null, 'TL') == 0  && sumAmountByCurrencyAllsPrice($yes ,null, '€') == 0  && sumAmountByCurrencyAllsPrice($yes ,null, '£') == 0 )
@else

<div class="sumtions">
    <table class="table align-items-center mt-4 mb-0 td-5">
        <thead>
            <tr class="bg">
                <th colspan="10">
                    AMOUNT COLLECTED
                    <span style="float: right; width: 100%;font-size: 10px;">Received Money - (DIRECT NET + Paid By Us Net)</span>
                </th>
            </tr>
        </thead>
    </table>
    <table class="table align-items-center mt-0 td-5">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                @if(sumAmountByCurrencyAllsNets($yes , null , '$') != 0 || sumAmountByCurrencyAllsPrice($yes , null , '$') != 0)
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">USD</th>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , 'TL') != 0 || sumAmountByCurrencyAllsPrice($yes , null , 'TL') != 0)
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TURKISH LIRA</th>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , '€') != 0 || sumAmountByCurrencyAllsPrice($yes , null , '€') != 0)
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">EURO</th>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , '£') != 0 || sumAmountByCurrencyAllsPrice($yes , null , '£') != 0)
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">POUND</th>
                @endif
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-xsm font-weight-bold mb-0" style="background:#2196f366 !important;color:#333;">Received Money</td>
                <td class="text-xsm font-weight-bold mb-0" style="background:#2196f366;color:#333;">{{"(".(CountofTypeNets2($yes , "net2" , '$') != 0 ? CountofTypeNets2($yes , "net2" , '$') : "" ) . (CountofTypeNets2($yes , "net2" , 'TL') != 0 ? ((CountofTypeNets2($yes , "net2" , '$') != 0 && CountofTypeNets2($yes , "net2" , 'TL') != 0 ? " + " : "") .CountofTypeNets2($yes , "net2" , 'TL')) : "") . (CountofTypeNets2($yes , "net2" , '€') != 0 ? " + ".CountofTypeNets2($yes , "net2" , '€') : "")  . (CountofTypeNets2($yes , "net2" , '£') != 0 ? " + ".CountofTypeNets2($yes , "net2" , '£') : "") . ")" }}</td>
                @if(sumAmountByCurrencyAllsNets($yes , null , '$') != 0 || sumAmountByCurrencyAllsPrice($yes , null , '$') != 0)
                    <td class="text-xsm font-weight-bold mb-0" style="background:#2196f366;color:#333;">{{sumAmountByCurrencyAllsPrice($yes , "net2" , '$')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , 'TL') != 0 || sumAmountByCurrencyAllsPrice($yes , null , 'TL') != 0)
                <td class="text-xsm font-weight-bold mb-0" style="background:#2196f366;color:#333;">{{sumAmountByCurrencyAllsPrice($yes , "net2" , 'TL')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , '€') != 0 || sumAmountByCurrencyAllsPrice($yes , null , '€') != 0)
                        <td class="text-xsm font-weight-bold mb-0" style="background:#2196f366;color:#333;">{{sumAmountByCurrencyAllsPrice($yes , "net2" , '€')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , '£') != 0 || sumAmountByCurrencyAllsPrice($yes , null , '£') != 0)
                        <td class="text-xsm font-weight-bold mb-0" style="background:#2196f366;color:#333;">{{sumAmountByCurrencyAllsPrice($yes , "net2" , '£')}}</td>
                @endif
            </tr>
            <tr>
                <td class="text-xsm font-weight-bold mb-0" style="background:#2196f366 !important;color:#333;">DIRECT NET</td>
                <td class="text-xsm font-weight-bold mb-0" style="background:#2196f366;color:#333;">{{CountofTypeNets($yes , "net2" , '$')}}</td>
                @if(sumAmountByCurrencyAllsNets($yes , null , '$') != 0 || sumAmountByCurrencyAllsPrice($yes , null , '$') != 0)
                    <td class="text-xsm font-weight-bold mb-0" style="background:#2196f366;color:#333;">0</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , 'TL') != 0 || sumAmountByCurrencyAllsPrice($yes , null , 'TL') != 0)
                <td class="text-xsm font-weight-bold mb-0" style="background:#2196f366;color:#333;">{{ sumAmountByCurrencyAllsNets($yes , "net2" , 'TL')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , '€') != 0 || sumAmountByCurrencyAllsPrice($yes , null , '€') != 0)
                        <td class="text-xsm font-weight-bold mb-0" style="background:#2196f366;color:#333;">0</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , '£') != 0 || sumAmountByCurrencyAllsPrice($yes , null , '£') != 0)
                        <td class="text-xsm font-weight-bold mb-0" style="background:#2196f366;color:#333;">0</td>
                @endif
            </tr>
            <tr>
                <td class="text-xsm font-weight-bold mb-0" style="background:#fffc00 !important;color:#333;"> Paid By Us Net</td>
                <td class="text-xsm font-weight-bold mb-0" style="background:#fffc00;color:#333;">{{CountofTypeNets($yes , "net" , '$')}}</td>
                @if(sumAmountByCurrencyAllsNets($yes , null , '$') != 0 || sumAmountByCurrencyAllsPrice($yes , null , '$') != 0)
                <td class="text-xsm font-weight-bold mb-0" style="background:#fffc00;color:#333;">{{sumAmountByCurrencyAllsNets($yes , "net" , '$')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes ,null, 'TL') != 0 || sumAmountByCurrencyAllsPrice($yes , null , 'TL') != 0)
                <td class="text-xsm font-weight-bold mb-0" style="background:#fffc00;color:#333;">{{sumAmountByCurrencyAllsNets($yes , "net" , 'TL')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes ,null, '€') != 0 || sumAmountByCurrencyAllsPrice($yes , null , '€') != 0)
                <td class="text-xsm font-weight-bold mb-0" style="background:#fffc00;color:#333;">{{sumAmountByCurrencyAllsNets($yes , "net" , '€')}}</td>
                    @endif
                @if(sumAmountByCurrencyAllsNets($yes ,null, '£') != 0 || sumAmountByCurrencyAllsPrice($yes , null , '£') != 0)
                <td class="text-xsm font-weight-bold mb-0" style="background:#fffc00;color:#333;">{{sumAmountByCurrencyAllsNets($yes , "net" , '£')}}</td>
                    @endif
            </tr>
            <!--<tr>-->
            <!--    <td class="text-xsm font-weight-bold mb-0" >All ENTRIES</td>-->
            <!--    <td class="text-xsm font-weight-bold mb-0" style="background:#fffc00;color:#333;">{{CountofTypeNets($yes , null , '$')}}</td>-->
            <!--    @if(sumAmountByCurrencyAllsNets($yes , null , '$') != 0 || sumAmountByCurrencyAllsPrice($yes , null , '$') != 0)-->
            <!--        <td class="text-xsm font-weight-bold mb-0" style="background:#fffc00;color:#333;">-{{sumAmountByCurrencyAllsNets2($yes , null , '$')}}</td>-->
            <!--    @endif-->
            <!--    @if(sumAmountByCurrencyAllsNets($yes , null , 'TL') != 0 || sumAmountByCurrencyAllsPrice($yes , null , 'TL') != 0)-->
            <!--    <td class="text-xsm font-weight-bold mb-0" style="background:#fffc00;color:#333;">-{{sumAmountByCurrencyAllsNets2($yes , null , 'TL')}}</td>-->
            <!--    @endif-->
            <!--    @if(sumAmountByCurrencyAllsNets($yes , null , '€') != 0 || sumAmountByCurrencyAllsPrice($yes , null , '€') != 0)-->
            <!--            <td class="text-xsm font-weight-bold mb-0" style="background:#fffc00;color:#333;">-{{sumAmountByCurrencyAllsNets2($yes , null , '€')}}</td>-->
            <!--    @endif-->
            <!--    @if(sumAmountByCurrencyAllsNets($yes , null , '£') != 0 || sumAmountByCurrencyAllsPrice($yes , null , '£') != 0)-->
            <!--            <td class="text-xsm font-weight-bold mb-0" style="background:#fffc00;color:#333;">-{{sumAmountByCurrencyAllsNets2($yes , null , '£')}}</td>-->
            <!--    @endif-->
            <!--</tr>-->
        </tbody>
        <tfoot>
            <tr class="bg2">
                <td class="text-xsm font-weight-bold mb-0">Sum</td>
                <td class="text-xsm font-weight-bold mb-0">{{CountofTypeNets($yes , null , '$')}}</td>
                @if(sumAmountByCurrencyAllsNets($yes , null , '$') != 0 || sumAmountByCurrencyAllsPrice($yes ,null, '$') != 0)
                <td class="text-xsm font-weight-bold mb-0">{{sumAmountByCurrencyAllsPrice($yes ,null, '$') - sumAmountByCurrencyAllsNets2($yes , null , '$')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , 'TL') != 0 || sumAmountByCurrencyAllsPrice($yes ,null, 'TL') != 0)
                <td class="text-xsm font-weight-bold mb-0">{{sumAmountByCurrencyAllsPrice($yes ,null, 'TL') - sumAmountByCurrencyAllsNets2($yes , null , 'TL')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , '€') != 0 ||sumAmountByCurrencyAllsPrice($yes , null, '€') != 0)
                <td class="text-xsm font-weight-bold mb-0">{{sumAmountByCurrencyAllsPrice($yes ,null, '€') - sumAmountByCurrencyAllsNets2($yes , null , '€')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , '£') != 0 || sumAmountByCurrencyAllsPrice($yes , null, '£') != 0)
                <td class="text-xsm font-weight-bold mb-0">{{sumAmountByCurrencyAllsPrice($yes , null, '£') - sumAmountByCurrencyAllsNets2($yes , null , '£')}}</td>
                @endif
            </tr>
        </tfoot>
    </table>
</div>
@endif
