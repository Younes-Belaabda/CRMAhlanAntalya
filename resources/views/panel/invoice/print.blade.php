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
                background:#fff;
                padding:0;
                padding-bottom:40px;
                min-height: 100vh;
                position: relative;
            }
            p{
                margin:0;
                color: #000;
                font-size: 14px;
                /*font-weight: bold;*/
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
            .header h2 span {
                float: right;
                font-size: 14px;
                font-weight: normal;
            }
            .header h2 {
                float: right;
                width: 100%;
                font-size: 18px;
                font-weight: bold;
                margin: 0;
                margin-top: 20px;
                color: #fff;
            }
            .header p {
                float: right;
                width: 100%;
                color: #fff;
            }
            .header {
                float: right;
                width: 30%;
                text-align: center;
            }
            .data h2 {
                float: left;
                border-bottom: 2px solid #bfbfbf;
                font-size: 20px;
                font-weight: bold;
            }
            .data {
                float: right;
                width: 100%;
                margin: 20px 0 50px;
            }
            .divs {
                float: right;
                width: 100%;
                border-bottom: 2px solid #ddd;
            }
            .divs.last-child{
                border-bottom:0;
            }
            .divs>div {
                float: left;
                padding:15px 10px;
                padding-right: 20px;
                width: 25%;
                position: relative;
            }
            .divs>div:last-child{
                padding-right: 0px;
            }
            .divs>div:last-child:before{
                display:none;
            } 
            .divs>div:before {
                content: "";
                right: 0px;
                top: 15px;
                height:50px;
                width: 2px;
                background: #ddd;
                position: absolute;
            }
            .divs>div label {
                float: left;
                width: 100%;
                font-size: 16px;
                font-weight: bold;
                color: #000;
                margin: 0;
                margin-bottom:2px;
            }
            .divs>div span {
                float: left;
                width: 100%;
                font-size: 14px;
                color: #333;
            }
            .rooms td {
                font-size: 14px;
                color: #333;
                padding: .75rem 1.5rem;
            }
            .rooms tfoot td {
                font-size: 14px;
                color: #e70c34;
                padding: .75rem 1.5rem;
    font-weight: bold;
            }
            .rooms th:first-child{
                width:50%;
            }
            .rooms th {
                font-size: 14px;
                font-weight: bold;
                color: #000;
                padding: 8px 15px;
                width:12.5%;
                border-top: 3px solid #e70c34;
                border-bottom: 0!important;
            }
            .rooms table {
                float: right;
                width: 100%;
            }
            .rooms {
                float: right;
                width: 100%;
                margin: 20px 0;
            }
            .data p {
                float: left;
                font-size: 14px;
                color: #333;
                /*font-weight: bold;*/
            }
            .data p span{
                font-weight: normal;
            }
            .header1 {
    float: left;
    width: 50%;
}
            .header1 h2 {
    float: right;
    width: Calc(100% - 100px);
    color: #fff;
    font-size: 40px;
    font-weight: bold;
    margin-bottom: 0;
    cursor: pointer;
    text-align: left;
    margin-top: 28px;
            }
            .header1 p {
                float: right;
    width: Calc(100% - 80px);
    color: #000;
    font-size: 14px;
    margin-bottom: 0;
    text-align: left;
            }
            .header h2 small {
                font-size: 22px;
                font-weight: normal;
            }
            .himg img {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%,-50%);
                min-width: 100%;
                max-width: 150%;
                min-height: 100%;
    filter: brightness(100);
                max-height: 150%;
            }
            .himg {
                float: left;
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
                margin-bottom:15px;
            }
            .note>div p{
                float: right;
                width: 100%;
                text-align: left;
                
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
                height: 140px;
            }
            .headers {
    float: right;
    width: 100%;
    background: #e70c34;
    padding: 20px 20px;
}
.invs {
    float: right;
    width: 100%;
    padding: 30px 0 0;
}
.inv p span {
    float: right;
    width: 35%;
}

