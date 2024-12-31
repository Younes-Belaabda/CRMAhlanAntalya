<!-- resources/views/payment/redirect.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to Bank</title>
</head>
<body onload="document.forms['paymentForm'].submit()">
<p>Redirecting to the bank for 3D Secure authentication, please wait...</p>
<form name="paymentForm" method="POST" action="{{ $postURL }}">
    @csrf
    @foreach ($postdata as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach

</form>
</body>
</html>
