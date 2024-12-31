<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <script src="{{ asset('public/assets/js/conffeti.js') }}"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Inter Tight";
        }

        body {
            height: 100vh;
            overflow: hidden;
            /* display: flex;
            justify-content: center;
            align-items: center; */
            background-color: white;
        }

        .content {
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
            margin: auto;
            width: 50%;
            height: max-content;
            /* display: grid; */
            /* gap: 10px; */
        }

        .wrap {
            border: 1px solid #d6d6d6;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 9px 20px rgba(0, 0, 0, .07);
            display: grid;
            gap: 10px;
            width: 75%;
            margin: auto;
        }

        .wrap svg {
            fill: rgb(252, 34, 34);
            width: 60px;
            height: 60px;
        }

        .site-name , .site-sname {
            text-align: center;
            margin-bottom: 10px;
        }

        .site-sname {
            font-weight: normal;
            font-size:18px;
        }

        .site-logo {
            width: 150px;
            height: 150px;
            display: block;
            margin: auto;
        }

        .btn-back {
            text-decoration: none;
            background-color:black;
            color: white;
            border: 1px solid #d6d6d6;
            width: max-content;
            padding: 5px 10px;
            border-radius: 5px;
            box-shadow: 0 9px 20px rgba(0, 0, 0, .07);
        }

        @media screen and (max-width: 900px) {
            .content {
                width: 90%;
            }
            
            .wrap {
                width: 90%;
            }
        }

        #my-canvas {
            width: 100vw;
            height: 100vh;
        }
    </style>
</head>

<body>
    <canvas id="my-canvas"></canvas>
    <div class="content">
        <img class="site-logo animate__animated animate__bounceIn" src="{{ asset('public/assets/payment/logo.png') }}" alt="" srcset="">
        <h1 class="site-name animate__animated animate__bounceIn">AHLAN ANTALYA</h1>
        <h2 class="site-sname animate__animated animate__bounceIn">Travel & Tourism in Turkey</h2>
        <div class="wrap animate__animated animate__bounceIn animate__delay-1s">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z" />
            </svg>
            <h3>Payment failed!</h3>
            <p>{{ $err }} </p>
            <p>Try again later. Thank you</p>
            <a style="animation-duration: 3s;" class="btn-back animate__animated animate__shakeX  animate__delay-3s animate__infinite" href="{{ url()->previous() }}">Back</a>
        </div>
    </div>
    <script>
        var confettiSettings = { target: 'my-canvas', "colors": [
            [255, 0, 0],
            [255, 0, 0]
        ]};
        var confetti = new ConfettiGenerator(confettiSettings);
        confetti.render();
    </script>
</body>

</html>
