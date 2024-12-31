
    <tr>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            ID
        </th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:60px;padding: 0;">
            Date
        </th>
        <th class="" style="width:40px;padding: 0;">
            Type
        </th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="padding: 0;width:15%;">
            <p>Clinet Name</p>
            <p class="showmobile">Clinet</p>
        </th>
        <th class="" style="width:50px;padding: 0;">
            <!--<p><i class="fa fa-flag"></i></p>-->
            <p>LAND</p>
            <p class="showmobile">COUNTRY</p>
        </th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:240px;padding: 0;">
            
            <p>Service Description</p>
            <p class="showmobile">SAMMARY</p>
        </th>
        <!--<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">-->
        <!--    Type-->
        <!--</th>-->
        <?php $aush = Auth()->user() ?>
        @if(isset($ispartner->type) && $ispartner->type == 1)
        @else
        @if($aush->type != 3)
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 p-1"  style="width:50px;">
            Admin
        </th>
        @endif
        @endif
        
        @if(isset($aush) && $aush->type == 1)
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" style="width:8%;padding: 0 !important;">
            @if(isset($ispartner->type) && $ispartner->type == 5 && isset($is_partner) && $is_partner == true)
            LEAD BY
            @elseif(isset($ispartner->type) && $ispartner->type == 5)
            SEND BY
            @else
            User
            @endif
        </th>
        @elseif(isset($aush) && $aush->type == 2 )
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" style="width:8%;padding: 0 !important;">
            SEND BY
        </th>
        @elseif(isset($aush) && $aush->type == 5)
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" style="width:8%;padding: 0 !important;">
            LEAD BY
        </th>
        @endif
        
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:70px;padding: 0;">
            Price
        </th>
        
        @if((isset($request["d_user"]) && $request["d_user"] != null))
        @if($aush->type != 3)
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:80px;padding: 0;">
            Net
        </th>
        @endif
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:70px;padding: 0;">
            Profit
        </th>

        <!--<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">-->
        <!--    P Profit-->
        <!--</th>-->
        @endif
        <!-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            Country
        </th>
        <th class="last-child text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            PayByUs
        </th>
        <th class="last-child text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
            Status
        </th> -->
        <!-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 p-1">
            Commission
        </th> -->
        @if($aush->type == 1 || ($aush->type == 5 && @$is_partner == true))
        <th class="last-child text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width:60px;padding: 0;">
            Action
        </th>
        @endif
    </tr>
