<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta  name="keywords" content="AHLAN ANTALYA" />
      <meta  name="description" content="ACCOUNTING ADMINISTRATOR" />
      <meta  itemprop="name" content="AHLAN ANTALYA" />
      <meta  itemprop="description" content="ACCOUNTING ADMINISTRATOR" />
      <meta  itemprop="image" content="{{admin_url('bg.jpeg')}}" />
      <meta  name="twitter:card" content="product" />
      <meta  name="twitter:site" content="@AHLAN ANTALYA" />
      <meta  name="twitter:title" content="AHLAN ANTALYA" />
      <meta  name="twitter:description" content="ACCOUNTING ADMINISTRATOR" />
      <meta  name="twitter:creator" content="@AHLAN ANTALYA" />
      <meta  name="twitter:image" content="AHLAN ANTALYA" />
      <meta  property="fb:app_id" content="" />
      <meta  property="og:title" content="AHLAN ANTALYA" />
      <meta  property="og:type" content="article" />
      <meta  property="og:url" content="/" />
      <meta  property="og:image" content="{{admin_url('bg.jpeg')}}" />
      <meta  property="og:description" content="ACCOUNTING ADMINISTRATOR" />
      <meta  property="og:site_name" content="AHLAN ANTALYA" />

      <meta name="csrf-token" content="{{ csrf_token() }}" />

      <link rel="apple-touch-icon" sizes="76x76" href="{{admin_url('assets/img/apple-icon.png')}}">
      <link rel="icon" type="image/png" href="{{admin_url('assets/img/favicon.png')}}">
      <title>
          AHLAN ANTALYA
      </title>
      <!-- Fonts and icons     -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
      <!-- Nucleo Icons -->
      <link href="{{admin_url('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
      <link href="{{admin_url('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
      <!-- Font Awesome Icons -->
      <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
      <link href="{{admin_url('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
      <link href="{{admin_url('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
      <!-- CSS Files -->
      <link href="{{admin_url('assets/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" />
      <link id="pagestyle" href="{{admin_url('assets/css/soft-ui-dashboard.css')}}" rel="stylesheet" />
      <!-- Alpine -->
      <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

      <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
      @yield('panel_css')
      @yield('livewireHeader')
      <style>
      .check_center input{
        float: none !important;
        display: inline-block;
      }
      .check_center{
        text-align: center;
      }
      .logo_img img {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%,-50%);
    width: 100%;
}
.logo_img {
    display: block;
    width: 150px;
    height: 150px;
    overflow: hidden;
    position: relative;
    margin: auto;
}
      </style>
  </head>

  <body class="g-sidenav-show bg-gray-100">
      <section>
          <div class="page-header section-height-100">
              <div class="container">
                  <div class="row">
                      <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                          <div class="card card-plain mt-2">
                              <div class="card-header pb-0 text-left bg-transparent">
                                <div class="logo_img"><img src="{{admin_url('assets/img/logo-ct.png')}}"/></div>
                              </div>
                              <div class="card-body">
                                  @if(Session::has('message'))
                                    <div class="alert alert-danger">
                                      <b class="text-white">{{ Session::get('message') }}</b>
                                    </div>
                                  @endif
                                  @if(Session::has('danger'))
                                    <div class="alert alert-danger">
                                      <b class="text-white">{{ Session::get('danger') }}</b>
                                    </div>
                                  @endif
                                  <form action="{{ route('Plogin') }}" method="POST" role="form text-left">
                                    @csrf
                                      <div class="mb-3">
                                          <label for="email">{{ __('Email') }}</label>
                                          <div class="@error('email')border border-danger rounded-3 @enderror">
                                              <input  value="{{ old('email') }}"  name="email" id="email" type="text" class="form-control"
                                                  placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                                          </div>
                                          @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                                      </div>
                                      <div class="mb-3">
                                          <label for="password">{{ __('Password') }}</label>
                                          <div class="@error('password')border border-danger rounded-3 @enderror">
                                              <input id="password" name="password" type="password" class="form-control"
                                                  placeholder="Password" aria-label="Password" value="{{ @old('password') }}"
                                                  aria-describedby="password-addon">
                                          </div>
                                          @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                                      </div>
                                      <!--<div class="form-check form-switch">-->
                                      <!--    <input wire:model="remember_me" class="form-check-input" type="checkbox"-->
                                      <!--        id="rememberMe">-->
                                      <!--    <label class="form-check-label" for="rememberMe">{{ __('Remember me') }}</label>-->
                                      <!--</div>-->
                                      <div class="text-center">
                                          <button type="submit"
                                              class="btn bg-gradient-info w-100 mt-4 mb-0">{{ __('Sign in') }}</button>
                                      </div>
                                  </form>
                              </div>

                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                              <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                  style="background-image:url('/public/assets/img/curved-images/curved6.jpg')"></div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>

      <!--   Core JS Files   -->
      <script src="{{admin_url('assets/js/core/popper.min.js')}}"></script>
      <script src="{{admin_url('assets/js/core/bootstrap.min.js')}}"></script>
      <script src="{{admin_url('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
      <script>
          var win = navigator.platform.indexOf('Win') > -1;
          if (win && document.querySelector('#sidenav-scrollbar')) {
              var options = {
                  damping: '0.5'
              }
              Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
          }
      </script>
      <!-- Github buttons -->
      <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
      <script src="{{admin_url('assets/js/soft-ui-dashboard.min.js?v=1.0.2')}}"></script>
      @yield('livewireScripts')

      <!-- Latest compiled and minified JavaScript -->
      <script src="{{admin_url('assets/js/jquery.min.js')}}"></script>
      <script src="{{admin_url('assets/js/bootstrap-datepicker.min.js')}}"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
      @yield('panel_js')
      <script>

      </script>
  </body>
</html>
