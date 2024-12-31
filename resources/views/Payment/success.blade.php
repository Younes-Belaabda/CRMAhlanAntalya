<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
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
            width: 100%;
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
            fill: #47e255;
            width: 60px;
            height: 60px;
        }

        .site-name,
        .site-sname {
            text-align: center;
            margin-bottom: 10px;
            /* font-size: 2em; */
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
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path
                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
            </svg>
            <h3>Payment successful.</h3>
            <p>Thank you for processing your most recent payment.</p>
            <p>Your payment has been done on {{ \Carbon\Carbon::parse(now())->format('F j Y, g:i a') }} .</p>
            <a class="btn-back" href="{{ url()->previous() }}">Back</a>
        </div>
    </div>
    <script>
        var confettiSettings = {
            target: 'my-canvas', "colors": [
                [71, 226, 85],
                [0, 255, 0]
            ],
            props: ['circle' , 'line'],
            size: 0.6,
            max: 1000
        };
        var confetti = new ConfettiGenerator(confettiSettings);
        confetti.render();
    </script>
</body>

</html>
