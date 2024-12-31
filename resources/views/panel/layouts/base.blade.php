<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta  name="keywords" content="AHLAN ANTALYA" />
      <meta  name="description" content="AHLAN ANTALYA" />
      <meta  itemprop="name" content="AHLAN ANTALYA" />
      <meta  itemprop="description" content="AHLAN ANTALYA" />
      <meta  itemprop="image" content="{{admin_url('bg.jpeg')}}" />
      <meta  name="twitter:card" content="product" />
      <meta  name="twitter:site" content="@AHLAN ANTALYA" />
      <meta  name="twitter:title" content="AHLAN ANTALYA" />
      <meta  name="twitter:description" content="AHLAN ANTALYA" />
      <meta  name="twitter:creator" content="@AHLAN ANTALYA" />
      <meta  name="twitter:image" content="AHLAN ANTALYA" />
      <meta  property="fb:app_id" content="" />
      <meta  property="og:title" content="AHLAN ANTALYA" />
      <meta  property="og:type" content="article" />
      <meta  property="og:url" content="/" />
      <meta  property="og:image" content="{{admin_url('bg.jpeg')}}" />
      <meta  property="og:description" content="AHLAN ANTALYA" />
      <meta  property="og:site_name" content="AHLAN ANTALYA" />

      <meta name="csrf-token" content="{{ csrf_token() }}" />

      <link rel="apple-touch-icon" sizes="76x76" href="{{admin_url('assets/img/apple-icon.png')}}">
      <link rel="icon" type="image/png" href="{{admin_url('assets/img/favicon.png')}}">
      <title>
          AHLAN ANTALYA - @yield('sub_title')
      </title>
      <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
      <!-- Fonts and icons     -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
      <!-- Nucleo Icons -->
      <link href="{{admin_url('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
      <link href="{{admin_url('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
      <!-- Font Awesome Icons -->
      <!--<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
      <link href="{{admin_url('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
      <link href="{{admin_url('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
      <!-- CSS Files -->
      <link href="{{admin_url('assets/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" />
      <link href="{{admin_url('assets/basictable/css/basictable.css')}}" rel="stylesheet" />
      
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      <link id="pagestyle" href="{{admin_url('assets/css/soft-ui-dashboard.css')}}" rel="stylesheet" />
      <!--<link id="pagestyle" href="{{admin_url('assets/css/style.css')}}" rel="stylesheet" />-->
      
      
      @yield('panel_css')
      @yield('livewireHeader')
      <style>
      /*table{*/
      /*    display:none;*/
      /*}*/
      button.close {
            border: 0;
            background: transparent;
        }
        .modal.fade.show {
            display: block;
        }
        .dropdown-item.active p{
            color:#E91E63 !important;
        }
        .dropdown-item.active {
            color: #252f40;
            background-color: #e9ecef
        }
      .font-weight-normal p{
          margin-bottom:0px !important;
      }
    ul.notifications {
        max-height: 400px;
        overflow: auto;
    }a.btn.bg-gradient-dark.btn-sm.mb-2 {
    padding: 0.5rem 1rem;
}
</style>
    <style>
    .table tr td, .table tr th, .font-weight-bold{
        
    white-space: inherit;
    }
    .form-switch .form-check-input{
        height: 1.4em;
    }
    table.table td {
    font-size: 14px;
    box-shadow: inset 0px 0px 0px 0.3px #000 !important;
}
    .table tr td,
    .table tr th,
    .font-weight-bold{
        font-weight: bold !important;
    }
    table.table td{
        color:#000;
    }
    .sidenav .navbar-brand {
    padding: 1.5rem 1rem;
}
    span.info {
    text-transform: uppercase !important;
}
        .sumtions table td{
            height: 22px;
        }
        .table tr.bg2 td:first-child{
            color: #fff !important;
            background-image: linear-gradient(310deg, #141727 0%, #3A416F 100%) !important;
        }
        .table tr.bg2 td{
            color: #333 !important;
            background: #ffc107 !important;
        }
    </style>
    <Style>
    .navbar-vertical .navbar-brand-img, .navbar-vertical .navbar-brand>img{
        
    width: 32px !important;
    height: 32px !important;
    }
    .table tr td:first-child {
        background: #2196f366 !important;
    }
    .text-xsm{
        color: #000;
    }
    .text-xs {
        font-size: 0.75rem !important;
            color: #000;
        }
        .swal2-title ,.swal2-actions bttuon{
            text-transform: uppercase;
        }
        .table thead th{
            padding: 0.45rem 1.5rem;
        }
        .user p ,.user a{
            border-bottom:2px solid #fff;
        }
        .user a:last-child,
        .user p:last-child{
            border-bottom:0;
        }
        h5.mb-1.show_accro.show:before {
            content: "\f077";
        }
        h5.mb-1.show_accro:before {
            content: "\f078";
            font-family:"FontAwesome";
            position: absolute;
            left: -2px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: #e91e63;
        }
        .hide_accro.show{
            display:inline-block;
        }
        .show_accro{
            padding-left:15px;
            position: relative;
            cursor: pointer;
        }
        .hide_accro {
            display: none;
        }
        .checkbox input {
            display: none;
        }
        .mr-2 {
            margin-right: 5px;
        }
        th.p-0{
            padding-right:0;
        }
        input {
            text-transform: uppercase;
            text-align:center;
        }
        .form-check-input.ms-auto.is-displayed {
            text-align: revert;
        }
        .datepicker table tr td.thisdate {
            color: #fff !important;
            background: #4caf50;
        }
        .datepicker table tr td.active.day,
        .datepicker table tr td.active.day.thisdate{
            color: #fff !important;
        }
         .datepicker table tr td.day {
            color: #444;
        }
         .datepicker table tr td.new {
            color: #333;
        }
        .datepicker table tr td.olds {
            color: #e91e63;
        }
        table.table-condensed {
            float: right;
            width: 100%;
            padding: 5px;
        }
        table.table-condensed td {
            padding: 2px;
            width: 35px;
            text-align: center;
        }
        .checkbox input:checked + label:after {
            content: "\f00c";
            font-family:"FontAwesome";
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 40px;
            height: 40px;
            color: #fff;
            font-size: 22px;
            text-align: center;
            line-height: 40px;
            background: #4caf50;
        }
        .checkbox label:before {
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 40px;
            height: 40px;
        }
        .checkbox label {
            float: left;
            width: 100%;
            padding-left: 45px;
            position: relative;
        }
        .checkbox {
            float: left;
            width: 100%;
            margin-top: 41px;
        }
        .select2-results__option--selectable{
            text-align: center;
        }
        .icon.bg-white.text-center.me-2.d-flex.align-items-center.justify-content-center {
            background-color: transparent !important;
            background-image: none;
        }
        .navbar-vertical .navbar-nav>.nav-item .nav-link.active .icon {
            background-image: linear-gradient(310deg, #f53939 0%, #f53939 100%) !important;
        }
        label.form-control-label {
            text-transform: uppercase;
            text-align: center;
        }
        select, option {
    text-transform: uppercase !important;
}
        td.user {
            padding: 0;
        }
        th.incs,td.incs {
    width: 50px !important;
}
        td.user a,
        td.user p {
            float: right;
            width: 100%;
            padding: 14px 5px;
        }
        /* .export_pdf {
            float: right;
            width: 90px;
            position: absolute;
            right: -20px;
            top: -16px;
        } */
    </style>
      <style>
      .check_center input{
        float: none !important;
        display: inline-block;
      }
      .check_center{
        text-align: center;
      }
      .navbar-vertical .navbar-nav>.nav-item .nav-link.active .icon {
            background-image: linear-gradient(310deg, #f53939 0%, #f53939 100%);
            font-size: 10px;
            width: 18px;
            height: 18px;
            border-radius: 5px;
            color: #fff;
        }
        .select2-selection.select2-selection--multiple{
            display: block;
            width: 100%;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #d2d6da;
            appearance: none;
            border-radius: 0.5rem;
            transition: box-shadow 0.15s ease, border-color 0.15s ease;
            height: 40.4px;
        }
        .select2-selection.select2-selection--single{
            display: block;
            width: 100%;
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.4rem;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #d2d6da;
            appearance: none;
            border-radius: 0.5rem;
            transition: box-shadow 0.15s ease, border-color 0.15s ease;
            height: 40.4px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40.4px;
        }
        table.table tbody td p{
            margin-bottom: 0;
            font-size: 11px !important;
            color: #000 !important;
            text-align: center;
            font-weight: bold !important;
            opacity: 1 !important;
        }
        table.table thead th p{
            color: #000 !important;
            text-align: center;
            font-weight: bold !important;
            opacity: 1 !important;
            font-size: 12px !important;
            margin-bottom: 0;
        }
        table.table thead th {
            border: 1px solid #333 !important;
            background: #ddd;
            color: #000 !important;
            text-align: center;
            font-weight: bold !important;
            opacity: 1 !important;
            font-size: 12px !important;
            background: #2196f366;
            text-transform: uppercase !important;
            box-shadow: 0px 0px 0px 0.5px #000;
        }
        .messages ul {
            list-style: none;
        }
        .select2-container{
            width: 100% !important;
        }
        html {
            overflow-x: hidden;
            text-transform: uppercase !important;
        }
        table.table thead tr th.price{
            width: 20px !important;
            padding: 0 2px;
        }
        table.table thead .bg th{
            color:#fff !important;
            background-image: linear-gradient(310deg, #141727 0%, #3A416F 100%) !important;
        }
        #exp_pdf {
            background:#fff;
        }
        
ul.munths a.selected {
    background-color: #252f40;
    border-color: #252f40;
    color:#fff;
}
ul.munths a {
    float: right;
    min-width: 28px;
    height: 28px;
    border: 1px solid #ddd;
    font-size: 12px;
    text-align: center;
    line-height: 28px;
    border-radius: 5px;
    padding:0px 5px;
}
ul.munths li {
    float: left;
    margin-right: 5px;
}
ul.munths {
    display: inline-block;
    margin-right: 5px;
    list-style: none;
    padding: 0;
    margin-bottom: -5px;
}
        .text-xst {
            font-size: 0.75rem !important;
    color: #000000;
        }
        table.table tbody td.user a,
        table.table tbody td.user p{
            /*/padding: 7px 5px !important;*/
            
            padding: 12px 5px !important;
            height: 40px;
        }
        table.table tbody td.user{
            padding:0 !important;
        }
        table.table td {
            border: 1px solid #333 !important;
            background:#fff;
            text-align: center;
            box-shadow: 0px 0px 0px 0.5px #000;
            padding: 0 5px !important;
        }
        /*table.table tr td,table.table thead tr th{*/
        /*    border: 2px solid #333 !important;*/
        /*}*/
        .table th:first-child {
            width: 25px;
            padding-right: 5px;
            padding-left: 5px;
        }
        .table th:not(:last-child)> :last-child>* {
            min-width: 10%;
        }
        .table th.last-child {
            width: 10%;
        }
        .navbar-vertical.navbar-expand-xs{
            max-width: 12rem !important;
        }
        .sidenav.fixed-left+.main-content {
            margin-left: 12rem;
        }
        .form-switch .form-check-input:checked {
            border-color: #4caf50;
            background-color: #4caf50;
        }
        .image_uploader label{
            position: absolute;
            left: 50%;
            top: 50%;
            width: 100%;
            height: 100%;
            transform: translate(-50%,-50%);
            cursor: pointer;
        }
        .image_uploader input {
            display: none;
        }
        .image_uploader i {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
            color: #777;
            background: #ddd;
            padding: 5px;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            text-align: center;
            z-index: 1;
            line-height: 16px;
        }
        .image_uploader img {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
            width: 100%;
            height: 100%;
        }
        .image_uploader {
            float: left;
            width: 80px;
            height: 80px;
            overflow: hidden;
            position: relative;
    margin-bottom: -5px;
    margin-top: 5px;
        }
        .image_uploader.w50{
            float:none;
            display:inline-block;
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }
        table.table tr.selected td {
    border: 2px solid #03a9f4 !important;
}
td.bold {
    font-weight: bold;
}
.ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline {
    height: 200px;
}
.showmobile{
    display: none;
}
table.table tbody td p b {
    float: right;
    width: 100%;
}
a.filter_btn {
    /*display:none;*/
    position: absolute;
    right: 8px;
    top: 8px;
    width: 28px;
    height: 28px;
    color: #fff !important;
    border-radius: 50%;
    text-align: center;
    line-height: 28px;
    font-size: 12px;
        cursor: pointer;
        z-index: 9;
    background-image: linear-gradient(310deg, #141727 0%, #3A416F 100%);
}
.card.mb-4.mx-4.pb-2.filters_All>div >div div > a:last-child {
    margin-right: 25px;
}
    a.btn.bg-gradient-dark.btn-sm.mb-2 {
        padding: 8px 16px !important;
        height: 28px !important;
        line-height: 12px !important;
    }
    .filters_All.hide>div{
        display:none !important;
    }
@media(max-width:996px){
    a.btn.bg-gradient-dark.btn-sm.mb-2 {
        padding: 8px 16px !important;
        height: 28px !important;
        line-height: 24px !important;
    }
    a.filter_btn {
        display:inline-block !important;
        right: 8px;
        top: 8px;
    }
    .mx-4 {
        margin-right: 0.5rem!important;
        margin-left: 0.5rem!important;
    }
    .d-flex.flex-row.justify-content-between {
        display: inline-block !important;
    }
    .d-flex.flex-row.justify-content-between>div:last-child {
        margin-top: 10px;
    }
    ul.munths li a {
        width: 35px !important;
        min-width: 28px;
    }
}
@media(max-width:772px){
    a.btn.bg-gradient-dark.btn-sm.mb-2 {
        padding: 8px 16px !important;
        height: 33px !important;
        line-height: 18px !important;
    }
    table.table td:last-child .bt-content a{
        float:none;
        margin: 0px 20px !important;
    }
    .head_table thead,
    table.table.align-items-center.mt-4.mb-0.td-5.head_table.bt thead {
        display: inherit !important;
        width: 100%;
    }
    table.table td {
        border: 1.5px solid #333 !important;
    box-shadow: none !important;
    }
    .table tr td:first-child .bt-content p{
        color:#fff !important;
    }
    .table tr td:first-child   .bt-content{
        width: 100% !important;
        background: rgb(149 208 255) !important;
        background-image: linear-gradient(310deg, #141727 0%, #3A416F 100%) !important;
        /*padding: 2px 0;*/
        color:#fff !important;
    }
    .table tr td:first-child:before {
        display: none;
    }
    div#exp_pdf>table:first-child thead, div#exp_pdf>table:first-child thead tr, div#exp_pdf>table:first-child thead tr th {
        display: block !important;
        width: 100% !important;
    }
    .container-fluid.py-1.px-3 {
        padding: 0 !important;
    }
    .container-fluid.py-1.px-3>nav{
        display:none !important;
    }
    .show_accro{
    margin-bottom: 8px !important;
    text-align: left;
    }
    ul.munths {
        margin-right: 0px !important;
        width:100%;
    }
    ul.munths li {
        min-width: 14%;
        margin-bottom: 5px;
    }
    .card-body.px-4.pt-0.pb-0.mb-0.hide_accro.show {
        max-height: 400px;
        overflow-y: auto;
    }
    .d-flex.flex-row.justify-content-between > div > a {
        float: none;
        margin-left: 0px;
        margin-right: 0 !important;
        display: inline-block !important;
        padding: 7px 10px !important;
    }
    .d-flex.flex-row.justify-content-between > div{
        text-align: center;
    }
    .d-flex.flex-row.justify-content-between {
        display: inline-block !important;
    }
    .munths{
        margin-bottom:5px !important;
    }
    table.bt tfoot th, table.bt tfoot td, table.bt tbody td {
        position: relative;
    }
    .table tr td:first-child,.table tr td:first-child:before{
        font-weight: bold !important;
        background: #009688 !important;
    }
    table.bt tfoot th:first-child::after, table.bt tfoot td:first-child::after, table.bt tbody td:first-child::after{
        display: none;
    }
    table.bt tfoot th::after, table.bt tfoot td::after, table.bt tbody td::after,
    table.bt tfoot th::before, table.bt tfoot td::before, table.bt tbody td::before {
        /*background: transparent !important;*/
        background: rgb(149 208 255) !important;
        border-right: 2px solid #000;
    }
    .table.align-items-center td, .table.align-items-center th {
        width: initial;
        max-width: initial !important;
        /*background: transparent !important;*/
        padding: 0 !important;
    }
    table.bt tr td.commission:first-child span {
        background: #FFF !important;
        width: 70% !important;
        color: #000 !important;
        text-align: center;
        float: right !important;
        display: inline-block !important;
    }
    table.bt tr td.commission:first-child{
        display: block;
    }
    table.bt td.commission:before{
        content: attr(data-td) !important;
        display: inline-block;
        -webkit-flex-shrink: 0;
        -ms-flex-shrink: 0;
        flex-shrink: 0;
        font-weight: 700;
        width: 6.5em;
        left: 0;
        right: auto;
        position: absolute;
        z-index: 1;
        width: 30%;
        top: 50%;
        transform: translateY(-50%);
        background: rgb(149 208 255) !important;
        border-right: 2px solid #000;
    }
    table.bt tfoot th.commission::after, table.bt tfoot td.commission::after, table.bt tbody td.commission::after,
    table.bt tfoot th::after, table.bt tfoot td::after, table.bt tbody td::after,
    table.bt tfoot th::before, table.bt tfoot td::before, table.bt tbody td::before{
        width: 30%;
        color: #000;
        font-size: 12px;
        vertical-align: middle !important;
    }
    
    span.bt-content{
        width: 70%;
    }
    
    table td.commission::after{
        content: attr(data-td) !important;
        left: 0;
        right: auto;
        position: absolute;
        z-index: 1;
        width: 30%;
        top: 50%;
        transform: translateY(-50%);
    }
    table.bt tfoot th::after, table.bt tfoot td::after, table.bt tbody td::after {
        content: attr(data-th) !important;
        left: 0;
        right: auto;
        position: absolute;
        z-index: 1;
        width: 30%;
        top: 50%;
        transform: translateY(-50%);
    }
    .card .actable th,.card .actable td,
    .card .actable th:first-child,.card  .actable td:first-child,
    .card td.incs,.card  table.table.act th:last-child,.card  table.table.act td:last-child {
        width: 100% !important;
    }
    .col-6{
        width: 100%;
    }
    .mobile p.text-xst.font-weight-bold.mb-0 {
        display: inline-block;
    }
    table.table tbody td p,
    table.table thead th p{
        display: none;
    }
    table.table tbody td p.showmobile ,
    table.table thead th p.showmobile ,.showmobile{
        display: inline-block;
    }
    table.table tbody td.user a, table.table tbody td.user p{
        padding: 1px 5px !important;
        height: 20px;
    }
    table.table tbody td:first-child p{
        display: inline-block;
    }
    
    table.bt tfoot th::before, table.bt tfoot td::before, table.bt tbody td::before {
        content: "" !important;
    }
    #exp_pdf{
        overflow-x: hidden;
    }
    .table tr.bg2 td:first-child .bt-content {
        color: #fff !important;
        background-image: linear-gradient(310deg, #141727 0%, #3A416F 100%) !important;
    }
    .hide-mobile{
        display: none;
    }
    .nopadhid.table tr td:first-child .bt-content{
        padding:0;
    }
    table.table.nopadhid tbody td p, table.table.nopadhid thead th p{
        display: inline-block;
    }
    .table.nopadhids tr td:first-child .bt-content{
        padding:0;
        font-size: 12px;
    }
    
    table.bt tbody td.commission::after {
        content: attr(data-td) !important;
        left: 0;
        right: auto;
        position: absolute;
        z-index: 1;
        width: 30%;
        top: 50%;
        transform: translateY(-50%);
    }
    h5.mb-1 span {
        float: right;
        width: 100%;
    }
    h5.mb-1 .checkbox.sus {
        display: inline-block;
        float: none !important;
    }
    h5.mb-1 label span {
        display: none;
    }
    .cusmobhide {
        display: none !important;
    }
    .itemsmobilew {
        display: inline-block !important;
        float: right;
        padding: 1px 5px;
        width: 70%;
    }
    .itemsmobilew>a{
        margin-right:15px !important;
        color:#fff;
    }
    .itemsmobilew>a i{
        color:#fff !important;
    }
    .table tr td:first-child .bt-content>p{
        float:left;
        padding:7px;
        width: 30%;
        border-right: 1px solid #ddd;
    }
}
.itemsmobilew {
    display: none;
}
a.gotop,
a.godown  {
    position: fixed;
    bottom: 15px;
    right: 15px;
    background: #ddd;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    text-align: center;
    line-height: 35px;
    font-size: 16px;
    cursor: pointer;
}
.btn-dark, .btn.bg-gradient-dark{
    color:#fff !important;
}
/*a.gotop.active,*/
/*a.godown.active{*/
/*    display:inline-block;*/
/*} */
.showTable{
    display:table;
}
#previewImg{
    display:none;
}
            @media print {
                /*html,body{*/
                /*    float:right;*/
                /*    width:297mm;*/
                /*    height:200mm;*/
                /*}*/
                .container, .container-sm, .container-md, .container-lg, .container-xl{
                    width:100%;
                    max-width:100%;
                }
                @page {
                    size: A4 landscape;
                    margin: 0 0;
                }
                table.table thead tr th{
                    height: 50px;
                    position: relative;
                    z-index: 3;
                    background: rgb(166 213 250);
                    border:2px solid #000 !important;
                }
                /*table {border-collapse: collapse;}*/
                /*thead {display: table-header-group;}*/
                /*tfoot {display: table-footer-group;}*/
                /*tbody {display: table-row-group;}*/
                .container{
                    padding:0;
                    float:right;
                    width:100%;
                }
                /*.forprint thead th:last-child,*/
                /*.forprint tbody td:last-child,*/
                .navbar-main,.card-header,.itemsmobilew,
                .filters_All{
                    display:none;
                }
                #exp_pdf .card-header{
                    display:inline-block;
                }
            }
      </style>

  </head>

  <body class="g-sidenav-show bg-gray-100">

      @include('panel.layouts.navbars.auth.sidebar')
      @include('panel.layouts.navbars.auth.nav')

      @if(Session::has('message'))
      <div class="container-fluid py-4">
        <div class="alert alert-danger">
          <b class="text-white">{{ Session::get('message') }}</b>
        </div>
      </div>
      @endif
        @if(session()->has('success'))
        <div class="container-fluid py-4">
            <div class="alert alert-success">
              <b class="text-white">{{ session('success') }}</b>
            </div>
          </div>
        @endif
        @if(session()->has('info'))
        <div class="container-fluid py-4">
            <div class="alert alert-success">
              <b class="text-white">{{ session('info') }}</b>
            </div>
          </div>
        @endif
        @if(session()->has('danger'))
        <div class="container-fluid py-4">
          <div class="alert alert-danger">
            <b class="text-white">{{ session('danger') }}</b>
          </div>
        </div>
        @endif


      @yield('content')
      <main>
          <div class="container-fluid">
              <div class="row">
                  @include('panel.layouts.footers.auth.footer')
              </div>
          </div>
      </main>
        <a class="gotop"><i class="fa fa-arrow-up"></i></a>
        <a class="godown"><i class="fa fa-arrow-down"></i></a>
      <!--   Core JS Files   -->
      <script src="{{admin_url('assets/js/core/popper.min.js')}}"></script>
      <script src="{{admin_url('assets/js/core/bootstrap.min.js')}}"></script>
      <script src="{{admin_url('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>

        <!--   Core JS Files   -->
        <script src="{{admin_url('assets/js/html2canvas.min.js')}}"></script>

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
      <script src="{{url('/public/tableHTMLExport.js')}}"></script>
      <script src="{{admin_url('assets/js/bootstrap-datepicker.min.js')}}"></script>
      <script src="{{admin_url('assets/basictable/js/basictable.js')}}"></script>
      <script src="{{admin_url('assets/basictable/js/jquery.basictable.js')}}"></script>
      
      <script>
      
            $(document).ready(function() {
                $(window).on('scroll', function() {
                    var scrollTop = $(this).scrollTop();
                    if(scrollTop <= 300){
                        $(".gotop").hide();
                        $(".godown").show();
                    }else{
                        $(".gotop").show();
                        $(".godown").hide();
                    }
                });

                var windowWidth = window.screen.width < window.outerWidth ?
                      window.screen.width : window.outerWidth;
                var mobile = windowWidth < 776;
                //console.log("Mo:" + mobile);
                if(mobile == true ) {
                    @if(!isset($ispartner))
                    $(".table_profit").hide();
                    @endif
                     $("body").addClass("mobile");
                     $("table").find("tbody").find(".cusmob").find("p:not(.showmobile)").remove();
                     $("table").find("thead").find("p:not(.showmobile)").remove();
                     
                        $('table').basictable();
                    }
            });
        // $(document).ready(function() {
        // });
        
      </script>
      
        <script>
            var eti = document.querySelector( '#editor' ) !== null;
            if(eti){
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );
            }
            var eti1 = document.querySelector( '#editor1' ) !== null;
            if(eti1){
            ClassicEditor
                .create( document.querySelector( '#editor1' ) )
                .catch( error => {
                    console.error( error );
                } );
            }
            var eti2 = document.querySelector( '#editor2' ) !== null;
            if(eti2){
            ClassicEditor
                .create( document.querySelector( '#editor2' ) )
                .catch( error => {
                    console.error( error );
                } );
            }
        </script>
        
        
        <!--   Core JS Files   -->
        <script src="{{admin_url('assets/js/html2canvas.min.js')}}"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    ></script>
    
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>-->
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.min.js"></script>-->
          
        <script>
        function showtable(){
            //$(this).find("table").AddClass("showTable");
        }
        $(document).ready(function() {
            showtable();
            
        $(window).on('scroll', function() {
        var scrollTop = $(this).scrollTop();
        if(scrollTop <= 300){
        $(".gotop").hide();
        $(".godown").show();
        }else{
        $(".gotop").show();
        $(".godown").hide();
        }
        });
        
        var windowWidth = window.screen.width < window.outerWidth ?
        window.screen.width : window.outerWidth;
        var mobile = windowWidth < 776;
        //console.log("Mo:" + mobile);
        if(mobile == true ) {
        @if(!isset($ispartner))
        $(".table_profit").hide();
        @endif
        $("body").addClass("mobile");
        $("table").find("tbody").find(".cusmob").find("p:not(.showmobile)").remove();
        $("table").find("thead").find("p:not(.showmobile)").remove();
        
        $('table').basictable();
        }
        });
        // $(document).ready(function() {
        // });
        
        </script>
        
        <script>
        var eti = document.querySelector( '#editor' ) !== null;
        if(eti){
        ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
        console.error( error );
        } );
        }
        var eti1 = document.querySelector( '#editor1' ) !== null;
        if(eti1){
        ClassicEditor
        .create( document.querySelector( '#editor1' ) )
        .catch( error => {
        console.error( error );
        } );
        }
        var eti2 = document.querySelector( '#editor2' ) !== null;
        if(eti2){
        ClassicEditor
        .create( document.querySelector( '#editor2' ) )
        .catch( error => {
        console.error( error );
        } );
        }
        </script>
        <script>
        
        $(document).ready(function() {
        function formatDate(date) {
        var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
        
        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;
        
        return [year, month, day].join('-');
        }
        $('.select').select2();
        $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        beforeShowDay: function( date ) {
        var _Class = "";
        if(date.getDay() === 0 || date.getDay() === 6){
        _Class = "bold ";
        }
        if(formatDate(date) == formatDate(new Date())){
        _Class += 'thisdate';
        }else if(formatDate(date) < formatDate(new Date())){
        _Class += 'olds';
        }else if(formatDate(date) > formatDate(new Date())){
        _Class += 'new';
        }
        return _Class;
        }
        });
        });
        $(document).ready(function () {
        $("#paids").change(function(e){
        if ($(this).is(':checked')) {
        swal.fire({
        title: '<span class="info">PAYMENT CONFIRM!</span>',
        type: 'delete',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'YES',
        cancelButtonText: 'NO',
        confirmButtonColor: '#56ace0',
        })
        .then(function (value) {
        if (value.isConfirmed) {
        $("#form_paids").submit();
        }else{
        location.reload();
        }
        });
        }
        });
        var ok_btn = 'Ok';
        var err_txt = 'An unexpected error occurred.. Please try again later';
        if (window.lang === 'en'){
        ok_btn = 'Ok';
        err_txt = 'Unknown Error .. Try Again';
        }
        function customSweetAlert(type ,title , html , func) {
        var then_function = func || function () {
        };
        swal.fire({
        title: '<span class="'+type+'">'+title+'</span>',
        type: type ,
        html : html ,
        confirmButtonText: 'Ok',
        confirmButtonColor: '#56ace0',
        confirmButtonClass: "btn btn-secondary m-btn m-btn--wide"
        
        }).then(then_function);
        }
        
        function errorCustomSweet() {
        customSweetAlert(
        'error',
        err_txt
        );
        }
        $(document).on('change','.is-displayed',function (e) {
        // showLoader();
        var url = $(this).data('url');
        $.ajax({
        url: url,
        type: 'GET',
        success: function (response) {
        location.reload();
        // table.ajax.reload();
        // if (!response.status){
        // }
        // hideLoader();
        },
        error : function () {
        errorCustomSweet();
        }
        });
        });
        $(document).on('click', '.delete', function (event) {
        var delete_url = $(this).data('url');
        event.preventDefault();
        swal.fire({
        title: '<span class="info">Are you sure to delete the selected item?</span>',
        type: 'delete',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        confirmButtonColor: '#56ace0',
        }).then(function (value) {
        //console.log(value);
        if (value.isConfirmed) {
        //console.log("true");
        $.ajax({
        url: delete_url,
        method: 'delete',
        type: 'json',
        data: {
             _token: '{{ csrf_token() }}'
        },
        success: function (response) {
          if (response.status) {
              customSweetAlert(
                  'success',
                  response.message,
                  response.item,
                  function (event) {
                      //table.ajax.reload()
                      location.reload();
                  }
              );
          } else {
              customSweetAlert(
                  'error',
                  response.message,
                  response.errors_object
              );
          }
        },
        error: function (response) {
          errorCustomSweet();
        }
        });
        }
        });
        });
        });
        </script>
        <script>
        // var doc = new jsPDF();
        var specialElementHandlers = {
        '#editor': function (element, renderer) {
        return true;
        }
        };
        var form = $('#exp_pdf'),  
        cache_width = form.width(),  
        a4 = [595.28, 841.89];
        
        function createPDF() {  
        getCanvas().then(function (canvas) {  
        var  
        img = canvas.toDataURL("image/png"),  
        doc = new jsPDF({  
        unit: 'px',  
        format: 'a4'  
        });  
        doc.addImage(img, 'JPEG', 20, 20);  
        doc.save('test.pdf');  
        form.width(cache_width);  
        });  
        }
        
        function getCanvas() {  
        form.width((a4[0] * 1.33333) - 80).css('max-width', 'none');  
        return html2canvas(form, {  
        imageTimeout: 2000,  
        removeContainer: true  
        });  
        }
        
        function CreatePDFfromHTML() {
        
        var HTML_Width = $("#exp_pdf").width();
        var HTML_Height = $("#exp_pdf").height();
        var top_left_margin = 15;
        var PDF_Width = HTML_Width + (top_left_margin * 2);
        var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
        var canvas_image_width = HTML_Width;
        var canvas_image_height = HTML_Height;
        
        var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;
        
        html2canvas($("#exp_pdf")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
        pdf.addPage(PDF_Width, PDF_Height);
        pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save("Export.pdf");
        });
        }
        if(document.getElementById('exampleModalLabel') != null) {
        document.getElementById("exampleModalLabel").addEventListener("click", function() {
        //window.print();
        html2canvas(document.getElementById("exp_pdf2")).then(function (canvas) {
        var anchorTag = document.createElement("a");
        document.body.appendChild(anchorTag);
        document.getElementById("previewImg").appendChild(canvas);
        anchorTag.download = "ENTRIESToday.jpg";
        anchorTag.href = canvas.toDataURL();
        anchorTag.target = '_blank';
        anchorTag.click();
        });
        });
        }
        $(document).ready(function() {
        $(".gotop").click(function() {
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
        });
        $(".has_old span").click(function() {
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
        });
        $(".godown").click(function() {
        var winh = $( document ).height();
        $("html, body").animate({ scrollTop: winh }, "slow");
        return false;
        });
        
        $(".filter_btn").click(function(){
        $(".filters_All").toggleClass("hide");
        console.log($(".filters_All").hasClass("hide"));
        if($(".filters_All").hasClass("hide")){
        $(this).find("i").attr("class","fa fa-minus");
        }else{
        $(this).find("i").attr("class","fa fa-times");
        }
        });
        $('.cls tr').click(function(){
        $(".cls").find("tr").removeClass("selected");
        $(this).addClass("selected");
        });
        $('.show_accro').click(function(){
        $(".show_accro").toggleClass("show");
        $(".hide_accro").toggleClass("show");
        });
        $('.export_pdf').click(function(){
        //createPDF();
        window.print();
        //CreatePDFfromHTML();
        });
        $('button.close').click(function(){
        $(this).parent().parent().parent().parent().attr("class","modal fade");
        });
        $('.caldn').click(function(){
        var id = $(this).data("target");
        $(id).addClass("show");
        });
        $cons = 0;
        $( "form .savebtnsw" ).on( "click", function( event ) {
        $(this).prop('disabled', true);
        $("form")[0].submit();
        //console.log($cons);
        //event.preventDefault();
        // if($cons == 0){
        //     $cons++;
        //     return true;
        //     //$(this).submit();
        // }else{
        //     return  false;
        // }
        });
        });
        </script>
    <div id="previewImg">
    </div>
    @yield('panel_js')
    <div id="editor"></div>
  </body>
</html>