.inv p {
    float: right;
    width: 100%;
    font-size: 14px;
}
.inv {
    float: left;
    width: 30%;
    background: #eee;
    padding: 20px;
}
.inv2>div>p,
.inv2 h2 {
    float: right;
    width: 100%;
    font-size: 12px;
    font-weight: normal;
    color:#000;
    margin: 0;
}
.inv2 h2 {
    color:#000;
}

.inv2 h3 {
    float: right;
    width: 100%;
    font-size: 18px;
    font-weight: bold;
}
.inv2 {
    float: right;
    width: 30%;
}

            @media print {
            .ts>tfoot>tr>td>div{
                height: 60px;
                margin:0 !important;
            }
                .inv{
                    width:40%;
                }
                .headers{
                    top:0;
                    position: fixed;
                    left: 0;
                    right: 0;
                }
                /*.adrs {*/
                /*    position: fixed;*/
                /*    bottom: 0;*/
                /*    width: 100%;*/
                /*}*/
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
                    padding:0;
                    float:right;
                    width:100%;
                }
                .note {
                    margin: 10px 20px;
                    width: calc(100% - 40px);
                    
                }
            }
        </style>
        <style>
            /* Printed Page Size */
            @page {
                size: 13.5in 9.5in;
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
                                    <div class="headers" id="btn_convert1" class="export_pdf">
                                        <div class="header1">
                                            <div class="himg">
                                                <img src="{{url('public/logop.png')}}" alt="AHLAN ANTALYA">
                                            </div>
                                            <h2>Invoice</h2>
                                        </div>
                                        <div class="header">
                                            <h2>AHLAN ANTALYA</h2>
                                            <p>TRAVEL & TOURISM IN TURKEY</p>
                                            <p><i class="fa fa-certificate"></i> TÜRSAB No: 12457</p>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="invs">
                                        <div class="inv">
                                            <p><b>Invoice Date</b> <span>{{$data->date}}</span></p>
                                            <p><b>Invoice Number</b> <span>{{$data->Num}}</span></p>
                                        </div>
                                        <div class="inv2">
                                            <h3>Recipient</h3>
                                            <h2><b>{{$data->gneder .". "}}</b> {{$data->name}}</h2>
                                            <div><?php echo $data->note; ?></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="table">
                                        <div class="data">
                                            <div class="rooms">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th>{{ $data->hotel }} Discriptoin</th>
                                                            <th>Date</th>
                                                            <th>Pax</th>
                                                            <th>{{ $data->address }}</th>
                                                            <th>Price</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($data->VRoom as $room)
                                                            <tr>
                                                                <td>{{$room->rooms}}</td>
                                                                <td>{{ $room->view != null ? date("d M",strtotime($room->view)) : "" }}</td>
                                                                <td>{{$room->pax}}</td>
                                                                <td>{{$room->board}}</td>
                                                                <td>{{$room->no_room}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="3">
                                                                
                                                            </td>
                                                            <td>
                                                                Total
                                                            </td>
                                                            <td>
                                                                {{ $data->p_amount }}
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            @if($data->cin != null)
                                            <div class="note">
                                                <b>Note</b> 
                                                <div>
                                                <?php echo $data->cin; ?></div>
                                            </div>
                                            @endif
                                            @if($data->b_amount != 0)
                                            <div class="note">
                                                <b>Bank Details</b> 
                                                <div>
                                                    @if($data->b_amount == 1)
                                                    <?php echo $setting->note1; ?>
                                                    @elseif($data->b_amount == 2)
                                                    <?php echo $setting->note2; ?>
                                                    @elseif($data->b_amount == 3)
                                                    <?php echo $setting->note3; ?>
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    <div class="adrs">
                                        <span><i class="fa fa-phone"></i> {{$setting->phone}}</span>
                                        <span><i class="fa fa-envelope"></i> {{$setting->email}}</span>
                                        <span><i class="fa fa-link"></i> {{$setting->url}}</span>
                                        <span><i class="fa fa-map-marker"></i> {{$setting->address}}</span>
                                        <span><i class="fa fa-certificate"></i> TÜRSAB No: 12457</span>
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
            // 		});
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