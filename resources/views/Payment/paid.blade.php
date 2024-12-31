<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment Status</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
      rel="stylesheet"
    />
    <style>
      body {
        font-family: "Tajawal", system-ui;
        position: relative;
      }

      .items {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
      }

      .logo {
        width: 70%;
      }
      .approved,
      .decline {
        width: 50%;
      }
      .decline-text {
        padding: 20px;

        color: red;
      }
      .approved-text {
        padding: 20px;

        color: green;
      }
    </style>
  </head>

  <body>
    <div class="items">
      <img src="{{ asset('public/assets/img/logo.png') }}" alt="Logo" class="logo" />
      <h1>
        <span style="text-transform: uppercase">Ahlan Antalya</span>
        <br />
        <span style="font-weight: 400; font-style: italic; font-size: 16pt"
          >Travel & Tourism in Turkey</span
        >
      </h1><br><br>






@if($response->Response == 'Approved')

    <!-- whene approved -->
      <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 16 16">
        <path fill="#00b569" d="M8,0C3.582,0,0,3.582,0,8s3.582,8,8,8s8-3.582,8-8S12.418,0,8,0z"></path><polygon fill="#fff" points="7,12 3.48,8.48 4.894,7.066 7,9.172 11.71,4.462 13.124,5.876"></polygon>
        </svg>
      <h2 class="approved-text">  {{ $status }}</h2>
        <p>
            {{ \Carbon\Carbon::parse($time)->format('H:i A') }} 
            <br> 
            {{ \Carbon\Carbon::parse($time)->format('d-m-Y') }}
        </p>
        
        
@else 

      <!-- whene decline  -->
      <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 16 16">
        <circle cx="8" cy="8" r="8" fill="#fe3155"></circle><polygon fill="#fff" points="11.536,10.121 9.414,8 11.536,5.879 10.121,4.464 8,6.586 5.879,4.464 4.464,5.879 6.586,8 4.464,10.121 5.879,11.536 8,9.414 10.121,11.536"></polygon>
        </svg>
      <h2>
        <span class="decline-text">   {{ $status }}</span>
        <br />
        <br />
        <!-- ErrMsg -->
        <span style="font-weight: 400; font-size: 16pt">
            {{ $response->ErrMsg }}
        </span>
      </h2>


@endif




      <h4 style="font-weight: 400">Thank You!</h4>
    </div>
  </body>
</html>
