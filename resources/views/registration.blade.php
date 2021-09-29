<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
<div class="login">
    <div class="login-triangle"></div>

    <h2 class="login-header">Log in</h2>

    <form class="login-container" method="POST" action="{{route('user.registration')}}">
        <p><input type="email" name="email" placeholder="Email"></p>
        {{ $errors->first('email') }}
        <p><input type="text" name="name" placeholder="FirstName"></p>
        {{ $errors->first('name') }}
        <p><input type="text" name="surname" placeholder="SecondName"></p>
        {{ $errors->first('surname') }}
        <p><input type="password" name="password" placeholder="Password"></p>
        {{ $errors->first('password') }}
        @csrf
        <p><input type="submit" value="Regsitration"></p>

    </form>
</div>
</body>

<style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

    body {
        background: #456;
        font-family: 'Open Sans', sans-serif;
    }

    .login {
        width: 400px;
        margin: 16px auto;
        font-size: 16px;
    }

    /* Reset top and bottom margins from certain elements */
    .login-header,
    .login p {
        margin-top: 0;
        margin-bottom: 0;
    }

    /* The triangle form is achieved by a CSS hack */
    .login-triangle {
        width: 0;
        margin-right: auto;
        margin-left: auto;
        border: 12px solid transparent;
        border-bottom-color: #28d;
    }

    .login-header {
        background: #28d;
        padding: 20px;
        font-size: 1.4em;
        font-weight: normal;
        text-align: center;
        text-transform: uppercase;
        color: #fff;
    }

    .login-container {
        background: #ebebeb;
        padding: 12px;
    }

    /* Every row inside .login-container is defined with p tags */
    .login p {
        padding: 12px;
    }

    .login input {
        box-sizing: border-box;
        display: block;
        width: 100%;
        border-width: 1px;
        border-style: solid;
        padding: 16px;
        outline: 0;
        font-family: inherit;
        font-size: 0.95em;
    }

    .login input[type="email"],
    .login input[type="password"] {
        background: #fff;
        border-color: #bbb;
        color: #555;
    }

    /* Text fields' focus effect */
    .login input[type="email"]:focus,
    .login input[type="password"]:focus {
        border-color: #888;
    }

    .login input[type="submit"] {
        background: #28d;
        border-color: transparent;
        color: #fff;
        cursor: pointer;
    }

    .login input[type="submit"]:hover {
        background: #17c;
    }

    /* Buttons' focus effect */
    .login input[type="submit"]:focus {
        border-color: #05a;
    }
</style>
