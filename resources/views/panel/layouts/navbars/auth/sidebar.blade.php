<style>
    .navbar-vertical.navbar-expand-xs .navbar-nav .nav-link {
        padding: 5px;
        margin-bottom: 2px;
    }
</style>
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-left"
    id="sidenav-main">
    <div class="sidenav-header0 pb-2">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute right-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 pt-0 pb-0" href="{{ route('panel.dashboard') }}">
            <img src="{{auth()->user()->Avatar}}" class="navbar-brand-img h-100" alt="..." style="border-radius: 50%;">
            <span class="ms-1 font-weight-bold">{{ auth()->user()->full_name }}</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <!-- <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'panel.dashboard' ? 'active' : '' }}"
                    href="{{ route('panel.dashboard') }}">
                    <div
                        class="icon bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-home"></i>
                    </div>
                    <span class="nav-link-text ms-1">Home</span>
                </a>
            </li> -->
            <!--<li class="nav-item mt-2">-->
            <!--    <h6 class="text-uppercase text-xs font-weight-bolder opacity-6">entries</h6>-->
            <!--</li>-->
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'panel.movement.view' || Route::currentRouteName() == 'panel.movement.add_new' ? 'active' : '' }}"
                    href="{{ route('panel.movement.view') }}">
                    <div
                        class="icon  bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-arrows-alt ps-2 pe-2 text-center
                        {{ in_array(request()->route()->getName(),['panel.movement.view']) ? 'text-white' : ( in_array(request()->route()->getName(),['panel.movement.add_new']) ? 'text-white' :'text-dark') }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">all entries</span>
                </a>
            </li>
            @if(Auth()->user()->type == 1 || Auth()->user()->type == 5)
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'panel.todolist.view' || Route::currentRouteName() == 'panel.todolist.add_new' || Route::currentRouteName() == 'panel.todolist.add_retweet' ? 'active' : '' }}"
                    href="{{ route('panel.todolist.view') }}">
                    <div
                        class="icon  bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-bell ps-2 pe-2 text-center
                        {{ in_array(request()->route()->getName(),['panel.todolist.view']) ? 'text-white' : ( in_array(request()->route()->getName(),['panel.todolist.add_new']) ? 'text-white' : ( in_array(request()->route()->getName(),['panel.todolist.add_retweet']) ? 'text-white' :'text-dark')) }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">IMPORTANT</span>
                </a>
            </li>
            @endif
            @if(Auth()->user()->type == 1)
            <li class="nav-item hide-mobile">
                <a class="nav-link {{ Route::currentRouteName() == 'panel.report.summary' ? 'active' : '' }}"
                    href="{{ route('panel.report.summary') }}">
                    <div
                        class="icon  bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-bookmark ps-2 pe-2 text-center
                        {{ Route::currentRouteName() == 'panel.report.summary' ? 'text-white' :'text-dark' }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Summary</span>
                </a>
            </li>
            @endif
            @if(Auth()->user()->type == 1)
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'panel.users.view' || Route::currentRouteName() == 'panel.users.add_new' ? 'active' : '' }}"
                    href="{{ route('panel.users.view') }}">
                    <div
                        class="icon  bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-users ps-2 pe-2 text-center
                        {{ in_array(request()->route()->getName(),['panel.users.view']) ? 'text-white' : ( in_array(request()->route()->getName(),['panel.users.add_new']) ? 'text-white' :'text-dark') }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Users</span>
                </a>
            </li>
            <li class="nav-item hide-mobile">
                <a class="nav-link {{ Route::currentRouteName() == 'panel.countries.view' || Route::currentRouteName() == 'panel.countries.add_new' ? 'active' : '' }}"
                    href="{{ route('panel.countries.view') }}">
                    <div
                        class="icon  bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-flag ps-2 pe-2 text-center
                        {{ in_array(request()->route()->getName(),['panel.countries.view']) ? 'text-white' : ( in_array(request()->route()->getName(),['panel.countries.add_new']) ? 'text-white' :'text-dark') }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Countries</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'panel.debt.view' || Route::currentRouteName() == 'panel.debt.add_new' ? 'active' : '' }}"
                    href="{{ route('panel.debt.view') }}">
                    <div
                        class="icon  bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-coins ps-2 pe-2 text-center
                        {{ in_array(request()->route()->getName(),['panel.debt.view']) ? 'text-white' : ( in_array(request()->route()->getName(),['panel.debt.add_new']) ? 'text-white' :'text-dark') }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Debt</span>
                </a>
            </li>
            @endif
            <!-- <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'panel.report.source_service' ? 'active' : '' }}"
                    href="{{ route('panel.report.source_service') }}">
                    <div
                        class="icon  bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-arrows-alt ps-2 pe-2 text-center
                        {{ Route::currentRouteName() == 'panel.report.source_service' ? 'text-white'  :'text-dark' }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Reprots</span>
                </a>
            </li> -->
            <!--<li class="nav-item mt-2">-->
            <!--    <h6 class="text-uppercase text-xs font-weight-bolder opacity-6">General</h6>-->
            <!--</li>-->
            @if(Auth()->user()->type == 1 && Auth()->user()->id != 5)
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'panel.cash.view' || Route::currentRouteName() == 'panel.cash.add_new' ? 'active' : '' }}"
                    href="{{ route('panel.cash.view') }}">
                    <div
                        class="icon  bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-usd ps-2 pe-2 text-center
                        {{ in_array(request()->route()->getName(),['panel.cash.view']) ? 'text-white' : ( in_array(request()->route()->getName(),['panel.cash.add_new']) ? 'text-white' :'text-dark') }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Accounting</span>
                </a>
            </li>
            @endif
            
            @if(Auth()->user()->type == 1)
            <!--<li class="nav-item mt-2">-->
            <!--    <h6 class="text-uppercase text-xs font-weight-bolder opacity-6">Accounts</h6>-->
            <!--</li>-->
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'panel.payments.view' ? 'active' : '' }}"
                    href="{{ route('panel.payments.view') }}">
                    <div
                        class="icon  bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-credit-card-alt ps-2 pe-2 text-center
                        {{ in_array(request()->route()->getName(),['panel.payments.view']) ? 'text-white' : ( in_array(request()->route()->getName(),['panel.payments.add_new']) ? 'text-white' :'text-dark') }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Payments</span>
                </a>
            </li>
            <li class="nav-item hide-mobile">
                <a class="nav-link {{ Route::currentRouteName() == 'panel.backup.view' ? 'active' : '' }}"
                    href="{{ route('panel.backup.view') }}">
                    <div
                        class="icon  bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-download ps-2 pe-2 text-center
                        {{ in_array(request()->route()->getName(),['panel.backup.view']) ? 'text-white' : ( in_array(request()->route()->getName(),['panel.backup.add_new']) ? 'text-white' :'text-dark') }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">BackUps</span>
                </a>
            </li>
            @endif
            @if(Auth()->user()->id == 6)
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'panel.voucher.view' || Route::currentRouteName() == 'panel.voucher.add_new' ? 'active' : '' }}"
                    href="{{ route('panel.voucher.view') }}">
                    <div
                        class="icon  bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-bed ps-2 pe-2 text-center
                        {{ in_array(request()->route()->getName(),['panel.voucher.view']) ? 'text-white' : ( in_array(request()->route()->getName(),['panel.voucher.add_new']) ? 'text-white' :'text-dark') }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">voucher</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'panel.invoice.view' || Route::currentRouteName() == 'panel.invoice.add_new' ? 'active' : '' }}"
                    href="{{ route('panel.invoice.view') }}">
                    <div
                        class="icon  bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-file-text ps-2 pe-2 text-center
                        {{ in_array(request()->route()->getName(),['panel.invoice.view']) ? 'text-white' : ( in_array(request()->route()->getName(),['panel.invoice.add_new']) ? 'text-white' :'text-dark') }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">invoice</span>
                </a>
            </li>
            @endif
            @if(Auth()->user()->type == 1)
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'panel.prices.view' || Route::currentRouteName() == 'panel.prices.add_new' ? 'active' : '' }}"
                    href="{{ route('panel.prices.view') }}">
                    <div
                        class="icon  bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-user ps-2 pe-2 text-center
                        {{ in_array(request()->route()->getName(),['panel.prices.view']) ? 'text-white' : ( in_array(request()->route()->getName(),['panel.prices.add_new']) ? 'text-white' :'text-dark') }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">FOR AGENCIES</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'panel.voucher.view' || Route::currentRouteName() == 'panel.voucher.add_new' ? 'active' : '' }}"
                    href="{{ route('panel.voucher.view') }}">
                    <div
                        class="icon  bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-bed ps-2 pe-2 text-center
                        {{ in_array(request()->route()->getName(),['panel.voucher.view']) ? 'text-white' : ( in_array(request()->route()->getName(),['panel.voucher.add_new']) ? 'text-white' :'text-dark') }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">voucher</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'panel.invoice.view' || Route::currentRouteName() == 'panel.invoice.add_new' ? 'active' : '' }}"
                    href="{{ route('panel.invoice.view') }}">
                    <div
                        class="icon  bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-file-text ps-2 pe-2 text-center
                        {{ in_array(request()->route()->getName(),['panel.invoice.view']) ? 'text-white' : ( in_array(request()->route()->getName(),['panel.invoice.add_new']) ? 'text-white' :'text-dark') }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">invoice</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'panel.setting.view' ? 'active' : '' }}"
                    href="{{ route('panel.setting.view') }}">
                    <div
                        class="icon  bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-phone-alt ps-2 pe-2 text-center
                        {{ in_array(request()->route()->getName(),['panel.setting.view']) ? 'text-white' :'text-dark' }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Contact</span>
                </a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link"
                    href="{{ route('panel.hotels') }}">
                    <div
                        class="icon  bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-bed ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">hotels</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                    href="{{ route('panel.transfers') }}">
                    <div
                        class="icon  bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-plane-departure ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">transfers</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                    href="{{ route('panel.driver-tours') }}">
                    <div
                        class="icon  bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-bus ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">driver-tours</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('panel.logout') }}">
                    <div
                        class="icon  bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-sign-out ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">Logout</span>
                </a>
            </li>

        </ul>
    </div>
</aside>
