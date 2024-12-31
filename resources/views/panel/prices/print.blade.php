<html>
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
          AHLAN ANTALYA
      </title>
      
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
      <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
      
      <link id="pagestyle" href="{{admin_url('assets/css/soft-ui-dashboard.css')}}" rel="stylesheet" />
        <style>
            *{
                text-transform: uppercase !important;
            }
            section.main_sec {
                float: right;
                width: 100%;
                min-height: 100vh;
            }
            .main_dev {
                float: right;
                width: 100%;
                padding: 20px;
                background:#fff;
                padding:20px;
                padding-bottom:40px;
                min-height: 100vh;
                position: relative;
            }
            .header {
                float: right;
                width: 100%;
                margin-bottom: 20px;
                text-align: center;
            }
            .header h2 {
                float: right;
                width: 100%;
                color: #000;
                font-size: 20px;
                font-weight: bold;
                margin-bottom:0;
                cursor: pointer;
            }
            .header p {
                float: right;
                width: 100%;
                color: #000;
                font-size: 14px;
                margin-bottom:0;
            }
            .table table {
                float: right;
                width: 100%;
                margin: 0;
                margin-bottom:30px;
            }
            
            .table {
                float: right;
                width: 100%;
            }
            .table.hotel table td, .table table th {
                border: 2px solid #000 !important;
                text-align: center;
            }
            .table.hotel tr:first-child th{
                background: #000;
                color: #e4c064;
                font-size: 18px;
                font-weight: bold;
                padding:10px !important;
            }
            .table.hotel th{
                background: #e4c064;
                color: #000;
                font-size: 16px;
                font-weight: bold;
                padding:8px !important;
            }
            .table.hotel td{
                color: #000;
                font-size: 14px;
                font-weight: bold;
                padding:5px !important;
            }
            .table.hotel table th span {
                float: right;
                width: 100%;
                margin-top: 5px;
                font-size: 14px;
            }
            
            .table.drive table td, .table table th {
                border: 2px solid #000 !important;
                text-align: center;
            }
            .table.drive tr:first-child th{
                background: #000;
                color: #e4c064;
                font-size: 18px;
                font-weight: bold;
                padding:12px !important;
            }
            .table.drive th{
                background: #e4c064;
                color: #000;
                font-size: 16px;
                font-weight: bold;
                padding:8px !important;
            }
            .table.drive td{
                color: #000;
                font-size: 14px;
                font-weight: bold;
                padding:5px !important;
            }
            .table.drive table th span {
                float: right;
                width: 100%;
                color:#fff;
                margin-top: 5px;
                font-size: 14px;
            }
            /*e4c064*/
            /*003759*/
            
            .table.air table tr:first-child td{
                background:#003759;
                color:#e4c064 !important;
            }
            .table.air table tr{
                padding:10px 0;
                border-bottom:0;
            }
            
            .table.air table tr:first-child td p{
                background: transparent;
                padding: 0px;
                color:#e4c064 !important;
                padding:5px 0;
            }
            .table.air table td p{
                float:right;
                width:100%;
                padding:5px 0;
                background:#ddd;
                margin:5px 0;
                font-weight: bold;
            }
            .table.air table td{
                border: 0px solid #000 !important;
                text-align: center;
                color: #000;
                font-size: 14px;
                font-weight: bold;
                padding:0px !important;
                border-bottom:0;
                
            }
            .table.air table td:first-child{
                width:40%;
            }
            .table.air table td{
                width:20%;
            }
            .table.air table tr:first-child td span{
                color:#fff;
            }
            .table.air table tr td:first-child p{
                padding-left:25px;
            }
            .table.air table tr td:first-child{
                text-align:left;
            }
            .table.air table td span{
                color:#003759;
            }
            .table.air table{
                margin:0;
            }
            table td p{
                font-weight: bold
            }
            p{
                margin:0;
                color: #000;
                font-size: 14px;
                /*font-weight: bold;*/
            }
            .table ul li span {
                font-weight: bold;
                color: #E91E63;
            }
            .table ul li {
                float: right;
                width: 100%;
                /*background: #000;*/
                padding: 5px;
                /*margin-bottom: 10px;*/
                color: #000;
                font-size: 14px;
                padding-left: 0;
            }
            .table ul {
                float: right;
                width: 100%;
                padding: 0;
                /*list-style: none;*/
            }
            .table {
                float: right;
                width: 100%;
            }
            a.export_pdf {
                position: fixed;
                left: 10px;
                top: 10px;
                font-size: 12px;
                background: #003759;
                padding: 8px 12px;
                border-radius: 5px;
                color: #fff;
                cursor: pointer;
            }
            .adrs {
                position: absolute;
                left:20px;
                right:20px;
                bottom: 0;
                border-top: 2px solid #ddd;
                padding-top: 4px;
                color:#333;
                text-align: center;
                padding-bottom:4px;
            }
            .adrs span {
                /*float: left;*/
                display: inline-block;
                font-size: 10px;
                /*margin-right:6%;*/
                /*font-weight: bold;*/
            }
            .adrs span:last-child{
                margin-right:0;
                /*width:40%;*/
            }
            .adrs span i {
                display: inline-block;
            }
            #previewImg{
                display:none;
            }
            
            .himg img {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%,-50%);
                min-width: 100%;
                max-width: 150%;
                min-height: 100%;
                max-height: 150%;
            }
            .himg {
                display:block;
                margin: 0 auto;
                text-align: center;
                position: relative;
                overflow: hidden;
                width: 100px;
                height: 100px;
            }
            .note b {
                float: right;
                width: 100%;
                margin-bottom: 10px;
                color:#E91E63;
                padding: 0;
                padding-bottom: 0px;
                text-decoration-line: underline;
            }
            .note {
                width: 100%;
                text-align: center;
                border: 2px dashed #777;
                min-height: 80px;
                padding: 10px;
                color:#333;
                float: right;
            }
            .note>div *{
                color:#333;
            }
            .note>div ul{
                /*list-style: none;*/
                margin: 0;
                padding: 0;
                padding-left: 15px;
                text-align: left;
                color:#333;
            }
            .note>div {
                float: right;
                width: 100%;
            }
            *{
                box-sizing: border-box;
            }
            .ts {
                float: right;
                width: 100%;
            }
            .ts>thead>tr>th{
                height: 160px;
            }
            .ts>tfoot>tr>td>div{
                height: 60px;
                margin:0 !important;
            }
            @media print {
                .header{
                    top:0;
                    position: fixed;
                    left: 0;
                    right: 0;
                }
                .adrs {
                    position: fixed;
                }
                .container, .container-sm, .container-md, .container-lg, .container-xl{
                    width:100%;
                    max-width:100%;
                }
                @page {
                    size: A4;
                    margin:0 0;
                }
                .main_dev,
                .container{
                    padding-bottom:0;
                    float:right;
                    width:100%;
                }
                .table{
                    margin-bottom:0;
                }
            }
        </style>
    </head>
    <body>
        <section class="main_sec">
            <div class="container">
                <div id="exp_pdf" class="main_dev">
                    <table class="ts">
                        <thead>
                            <tr>
                                <th>
                                    <div class="header">
                                        <div class="himg">
                                            <img src="{{url('public/logop.png')}}" alt="AHLAN ANTALYA">
                                        </div>
                                        <!--<a id="btn_convert1" class="export_pdf"><i class="fa fa-pdf"></i>Download</a>-->
                                        <h2 id="btn_convert1" class="export_pdf">{{$data->title_page}}</h2>
                                        <p>{{$data->desc_page}}</p>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="table {{$data->id == 1 ?"hotel":($data->id == 2 ? "drive":("air"))}}">
                                        @foreach($data->PTables as $table)
                                            <table>
                                                <thead>
                                                    @if($data->id != 3)
                                                        <tr>
                                                            <th colspan="5">
                                                                {{$table->title_table}}
                                                                <span>{{$table->desc_table}}</span>
                                                            </th>
                                                        </tr>
                                                        @if($data->id == 1)
                                                        <tr>
                                                            <th style="width:25%">HOTEL NAME</th>
                                                            <th style="width:25%">STAR</th>
                                                            <th style="width:25%">BOARD</th>
                                                            <th style="width:25%">distance to airport </th>
                                                        </tr>
                                                        @endif
                                                        
                                                        @if($data->id == 2)
                                                        <tr>
                                                            <th style="width:33.3%">destination</th>
                                                            <th style="width:33.3%">1-7 PAX</th>
                                                            <th style="width:33.3%">8-14 PAX</th>
                                                        </tr>
                                                        @endif
                                                    @endif
                                                </thead>
                                                <tbody>
                                                    @foreach($table->PData as $key=>$row)
                                                    <tr>
                                                        @if($row->title != "")
                                                        <td>
                                                            <p>
                                                            {{$data->id == 3 ? 'FROM ANTALYA AIRPORT' : "" }}
                                                            @if( $data->id == 3)
                                                                <span>
                                                            @endif
                                                            @if($data->id == 3)
                                                                <i class="fa fa-exchange"></i>
                                                            @endif
                                                            {{ $row->title}}
                                                            @if( $data->id == 3)
                                                                </span>
                                                            @endif
                                                            </p>
                                                        </td>
                                                        @endif
                                                        @if($data->id == 1)
                                                            <td>{{ $row->star}}</td>
                                                            <td>{{ $row->desc_data}}</td>
                                                            <td>{{ $row->s24}}</td>
                                                        @else
                                                            @if($row->s5 != "")
                                                            <td>
                                                                <p>
                                                                @if($key == 0 && $data->id == 3)
                                                                
                                                                @else
                                                                    $
                                                                @endif
                                                                {{ $row->s5}}
                                                                </p>
                                                            </td>
                                                            @endif
                                                            @if($row->s6 != "")
                                                            <td><p>
                                                                @if($key == 0 && $data->id == 3)
                                                                
                                                                @else
                                                                    $
                                                                @endif {{ $row->s6}}</p></td>
                                                            @endif
                                                            @if($row->s12 != "")
                                                            <td><p>
                                                                @if($key == 0 && $data->id == 3)
                                                                
                                                                @else
                                                                    $
                                                                @endif {{ $row->s12}}</p></td>
                                                            @endif
                                                            @if($row->s24 != "")
                                                                <td>
                                                                    <p>
                                                                    @if($key == 0 && $data->id == 3)
                                                                    @else
                                                                        $
                                                                    @endif 
                                                                    {{ $row->s24}}
                                                                    </p>
                                                                </td>
                                                            @endif
                                                            @if($row->s50 != "")
                                                            <td><p>
                                                                @if($key == 0  && $data->id == 3)
                                                                
                                                                @else
                                                                    $
                                                                @endif {{ $row->s50}}</p></td>
                                                            @endif
                                                        @endif
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endforeach
                                        @if(isset($data->PNotes) && sizeof($data->PNotes) != 0)
                                        <table>
                                            <div class="note">
                                                <b>Information</b> 
                                                <div>
                                                    <ul>
                                                        @foreach($data->PNotes as $row)
                                                            <li><span>{{$row->title}}: </span> {{ $row->desc_note }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div></table>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    <div class="table {{$data->id == 1 ?"hotel":($data->id == 2 ? "drive":("air"))}}">
                                        <div class="adrs">
                                            <span><i class="fa fa-phone"></i> {{$setting->phone}}</span>
                                            <span><i class="fa fa-envelope"></i> {{$setting->email}}</span>
                                            <span><i class="fa fa-link"></i> {{$setting->url}}</span>
                                            <span><i class="fa fa-map-marker"></i> {{$setting->address}}</span>
                                            <span><i class="fa fa-certificate"></i> TÜRSAB No: 12457</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </section>
        <div id="previewImg">
        </div>
        
      <!--   Core JS Files   -->
      <script src="{{admin_url('assets/js/core/popper.min.js')}}"></script>
      <script src="{{admin_url('assets/js/core/bootstrap.min.js')}}"></script>
      <script src="{{admin_url('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>


      <script src="{{admin_url('assets/js/jquery.min.js')}}"></script>
        <!--   Core JS Files   -->
        <script src="{{admin_url('assets/js/html2canvas.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

      <script>
          var win = navigator.platform.indexOf('Win') > -1;
          if (win && document.querySelector('#sidenav-scrollbar')) {
              var options = {
                  damping: '0.5'
              }
              Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
          }
          
            $(document).ready(function() {
                $('.export_pdf').click(function(){
                    // CreatePDFfromHTML();
                });
            });
            
            document.getElementById("btn_convert1").addEventListener("click", function() {
                window.print();

            // 	html2canvas(document.getElementById("exp_pdf")).then(function (canvas) {
            // 	    var anchorTag = document.createElement("a");
            // 			document.body.appendChild(anchorTag);
            // 			document.getElementById("previewImg").appendChild(canvas);
            // 			anchorTag.download = "{{@$data->title}}.jpg";
            // 			anchorTag.href = canvas.toDataURL();
            // 			anchorTag.target = '_blank';
            // 			anchorTag.click();
            // 		}, {
            // 		    scale:2,
            //             dpi: 265
            //         });
             });
            function CreatePDFfromHTML() {
                var HTML_Width = $("#exp_pdf").width();
                var HTML_Height = $("#exp_pdf").height();
                var top_left_margin = 0;
                var PDF_Width = HTML_Width + (top_left_margin * 2);
                var PDF_Height = (PDF_Width * 2) + (top_left_margin * 2);
                var canvas_image_width = HTML_Width;
                var canvas_image_height = HTML_Height;

                var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

                html2canvas($("#exp_pdf")[0]).then(function (canvas) {
                    var imgData = canvas.toDataURL("image/jpeg", 1);
                    var pdf = new jsPDF('p', 'pt', [HTML_Height, PDF_Height]);
                    pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
                    for (var i = 1; i <= totalPDFPages; i++) {
                        pdf.addPage(PDF_Width, PDF_Height);
                        pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
                    }
                    pdf.save("Export.pdf");
                    //$("#exp_pdf").hide();
                });
            }
      </script>
      
      <!-- Latest compiled and minified JavaScript -->
      <script src="{{admin_url('assets/js/jquery.min.js')}}"></script>
      <script src="{{admin_url('assets/js/bootstrap-datepicker.min.js')}}"></script>
      <script src="{{admin_url('assets/basictable/js/basictable.js')}}"></script>
      <script src="{{admin_url('assets/basictable/js/jquery.basictable.js')}}"></script>
      
    </body>
</html>