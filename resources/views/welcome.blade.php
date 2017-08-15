@extends('layouts1.body')

@section('page_title')
    Login
@stop

@section('section')
    <form role="form" method="POST" action="{{ url('/login') }}">
        {{csrf_field()}}
        <div class="form-content" >
            <div class="form-group">
                <input type="text" name="email" class="form-control input-underline input-lg" id="" placeholder=Email>
            </div>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong style="color: white">{{ $errors->first('email') }}</strong>
                </span>
            @endif
            <div class="form-group">
                <input type="password" name="password" class="form-control input-underline input-lg" id="" placeholder=Password>
            </div>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong style="color: white">{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <input type="submit" class="btn btn-white btn-outline btn-lg btn-rounded progress-login" value="Login" />
        &nbsp;
        <a href="/signup" class="btn btn-white btn-outline btn-lg btn-rounded">Register</a>
    </form>
@stop