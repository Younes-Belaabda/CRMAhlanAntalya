<html>
    <head>
        <meta charset="UTF-8">
        <title>Ahlan Antalya Payment</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <style>
            *{
                margin:0;
                list-style:none;
                padding:0;
            }
            .cont {
    float: right;
    width: 100%;
}
.conts {
    display: block;
    width: 520px;
    max-width:100%;
    margin: auto;
    box-shadow: 0 0 5px 5px #ddd;
    padding: 10px;
    min-height: 100vh;
}
.conts h2,.conts p{
    float:right;
    width: 100%;
    color:#777;
    text-align:center;
}
.conts ul li{
    float:right;
    width: 100%;
    font-size:14px;
    color:#777;
    margin-bottom:5px;
}
.conts ul{
    display: inline-block;
    padding-left:0;
    margin:0;
    margin-bottom:15px;
    margin-top:15px;
}
.conts h2{
    font-weight:bold;
    text-transform: uppercase;
}
.alert{
    display: inline-block;
    width: 100%;
    padding: 12px;
}
.logo{
    display: inline-block;
    width: 100%;
}
.img_logo{
    display: block;
    width: 180px;
    height: 180px;
    position: relative;
    overflow: hidden;
    margin: auto;
}
.img_logo img {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%,-50%);
    width: 120%;
}
.alert p{
    margin:0;
}
form{
    text-aling:center;
}
form .btn{
    
    display: block;
    width: 100%;
    font-size: 14px;
    font-weight: bold;
    padding: 8px;
}
form input {
    float: right;
    width: 100%;
    border: 1px solid #ddd;
    font-size: 14px;
    padding: 8px 14px;
}

.ps img{
    display: inline-block;
}
.ps{
    display: inline-block;
    width: 100%;
    text-align:center;
}
.input i{
    position: absolute;
    left: 8px;
    top: 11px;
    color:#777;
}
.input input{
    padding-left:25px;
}
.input{
    display: inline-block;
    width: 100%;
    margin-bottom: 7px;
    position: relative;
    
}input[readonly] {
    background: #eee;
}
        </style>
    </head>

    <?php
        $state = "";
        if(isset($_GET['a']) && $_GET['a'] != null){
            $amount = $_GET['a'];
        }else{
            $state = "Sorry You Don't Have Amount";
        }
        
    ?>
<body>
    <div class="cont">
        <div class="conts">
            <div class="logo">
                <div class="img_logo">
                    <img src="logo.png">
                </div>
            </div>
            <h2>Ahlan Antalya</h2>
            <p>Travel & Tourism in Turkey</p>
            <?php
                if($state != ""){
                    echo "<div class='alert alert-danger'><p>".$state."</p></div>";
                }
            ?>
            <form <?php echo $state != "" ? "" : 'action="/payment/isBankasiPost.php"' ?> method="post">
                <div class="input">
                    <i class="fa fa-user"></i>
                    <input type="text" name="title" required placeholder="Customer Name" />
                </div>
                <div class="input">
                    <i class="fa fa-phone"></i>
                    <input type="text" name="phone" required placeholder="Phone" />
                </div>
                <div class="input">
                    <i class="fa fa-usd"></i>
                    <input type="text" readonly required name="amount" value="<?php echo $amount; ?>" />
                </div>
                <button class="btn btn-sm btn-info">Pay</button>
            </form>
            <ul>
                <li><i class="fa fa-map-marker"></i> Demircikara mah.1429 sok . Emir apt 16/A, 07010 Muratpaşa/Antalya, Türkiye</li>
                <li><i class="fa fa-phone"></i> +905398865678</li>
            </ul>
            <div class="ps">
                <img src="cart.svg">
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js" integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>