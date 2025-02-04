
<main class="main-content mt-1 border-radius-lg">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
        navbar-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                @isset($breadcrumbs)
                {!! $breadcrumbs !!}
                @else
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-md"><a class="opacity-5 text-dark" href="{{url('/')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                    @yield('sub_title')</li>
                </ol>
                @endisset
                <!-- <h6 class="font-weight-bolder mb-0 text-capitalize">@yield('sub_title')</h6> -->
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
                <ul class="navbar-nav justify-content-end">
                    <!-- <li class="nav-item d-flex align-items-center">
                        <a href="{{ route('panel.logout') }}" class="nav-link text-body font-weight-bold px-0">
                            <div>
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">Sign Out</span>
                            </div>
                        </a>
                    </li> -->
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>

                    <li class="nav-item dropdown px-3 pe-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bell cursor-pointer"></i>
                            <?php $n_count = auth()->user()->tonotification->count(); ?>
                            @if($n_count > 0)
                            <span class="badge bg-danger">{{$n_count}}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4 notifications" aria-labelledby="dropdownMenuButton">
                        @foreach(auth()->user()->allnotification as $notification)
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md {{ $notification->notification->status == 0 ? "active" : "" }}" href="{{ route('panel.todolist.add_retweet' , $notification->notification->notification_ids == null ? $notification->notification->notification_id : $notification->notification->notification_ids) }}">
                                    <div class="d-flex py-1">
                                        <div class="my-auto">
                                            <img src="{{ $notification->notification->f_user->avatar }}" class="avatar avatar-sm  me-3 ">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                {!! Str::limit($notification->notification->text, 15) !!}
                                            </h6>
                                            <p class="text-xs text-secondary mb-0">
                                                <i class="fa fa-clock me-1"></i>
                                                {{ $notification->notification->created_at}}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach

                        </ul>
                    </li>

                    <li class="nav-item dropdown px-3 pe-2 d-flex align-items-center">
                        <a href="{{url('/')}}" class="nav-link text-body p-0"><i class="fa fa-home"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

