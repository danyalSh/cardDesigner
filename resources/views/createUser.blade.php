@extends('layouts1.body')
@section('section')
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Create User</h3>
        </div>
        <div class="panel-body">
            @if (session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form accept-charset="UTF-8" enctype="multipart/form-data" role="form" method="POST" id="createUser" name="createUser" action="{{ url('/create-user') }}">

                {{csrf_field()}}
                @php
                    $domain = $domain;
                @endphp
                @if(\Auth::user() -> hasRole('super_admin'))
                    <div class="form-group">
                        <label for="company">User Company</label>
                        <select name="company_id" id="company_id" class="btn btn-default dropdown-toggle    " style="width: 20%;">
                            @php
                                $i = 0;
                            @endphp

                            @foreach($companies as $key => $val)
                                @if($i == 0)
                                    @php
                                        $domain = $val->domain;
                                    @endphp
                                @endif
                                <option data-domain="{{$val->domain}}" value="{{$val->id}}">{{$val->name}}</option>
                                @php
                                    $i = $i+1;
                                @endphp
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="form-group">
                    <label for="name">User Name</label>
                    <div class="input-group">
                        <input placeholder="User Name" name="name" type="text" class="form-control">
                        <span class="input-group-addon"><span id="subdomain"> {{'@'.$domain}}</span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="designation">User Designation</label>
                    <input placeholder="User Designation" name="designation" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">User Email</label>
                    <input placeholder="User Email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="ext">User Ext</label>
                    <input placeholder="User Ext" name="ext" class="form-control">
                </div>
                <div class="form-group">
                    <label for="phone">User Phone</label>
                    <input placeholder="User Phone" name="phone" class="form-control">
                </div>
                {{--<div class="form-group">--}}
                    {{--<label for="card_front">User Card Front</label>--}}
                    {{--<input type="file" id="card_front" name="card_front" class="fa fa-upload"/>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<label for="card_back">User Card Back</label>--}}
                    {{--<input type="file" id="card_back" name="card_back" class="fa fa-upload"/>--}}
                {{--</div>--}}

                <button class="btn btn-success" type="submit">Submit</button>
            </form>
        </div>
    </div>
@stop

@section('js')
    @parent
    <script>
        $(document).ready(function(){
            $("#company_id").change(function(){
               var val = $("#company_id").val();
               var domain = $("#company_id").find(':selected').data('domain')
                console.log(domain);
                console.log(val);
                $('#subdomain').html(domain);
            });
        });
    </script>
@stop