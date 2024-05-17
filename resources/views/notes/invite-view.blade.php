<!DOCTYPE html>
<html lang="en">
@php

@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            text-align: center;
        }

        .button {
            display: flex;
            justify-content: center;
            margin-top: 20%;
            gap: 20px;
        }

        a {
            text-decoration: none;
        }

        .accept {
            color: #FFF;
            background: #44CC44;
            padding: 15px 20px;
            box-shadow: 0 4px 0 0 #2EA62E;
        }

        .accept:hover {
            background: #6FE76F;
            box-shadow: 0 4px 0 0 #7ED37E;
        }

        .deny {
            color: #FFF;
            background: tomato;
            padding: 15px 20px;
            box-shadow: 0 4px 0 0 #CB4949;
        }

        .deny:hover {
            background: rgb(255, 147, 128);
            box-shadow: 0 4px 0 0 #EF8282;
        }
    </style>
</head>

<body>
    <div class="button">
        <br>
        <a href="{{ route('invitation.reject', ['token' => $token]) }}" class="deny">Reject </a>
        <a href="{{ route('invitation.accept', ['token' => $token]) }}" class="accept">Accept</a>
    </div>
</body>

</html>
