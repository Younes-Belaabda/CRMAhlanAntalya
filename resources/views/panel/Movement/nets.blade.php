

@if(sumAmountByCurrencyAllsNets($yes ,null, '$') == 0 && sumAmountByCurrencyAllsNets($yes ,null, 'TL') == 0  && sumAmountByCurrencyAllsNets($yes ,null, '€') == 0  && sumAmountByCurrencyAllsNets($yes ,null, '£') == 0 )
@else
<div class="sumtions">
    <table class="table align-items-center mt-4 mb-0 td-5">
        <thead>
            <tr class="bg">
                <th colspan="10">
                    All Entries Sum Nets
                </th>
            </tr>
        </thead>
    </table>
    <table class="table align-items-center mt-0 td-5">
        <thead>
            <tr>
                <th colspan="7">
                    <small>(((DIRECT PROFIT + DIRECT Commission + DIRECT Admin Commission) - Paid By Us Net) + Ticket Paid By Us Net)</small>
                </th>
            </tr>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                @if(sumAmountByCurrencyAllsNets($yes , null , '$') != 0 || sumAmountByCurrencyC($yes , null , '$') != 0 || sumAmountByCurrencyC($yes , null , '$') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '$') != 0 || sumAmountByCurrencyTicket($yes , null , '$') != 0)
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">USD</th>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , 'TL') != 0|| sumAmountByCurrencyC($yes , null , 'TL') != 0 || sumAmountByCurrencyC($yes , null , 'TL') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , 'TL') != 0 || sumAmountByCurrencyTicket($yes , null , 'TL') != 0)
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TURKISH LIRA</th>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , '€') != 0|| sumAmountByCurrencyC($yes , null , '€') != 0 || sumAmountByCurrencyC($yes , null , '€') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '€') != 0 || sumAmountByCurrencyTicket($yes , null , '€') != 0)
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">EURO</th>
                @endif

                @if(sumAmountByCurrencyAllsNets($yes , null , '£') != 0|| sumAmountByCurrencyC($yes , null , '£') != 0 || sumAmountByCurrencyC($yes , null , '£') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '£') != 0 || sumAmountByCurrencyTicket($yes , null , '£') != 0)
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">POUND</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if(CountofTypeNets($yes , "net2" , '$') != null)
            <tr>
                <td class="text-xsm font-weight-bold mb-0" >DIRECT PROFIT</td>
                <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{CountofTypeNets($yes , "net2" , '$')}}</td>
                
                @if(sumAmountByCurrencyAllsNets($yes , null , '$') != 0 || sumAmountByCurrencyC($yes , null , '$') != 0 || sumAmountByCurrencyC($yes , null , '$') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '$') != 0 || sumAmountByCurrencyTicket($yes , null , '$') != 0)
                    <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{sumAmountByCurrencyAllsNets($yes , "net2" , '$')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , 'TL') != 0|| sumAmountByCurrencyC($yes , null , 'TL') != 0 || sumAmountByCurrencyC($yes , null , 'TL') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , 'TL') != 0 || sumAmountByCurrencyTicket($yes , null , 'TL') != 0)
                <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{sumAmountByCurrencyAllsNets($yes , "net2" , 'TL')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , '€') != 0|| sumAmountByCurrencyC($yes , null , '€') != 0 || sumAmountByCurrencyC($yes , null , '€') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '€') != 0 || sumAmountByCurrencyTicket($yes , null , '€') != 0)
                        <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{sumAmountByCurrencyAllsNets($yes , "net2" , '€')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , '£') != 0|| sumAmountByCurrencyC($yes , null , '£') != 0 || sumAmountByCurrencyC($yes , null , '£') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '£') != 0 || sumAmountByCurrencyTicket($yes , null , '£') != 0)
                        <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{sumAmountByCurrencyAllsNets($yes , "net2" , '£')}}</td>
                @endif
            </tr>
            @endif
            @if(CountofTypeACont($yes , "net2" , '$') != null)
            <tr>
                <td class="text-xsm font-weight-bold mb-0" >DIRECT Commission</td>
                <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{CountofTypeACont($yes , "net2" , '$')}}</td>
                @if(sumAmountByCurrencyAllsNets($yes , null , '$') != 0 || sumAmountByCurrencyC($yes , null , '$') != 0 || sumAmountByCurrencyC($yes , null , '$') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '$') != 0 || sumAmountByCurrencyTicket($yes , null , '$') != 0)
                    <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{sumAmountByCurrencyC($yes , "net2" , '$')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , 'TL') != 0|| sumAmountByCurrencyC($yes , null , 'TL') != 0 || sumAmountByCurrencyC($yes , null , 'TL') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , 'TL') != 0 || sumAmountByCurrencyTicket($yes , null , 'TL') != 0)
                <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{sumAmountByCurrencyC($yes , "net2" , 'TL')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , '€') != 0|| sumAmountByCurrencyC($yes , null , '€') != 0 || sumAmountByCurrencyC($yes , null , '€') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '€') != 0 || sumAmountByCurrencyTicket($yes , null , '€') != 0)
                        <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{sumAmountByCurrencyC($yes , "net2" , '€')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , '£') != 0|| sumAmountByCurrencyC($yes , null , '£') != 0 || sumAmountByCurrencyC($yes , null , '£') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '£') != 0 || sumAmountByCurrencyTicket($yes , null , '£') != 0)
                        <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{sumAmountByCurrencyC($yes , "net2" , '£')}}</td>
                @endif
            </tr>
            @endif
            @if(CountofTypeAadminCont($yes , "net2" , '$') != null)
            <tr>
                <td class="text-xsm font-weight-bold mb-0" >DIRECT Admin Commission</td>
                <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{CountofTypeAadminCont($yes , "net2" , '$')}}</td>
                @if(sumAmountByCurrencyAllsNets($yes , null , '$') != 0 || sumAmountByCurrencyC($yes , null , '$') != 0 || sumAmountByCurrencyC($yes , null , '$') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '$') != 0 || sumAmountByCurrencyTicket($yes , null , '$') != 0)
                    <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{sumAmountByCurrencyAllAdminAC($yes , "net2" , '$')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , 'TL') != 0|| sumAmountByCurrencyC($yes , null , 'TL') != 0 || sumAmountByCurrencyC($yes , null , 'TL') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , 'TL') != 0 || sumAmountByCurrencyTicket($yes , null , 'TL') != 0)
                <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{sumAmountByCurrencyAllAdminAC($yes , "net2" , 'TL')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , '€') != 0|| sumAmountByCurrencyC($yes , null , '€') != 0 || sumAmountByCurrencyC($yes , null , '€') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '€') != 0 || sumAmountByCurrencyTicket($yes , null , '€') != 0)
                        <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{sumAmountByCurrencyAllAdminAC($yes , "net2" , '€')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , '£') != 0|| sumAmountByCurrencyC($yes , null , '£') != 0 || sumAmountByCurrencyC($yes , null , '£') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '£') != 0 || sumAmountByCurrencyTicket($yes , null , '£') != 0)
                        <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{sumAmountByCurrencyAllAdminAC($yes , "net2" , '£')}}</td>
                @endif
            </tr>
            @endif
            @if(CountofTypeNets($yes , "net" , '$') != null)
            <tr>
                <td class="text-xsm font-weight-bold mb-0"> Paid By Us Net</td>
                <td class="text-xsm font-weight-bold mb-0" style="background:#fffc00;color:#333;">{{CountofTypeNets($yes , "net" , '$')}}</td>
                @if(sumAmountByCurrencyAllsNets($yes , null , '$') != 0 || sumAmountByCurrencyC($yes , null , '$') != 0 || sumAmountByCurrencyC($yes , null , '$') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '$') != 0 || sumAmountByCurrencyTicket($yes , null , '$') != 0)
                <td class="text-xsm font-weight-bold mb-0" style="background:#fffc00;color:#333;">-{{sumAmountByCurrencyAllsNets($yes , "net" , '$')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , 'TL') != 0|| sumAmountByCurrencyC($yes , null , 'TL') != 0 || sumAmountByCurrencyC($yes , null , 'TL') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , 'TL') != 0 || sumAmountByCurrencyTicket($yes , null , 'TL') != 0)
                <td class="text-xsm font-weight-bold mb-0" style="background:#fffc00;color:#333;">-{{sumAmountByCurrencyAllsNets($yes , "net" , 'TL')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , '€') != 0|| sumAmountByCurrencyC($yes , null , '€') != 0 || sumAmountByCurrencyC($yes , null , '€') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '€') != 0 || sumAmountByCurrencyTicket($yes , null , '€') != 0)
                <td class="text-xsm font-weight-bold mb-0" style="background:#fffc00;color:#333;">-{{sumAmountByCurrencyAllsNets($yes , "net" , '€')}}</td>
                    @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , '£') != 0|| sumAmountByCurrencyC($yes , null , '£') != 0 || sumAmountByCurrencyC($yes , null , '£') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '£') != 0 || sumAmountByCurrencyTicket($yes , null , '£') != 0)
                <td class="text-xsm font-weight-bold mb-0" style="background:#fffc00;color:#333;">-{{sumAmountByCurrencyAllsNets($yes , "net" , '£')}}</td>
                    @endif
            </tr>
            @endif
            <!--<tr>-->
            <!--    <td class="text-xsm font-weight-bold mb-0">Ticket DIRECT</td>-->
            <!--    <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{CountofTypeNetsTicket($yes , "dircit" , '$')}}</td>-->
            <!--    @if(sumAmountByCurrencyAllsNets($yes , null , '$') != 0 || sumAmountByCurrencyC($yes , null , '$') != 0 || sumAmountByCurrencyC($yes , null , '$') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '$') != 0 || sumAmountByCurrencyTicket($yes , null , '$') != 0)-->
            <!--    <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{sumAmountByCurrencyTicket($yes , "dircit" , '$')}}</td>-->
            <!--    @endif-->
            <!--    @if(sumAmountByCurrencyAllsNets($yes , null , 'TL') != 0|| sumAmountByCurrencyC($yes , null , 'TL') != 0 || sumAmountByCurrencyC($yes , null , 'TL') != 0  || sumAmountByCurrencyAllsNetsTicket($yes , null , 'TL') != 0 || sumAmountByCurrencyTicket($yes , null , 'TL') != 0)-->
            <!--    <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{sumAmountByCurrencyTicket($yes , "dircit" , 'TL')}}</td>-->
            <!--    @endif-->
            <!--    @if(sumAmountByCurrencyAllsNets($yes , null , '€') != 0|| sumAmountByCurrencyC($yes , null , '€') != 0 || sumAmountByCurrencyC($yes , null , '€') != 0  || sumAmountByCurrencyAllsNetsTicket($yes , null , '€') != 0 || sumAmountByCurrencyTicket($yes , null , '€') != 0)-->
            <!--    <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{sumAmountByCurrencyTicket($yes , "dircit" , '€')}}</td>-->
            <!--    @endif-->
            <!--    @if(sumAmountByCurrencyAllsNets($yes , null , '£') != 0|| sumAmountByCurrencyC($yes , null , '£') != 0 || sumAmountByCurrencyC($yes , null , '£') != 0  || sumAmountByCurrencyAllsNetsTicket($yes , null , '£') != 0 || sumAmountByCurrencyTicket($yes , null , '£') != 0)-->
            <!--    <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{sumAmountByCurrencyTicket($yes , "dircit" , '£')}}</td>-->
            <!--    @endif-->
            <!--</tr>-->
            <tr>
                <td class="text-xsm font-weight-bold mb-0">Ticket Paid By Us Net</td>
                <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{CountofTypeNetsTicket($yes , "us" , '$')}}</td>
                @if(sumAmountByCurrencyAllsNets($yes , null , '$') != 0 || sumAmountByCurrencyC($yes , null , '$') != 0 || sumAmountByCurrencyC($yes , null , '$') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '$') != 0  || sumAmountByCurrencyTicket($yes , null , '$') != 0)
                <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{sumAmountByCurrencyTicket($yes , "us" , '$')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , 'TL') != 0|| sumAmountByCurrencyC($yes , null , 'TL') != 0 || sumAmountByCurrencyC($yes , null , 'TL') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , 'TL') != 0  || sumAmountByCurrencyTicket($yes , null , 'TL') != 0)
                <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{sumAmountByCurrencyTicket($yes , "us" , 'TL')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , '€') != 0|| sumAmountByCurrencyC($yes , null , '€') != 0 || sumAmountByCurrencyC($yes , null , '€') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '€') != 0  || sumAmountByCurrencyTicket($yes , null , '€') != 0)
                <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{sumAmountByCurrencyTicket($yes , "us" , '€')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , '£') != 0|| sumAmountByCurrencyC($yes , null , '£') != 0 || sumAmountByCurrencyC($yes , null , '£') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '£') != 0  || sumAmountByCurrencyTicket($yes , null , '£') != 0)
                <td class="text-xsm font-weight-bold mb-0" style="background:#12ff00;color:#333;">{{sumAmountByCurrencyTicket($yes , "us" , '£')}}</td>
                @endif
            </tr>
        </tbody>
        <tfoot>
            <tr class="bg2">
                <td class="text-xsm font-weight-bold mb-0">Sum</td>
                <td class="text-xsm font-weight-bold mb-0">{{CountofTypeNets($yes , null , '$')}}</td>
                @if(sumAmountByCurrencyAllsNets($yes , null , '$') != 0 || sumAmountByCurrencyC($yes , null , '$') != 0 || sumAmountByCurrencyC($yes , null , '$') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '$') != 0  || sumAmountByCurrencyTicket($yes , null , '$') != 0)
                <td class="text-xsm font-weight-bold mb-0">{{sumAmountByCurrencyAllsNets($yes ,null, '$')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , 'TL') != 0|| sumAmountByCurrencyC($yes , null , 'TL') != 0 || sumAmountByCurrencyC($yes , null , 'TL') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , 'TL') != 0  || sumAmountByCurrencyTicket($yes , null , 'TL') != 0)
                <td class="text-xsm font-weight-bold mb-0">{{sumAmountByCurrencyAllsNets($yes ,null, 'TL')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , '€') != 0|| sumAmountByCurrencyC($yes , null , '€') != 0 || sumAmountByCurrencyC($yes , null , '€') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '€') != 0  || sumAmountByCurrencyTicket($yes , null , '€') != 0)
                <td class="text-xsm font-weight-bold mb-0">{{sumAmountByCurrencyAllsNets($yes ,null, '€')}}</td>
                @endif
                @if(sumAmountByCurrencyAllsNets($yes , null , '£') != 0|| sumAmountByCurrencyC($yes , null , '£') != 0 || sumAmountByCurrencyC($yes , null , '£') != 0 || sumAmountByCurrencyAllsNetsTicket($yes , null , '£') != 0  || sumAmountByCurrencyTicket($yes , null , '£') != 0)
                <td class="text-xsm font-weight-bold mb-0">{{sumAmountByCurrencyAllsNets($yes , null, '£')}}</td>
                @endif
            </tr>
        </tfoot>
    </table>
</div>
@endif
