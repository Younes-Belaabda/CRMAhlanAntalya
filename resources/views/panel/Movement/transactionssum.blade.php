<style>
    .cols_3 td, .cols_3 th {
    width: 33.3%;
}
.cols_4 td, .cols_4 th {
    width: 25%;
}
.cols_5 td, .cols_5 th {
    width: 20%;
}
.cols_6 td, .cols_6 th {
    width: 15%;
}
</style>

@if(sumAmountByCurrencyMoveCount($moves_dataJust ,null,0) != 0 || sumAmountByCurrencyMoveCount($moves_dataJust ,null,1) != 0 || sumAmountByCurrencyMoveCount($moves_dataJust ,"profit",1) != 0)
<div class="sumtions">
    <?php 
        $cols = 2;
        if(sumAmountByCurrencyMove($moves_dataJust ,null,0, '$') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, '$') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '$')){
            $cols++;
        }
        if(sumAmountByCurrencyMove($moves_dataJust ,null,0, 'TL') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, 'TL') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, 'TL')){
            $cols++;
        }
        if(sumAmountByCurrencyMove($moves_dataJust ,null,0, '€') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, '€') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '€')){
            $cols++;
        }
        if(sumAmountByCurrencyMove($moves_dataJust ,null,0, '£') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, '£') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '£')){
            $cols++;
        }
    ?>
    <table class="table align-items-center mt-4 mb-0 {{'cols_'.$cols}}">
        <thead>
            <tr class="bg">
                <th  colspan="10">Total</th>
            </tr>
        </thead>
    </table>
    <table class="table align-items-center mt-0 {{'cols_'.$cols}}">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 17%;">Status</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                @if(sumAmountByCurrencyMove($moves_dataJust ,null,0, '$') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, '$') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '$'))
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">USD</th>
                @endif
                @if(sumAmountByCurrencyMove($moves_dataJust ,null,0, 'TL') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, 'TL') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, 'TL'))
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TURKISH LIRA</th>
                @endif
                @if(sumAmountByCurrencyMove($moves_dataJust ,null,0, '€') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, '€') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '€'))
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">EURO</th>
                @endif
                @if(sumAmountByCurrencyMove($moves_dataJust ,null,0, '£') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, '£') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '£'))
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">POUND</th>
                @endif
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-xs font-weight-bold mb-0">Paid By Us (UnPaid)</td>
                <td class="text-xs font-weight-bold mb-0" style="background: #fffc00;">{{ $_1_0 = sumAmountByCurrencyMoveCount($moves_dataJust ,null,0)}}</td>
                @if(sumAmountByCurrencyMove($moves_dataJust ,null,0, '$') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, '$') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '$'))
                <td class="text-xs font-weight-bold mb-0" style="background: #fffc00;">{{ $_1_1 = sumAmountByCurrencyMove($moves_dataJust ,null,0, '$')}}</td>
                @endif
                @if(sumAmountByCurrencyMove($moves_dataJust ,null,0, 'TL') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, 'TL') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, 'TL'))
                <td class="text-xs font-weight-bold mb-0" style="background: #fffc00;">{{ $_1_2 = sumAmountByCurrencyMove($moves_dataJust ,null,0, 'TL')}}</td>
                @endif
                @if(sumAmountByCurrencyMove($moves_dataJust ,null,0, '€') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, '€') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '€'))
                <td class="text-xs font-weight-bold mb-0" style="background: #fffc00;">{{ $_1_3 = sumAmountByCurrencyMove($moves_dataJust ,null,0, '€')}}</td>
                @endif
                @if(sumAmountByCurrencyMove($moves_dataJust ,null,0, '£') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, '£') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '£'))
                <td class="text-xs font-weight-bold mb-0" style="background: #fffc00;">{{ $_1_4 = sumAmountByCurrencyMove($moves_dataJust ,null,0, '£')}}</td>
                @endif
            </tr>
            <tr>
                <td class="text-xs font-weight-bold mb-0">Paid By Us (Paid)</td>
                <td class="text-xs font-weight-bold mb-0" style="background: #12ff00;">{{ $_2_0 = sumAmountByCurrencyMoveCount($moves_dataJust ,null,1)}}</td>
                @if(sumAmountByCurrencyMove($moves_dataJust ,null,0, '$') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, '$') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '$'))
                <td class="text-xs font-weight-bold mb-0" style="background: #12ff00;">{{ $_2_1 = sumAmountByCurrencyMove($moves_dataJust ,null,1, '$')}}</td>
                @endif
                @if(sumAmountByCurrencyMove($moves_dataJust ,null,0, 'TL') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, 'TL') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, 'TL'))
                <td class="text-xs font-weight-bold mb-0" style="background: #12ff00;">{{ $_2_2 = sumAmountByCurrencyMove($moves_dataJust ,null,1, 'TL')}}</td>
                @endif
                @if(sumAmountByCurrencyMove($moves_dataJust ,null,0, '€') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, '€') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '€'))
                <td class="text-xs font-weight-bold mb-0" style="background: #12ff00;">{{ $_2_3 = sumAmountByCurrencyMove($moves_dataJust ,null,1, '€')}}</td>
                @endif
                @if(sumAmountByCurrencyMove($moves_dataJust ,null,0, '£') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, '£') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '£'))
                <td class="text-xs font-weight-bold mb-0" style="background: #12ff00;">{{ $_2_4 = sumAmountByCurrencyMove($moves_dataJust ,null,1, '£')}}</td>
                @endif
            </tr>
            @if(sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '$') != 0)
            <tr>
                <td class="text-xs font-weight-bold mb-0">Agent Profit</td>
                <td class="text-xs font-weight-bold mb-0" style="background:#2196f366;">{{ $_3_0 = sumAmountByCurrencyMoveCount($moves_dataJust ,"profit",1)}}</td>
                @if(sumAmountByCurrencyMove($moves_dataJust ,null,0, '$') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, '$') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '$'))
                <td class="text-xs font-weight-bold mb-0" style="background:#2196f366;">{{ $_3_1 = sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '$')}}</td>
                @endif
                @if(sumAmountByCurrencyMove($moves_dataJust ,null,0, 'TL') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, 'TL') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, 'TL'))
                <td class="text-xs font-weight-bold mb-0" style="background:#2196f366;">{{ $_3_2 = sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, 'TL')}}</td>
                @endif
                @if(sumAmountByCurrencyMove($moves_dataJust ,null,0, '€') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, '€') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '€'))
                <td class="text-xs font-weight-bold mb-0" style="background:#2196f366;">{{ $_3_3 = sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '€')}}</td>
                @endif
                @if(sumAmountByCurrencyMove($moves_dataJust ,null,0, '£') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, '£') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '£'))
                <td class="text-xs font-weight-bold mb-0" style="background:#2196f366;">{{ $_3_4 = sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '£')}}</td>
                @endif
            </tr>
            
            @endif
            <?php 
                $_4_1 = sumAmountByCurrencyInc($data_e ,null, '$',"Income");
                $_4_2 = sumAmountByCurrencyInc($data_e ,null, 'TL',"Income");
                $_4_3 = sumAmountByCurrencyInc($data_e ,null, '€',"Income");
                $_4_4 = sumAmountByCurrencyInc($data_e ,null, '£',"Income");
                $_6_1 = sumAmountByCurrencyInc($data_e ,null, '$',"Expenses");
                $_6_2 = sumAmountByCurrencyInc($data_e ,null, 'TL',"Expenses");
                $_6_3 = sumAmountByCurrencyInc($data_e ,null, '€',"Expenses");
                $_6_4 = sumAmountByCurrencyInc($data_e ,null, '£',"Expenses");
            ?>
            @if(sumAmountByCurrencyInc($data_e ,null, '$',"Income") != 0)
            <!--<tr>-->
            <!--    <td class="text-xs font-weight-bold mb-0">Transfer</td>-->
            <!--    <td class="text-xs font-weight-bold mb-0">{{ $_4_1 = sumAmountByCurrencyInc($data_e ,null, '$',"Income")}}</td>-->
            <!--    <td class="text-xs font-weight-bold mb-0">{{ $_4_2 = sumAmountByCurrencyInc($data_e ,null, 'TL',"Income")}}</td>-->
            <!--    <td class="text-xs font-weight-bold mb-0">{{ $_4_3 = sumAmountByCurrencyInc($data_e ,null, '€',"Income")}}</td>-->
            <!--    <td class="text-xs font-weight-bold mb-0">{{ $_4_4 = sumAmountByCurrencyInc($data_e ,null, '£',"Income")}}</td>-->
            <!--</tr>-->
            @endif
            <tr class="bg2">
                <td class="text-xs font-weight-bold mb-0">Sum</td>
                <td class="text-xs font-weight-bold mb-0">(Agent Profit + Transfer ) - Paid By Us </td>
                <?php 
                    $_5_1 = sumAmountByCurrencyMove($moves_dataJust ,null,3, '$');
                    $_5_2 = sumAmountByCurrencyMove($moves_dataJust ,null,3, 'TL');
                    $_5_3 = sumAmountByCurrencyMove($moves_dataJust ,null,3, '€');
                    $_5_4 = sumAmountByCurrencyMove($moves_dataJust ,null,3, '£');
                ?>
                @if(sumAmountByCurrencyMove($moves_dataJust ,null,0, '$') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, '$') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '$'))
                <td class="text-xs font-weight-bold mb-0">{{ "(".$_3_1 ."+(". $_4_1."-".$_6_1.")) - ". $_5_1 . " = "}} {{ ($_3_1 + ($_4_1-$_6_1)) - $_5_1 }}</td>
                @endif
                @if(sumAmountByCurrencyMove($moves_dataJust ,null,0, 'TL') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, 'TL') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, 'TL'))
                <td class="text-xs font-weight-bold mb-0">{{ "(".$_3_2 ."+(". $_4_2."-".$_6_2.")) - ". $_5_2 . " = "}}{{ ($_3_2 + ($_4_2-$_6_2)) - $_5_2 }}</td>
                @endif
                @if(sumAmountByCurrencyMove($moves_dataJust ,null,0, '€') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, '€') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '€'))
                <td class="text-xs font-weight-bold mb-0">{{ "(".$_3_3 ."+(". $_4_3."-".$_6_3.")) - ". $_5_3 . " = "}}{{ ($_3_3 + ($_4_3-$_6_3)) - $_5_3 }}</td>
                @endif
                @if(sumAmountByCurrencyMove($moves_dataJust ,null,0, '£') != 0 || sumAmountByCurrencyMove($moves_dataJust ,null,1, '£') || sumAmountByCurrencyMove($moves_dataJust ,"revenue_partner", 0, '£'))
                <td class="text-xs font-weight-bold mb-0">{{ "(".$_3_4 ."+(". $_4_4."-".$_6_4.")) - ". $_5_4 . " = "}}{{  ($_3_4 + ($_4_4-$_6_4)) -$_5_4 }}</td>
                @endif
            </tr>
        </tbody>
    </table>
</div>
@endif