
<div class="sumtions">

    @foreach($data as $key=>$ye)
        @foreach($ye as $key_yes => $yesw)
            <?php
                $iis2 += sumPartners($yesw ,null, '$');
                $iiss2 += sumPartners($yesw ,null, 'TL');
                $iissss2 += sumPartners($yesw ,null, '€');
                $iisss2 += sumPartners($yesw ,null, '£');
            ?>
        @endforeach
    @endforeach
    <?php
        $profPart1 = sumProfitPartners($yes ,@$ispartner->type, '$');
        $profPart2 = sumProfitPartners($yes ,@$ispartner->type, 'TL');
        $profPart3 = sumProfitPartners($yes ,@$ispartner->type, '€');
        $profPart4 = sumProfitPartners($yes ,@$ispartner->type, '£');
    ?>
    <?php
        $un_price1 = sumPartnersUnPaid($yes ,@$ispartner->type, '$');
        $un_price2 = sumPartnersUnPaid($yes ,@$ispartner->type, 'TL');
        $un_price3 = sumPartnersUnPaid($yes ,@$ispartner->type, '€');
        $un_price4 = sumPartnersUnPaid($yes ,@$ispartner->type, '£');
    ?>
    @if($iis2 != 0  || $profPart1 != 0 || $un_price1 != 0 || $iiss2 != 0  || $profPart2 != 0 || $un_price2 != 0 || $iissss2 != 0  || $profPart3 != 0 || $un_price3 != 0 || $iisss2 != 0  || $profPart4 != 0 || $un_price4 != 0)
    <table class="table align-items-center mt-4">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:120px;">Total</th>
                @if($iis2 != 0  || $profPart1 != 0 || $un_price1 != 0)
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">USD</th>
                @endif
                @if($iiss2 != 0  || $profPart2 != 0 || $un_price2 != 0)
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TURKISH LIRA</th>
                @endif
                @if($iissss2 != 0  || $profPart3 != 0 || $un_price3 != 0)
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">EURO</th>
                @endif
                @if($iisss2 != 0  || $profPart4 != 0 || $un_price4 != 0)
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">POUND</th>
                @endif
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-xsm font-weight-bold mb-0">AHLAN PROFIT</td>
                @if($iis2 != 0  || $profPart1 != 0 || $un_price1 != 0)
                <td class="text-xsm font-weight-bold mb-0">{{ $iis2 }}</td>
                @endif
                @if($iiss2 != 0  || $profPart2 != 0 || $un_price2 != 0)
                <td class="text-xsm font-weight-bold mb-0">{{ $iiss2 }}</td>
                @endif
                @if($iissss2 != 0  || $profPart3 != 0 || $un_price3 != 0)
                <td class="text-xsm font-weight-bold mb-0">{{ $iissss2}}</td>
                @endif
                @if($iisss2 != 0  || $profPart4 != 0 || $un_price4 != 0)
                <td class="text-xsm font-weight-bold mb-0">{{ $iisss2}}</td>
                @endif
            </tr>
            <tr>
                <td class="text-xsm font-weight-bold mb-0">Partner PROFIT</td>
                @if($iis2 != 0  || $profPart1 != 0 || $un_price1 != 0)
                <td class="text-xsm font-weight-bold mb-0">{{ $profPart1 }}</td>
                @endif
                @if($iiss2 != 0  || $profPart2 != 0 || $un_price2 != 0)
                <td class="text-xsm font-weight-bold mb-0">{{ $profPart2 }}</td>
                @endif
                @if($iissss2 != 0  || $profPart3 != 0 || $un_price3 != 0)
                <td class="text-xsm font-weight-bold mb-0">{{ $profPart3 }}</td>
                @endif
                @if($iisss2 != 0  || $profPart4 != 0 || $un_price4 != 0)
                <td class="text-xsm font-weight-bold mb-0">{{ $profPart4 }}</td>
                @endif
            </tr>
            <tr>
                <td class="text-xsm font-weight-bold mb-0">Price UnPaid</td>
                @if($iis2 != 0  || $profPart1 != 0 || $un_price1 != 0)
                <td class="text-xsm font-weight-bold mb-0">{{ $un_price1 }}</td>
                @endif
                @if($iiss2 != 0  || $profPart2 != 0 || $un_price2 != 0)
                <td class="text-xsm font-weight-bold mb-0">{{ $un_price2 }}</td>
                @endif
                @if($iissss2 != 0  || $profPart3 != 0 || $un_price3 != 0)
                <td class="text-xsm font-weight-bold mb-0">{{ $un_price3 }}</td>
                @endif
                @if($iisss2 != 0  || $profPart4 != 0 || $un_price4 != 0)
                <td class="text-xsm font-weight-bold mb-0">{{ $un_price4 }}</td>
                @endif
            </tr>
            <tr class="bg2">
                <td class="text-xsm font-weight-bold mb-0">sum</td>
                @if($iis2 != 0  || $profPart1 != 0)
                <td class="text-xsm font-weight-bold mb-0">{{ "(".$un_price1." + ".$iis2.") - ".$profPart1.") ="}} {{ $un_price1 + $iis2 - $profPart1 }}</td>
                @endif
                @if($iiss2 != 0  || $profPart2 != 0)
                <td class="text-xsm font-weight-bold mb-0">{{ "(".$un_price2." + ".$iiss2.") - ".$profPart2.") ="}}{{ $un_price2 + $iiss2 - $profPart2  }}</td>
                @endif
                @if($iissss2 != 0  || $profPart3 != 0)
                <td class="text-xsm font-weight-bold mb-0">{{ "(".$un_price3." + ".$iissss2.") - ".$profPart3.") ="}}{{ $un_price3 + $iissss2 - $profPart3 }}</td>
                @endif
                @if($iisss2 != 0  || $profPart4 != 0)
                <td class="text-xsm font-weight-bold mb-0">{{ "(".$un_price4." + ".$iisss2.") - ".$profPart4.") ="}}{{ $un_price4 + $iisss2 - $profPart4 }}</td>
                @endif
            </tr>
        </tbody>
    </table>
    @endif
</div>
