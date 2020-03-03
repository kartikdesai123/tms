@extends('layouts.login_layout')
@section('content')
<div class="o-page__card o-page--center">
    <div class="c-card u-mb-xsmall">
        <header class="c-card__header u-pt-large">
            <a class="c-card__icon" href="#!">
                <img src="{{ asset('img/logo-login.svg') }}" alt="Dashboard UI Kit">
            </a>
            <h1 class="u-h3 u-text-center u-mb-zero">Multiclean Sarbar GmbH & Co. KG</h1>
            <h1 class="u-h3 u-text-center u-mb-zero">Bitte anmelden</h1>
        </header>
        <div id="errorSection" style="width:100% !important; padding: 20px 25px 0px 25px;">
            @if (session('session_error'))
            <div class="c-alert c-alert--danger alert fade show">
                        <i class="c-alert__icon fa fa-times-circle"></i> {{ session('session_error') }}
                        <button class="c-close" data-dismiss="alert" type="button">×</button>
            </div>
            @endif

            @if (session('session_success'))
            <div class="alert alert-success">
                {{ session('session_success') }}
                <div class="pull-right closeIcon"><i class="fa fa-times" aria-hidden="true"></i></div>
            </div>
            @endif

            @if (session('session_alert'))
            <div class="alert alert-warning">
                {{ session('session_alert') }}
                <div class="pull-right closeIcon"><i class="fa fa-times" aria-hidden="true"></i></div>
            </div>
            @endif
        </div>
        <form class="form-horizontal c-card__body" id="login" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="c-field u-mb-small {{ $errors->has('staffnumber') ? ' has-error' : '' }}">
                <label class="c-field__label" for="input1">Personalnummer</label> 
                <input class="c-input" type="text" name="staffnumber" value="{{ old('staffnumber') }}" id="input1" placeholder="Bitte geben Sie Ihren Personalnummer ein."> 
                @if ($errors->has('staffnumber'))
                <span class="help-block">
                    <strong>{{ $errors->first('staffnumber') }}</strong>
                </span>
                @endif
            </div>

            <div class="c-field u-mb-small {{ $errors->has('password') ? ' has-error' : '' }}">
                <label class="c-field__label" for="input2">Passwort</label> 
                <input class="c-input" type="password" name="password" id="input2" placeholder="Bitte geben Sie Ihr Passwort ein."> 
                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
            <button class="c-btn c-btn--info c-btn--fullwidth" type="submit">Einloggen</button>
            <!-- <span class="c-divider c-divider--small has-text u-mv-medium"><b>Language</b></span>
            <div class="c-field u-mb-small">
                <select class="c-input" id="language" name="language">
                        <option value="English">English</option>
                        <option value="Germen">Germen</option>
                        <option value="Chinese">Chinese</option>
                </select>
                <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"> 
            </div>
            -->
            <!-- <span class="c-divider c-divider--small has-text u-mv-medium">Login via social networks</span>

            <div class="o-line">
                <a class="c-icon u-bg-twitter" href="#!">
                    <i class="fa fa-twitter"></i>
                </a>

                <a class="c-icon u-bg-facebook" href="#!">
                    <i class="fa fa-facebook"></i>
                </a>

                <a class="c-icon u-bg-pinterest" href="#!">
                    <i class="fa fa-pinterest"></i>
                </a>

                <a class="c-icon u-bg-dribbble" href="#!">
                    <i class="fa fa-dribbble"></i>
                </a>
            </div> -->

        </form>
    </div>

   <!-- <div class="o-line">
        <a class="u-text-mute u-text-small" href="register.html">Donâ€™t have an account yet? Get Started</a>
        <a class="u-text-mute u-text-small" href="forgot-password.html">Forgot Password?</a>
    </div> -->
</div>
<style type="text/css">
    .danger {
    opacity: 1;
    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
    font-size: 20px;
}
.closebtn {
    padding-left: 15px;
    color: #000;
    font-weight: bold;
    float: right;
    font-size: 20px;
    line-height: 18px;
    cursor: pointer;
    transition: 0.3s;
}
.c-alert.c-alert--danger.alert.fade.show {
    font-size: 18px;
}
</style>
<script>
$(document).ready(function(){
    $(".closebtn").click(function(){
        $(".danger").hide();
    });
});
</script>
@endsection
