{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}


{{-- <div class="col-md-6 col-sm-6 sign-in">
    <h4 class="">Forget Password</h4>
    <p class="">Forgot your password? No Problem</p>
     
   

    <form method="POST" action="{{ route('password.email') }}">
            @csrf


        <div class="form-group">
            <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
            <input type="email" id="email" name="email" class="form-control unicase-form-control text-input">
        </div>
        
        
        <button type="submit" class="btn-upper btn btn-primary checkout-page-button">Email Password Reset Link</button>
    </form>   


</div> --}}

<style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "segoe ui", verdana, helvetica, arial, sans-serif;
      font-size: 16px;
      transition: all 500ms ease; }

    body {
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      text-rendering: optimizeLegibility;
      -moz-font-feature-settings: "liga" on; }

    .row {
      background-color: rgba(20, 120, 200, 0.6);
      color: #fff;
      text-align: center;
      padding: 2em 2em 0.5em;
      width: 90%;
      margin: 2em	auto;
      border-radius: 5px; }
      .row h1 {
        font-size: 2.5em; }
      .row .form-group {
        margin: 0.5em 0; }
        .row .form-group label {
          display: block;
          color: #fff;
          text-align: left;
          font-weight: 600; }
        .row .form-group input, .row .form-group button {
          display: block;
          padding: 0.5em 0;
          width: 100%;
          margin-top: 1em;
          margin-bottom: 0.5em;
          background-color: inherit;
          border: none;
          border-bottom: 1px solid #555;
          color: #eee; }
          .row .form-group input:focus, .row .form-group button:focus {
            background-color: #fff;
            color: #000;
            border: none;
            padding: 1em 0.5em; animation: pulse 1s infinite ease;}
        .row .form-group button {
          border: 1px solid #fff;
          border-radius: 5px;
          outline: none;
          -moz-user-select: none;
          user-select: none;
          color: #333;
          font-weight: 800;
          cursor: pointer;
          margin-top: 2em;
          padding: 1em; }
          .row .form-group button:hover, .row .form-group button:focus {
            background-color: #fff; }
          .row .form-group button.is-loading::after {
            animation: spinner 500ms infinite linear;
            content: "";
            position: absolute;
            margin-left: 2em;
            border: 2px solid #000;
            border-radius: 100%;
            border-right-color: transparent;
            border-left-color: transparent;
            height: 1em;
            width: 4%; }
      .row .footer h5 {
        margin-top: 1em; }
      .row .footer p {
        margin-top: 2em; }
        .row .footer p .symbols {
          color: #444; }
      .row .footer a {
        color: inherit;
        text-decoration: none; }

    .information-text {
      color: #ddd; }

    @media screen and (max-width: 320px) {
      .row {
        padding-left: 1em;
        padding-right: 1em; }
        .row h1 {
          font-size: 1.5em !important; } }
    @media screen and (min-width: 900px) {
      .row {
        width: 50%; } }
</style>


<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Yinka Enoch Adedokun">
	<meta name="description" content="Simple Forgot Password Page Using HTML and CSS">
	<meta name="keywords" content="forgot password page, basic html and css">
	<title>Forgot Password Page - HTML + CSS</title>
</head>
<body>

	<div class="row">
        
        <form method="POST" action="{{ route('admin.password.email') }}">
            @csrf
            
            <h1>Admin Forgot Password</h1>
            <h6 class="information-text">Enter your registered email to reset your password.</h6>
            
            <div class="form-group">
                <input type="email" id="email" name="email">
                @error('email')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                <p><label for="username">Email</label></p>
                <button onclick="showSpinner()">Reset Password</button>
            </div>
            <div class="footer">
                <h5>Already have an account? <a href="{{ route('admin.login') }}">Sign In.</a></h5>
                <p class="information-text"><span class="symbols" title="Lots of love from me to YOU!">&hearts; </span><a href="#" target="_blank" title="Connect with me on Facebook">Admin Penel Ekota Mart</a></p>
            </div>
            
        </form>
	</div>
</body>