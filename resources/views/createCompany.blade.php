@extends('layouts1.body')
@section('section')
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Create Company</h3>
        </div>
        <div class="panel-body">
            @if (session()->has('message'))
               <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            @if (session()->has('error'))
               <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form accept-charset="UTF-8" enctype="multipart/form-data" role="form" method="POST" id="createCompany" name="createCompany" action="{{ url('/create-company') }}">

                {{csrf_field()}}
                <div class="form-group">
                    <label for="domain">Company Domain</label>
                    <input type="domain" placeholder="Company Domain i.e. smonte" id="domain"  name="domain" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Company Name</label>
                    <input placeholder="Company Name" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="address">Company Address</label>
                    <input placeholder="Company Address" name="address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Company Email</label>
                    <input placeholder="Company Email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Company Password</label>
                    <input placeholder="Company Password" id="password" type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="phone">Company Phone</label>
                    <input placeholder="Company Phone" name="phone" class="form-control">
                </div>
                <div class="form-group">
                    <label for="city">Company City</label>
                    <input placeholder="City" name="city" class="form-control">
                </div>
                <div class="form-group">
                    <label for="State">Company State</label>
                    <input placeholder="State" name="state" class="form-control">
                </div>
                <div class="form-group">
                    <label for="zip">Company Phone</label>
                    <input placeholder="Zip" name="zip" class="form-control">
                </div>
                <div class="form-group">
                    <label for="uploadImage">Company Logo</label>
                    <input type="file" id="uploadImage" name="uploadImage" class="fa fa-upload"/>
                </div>

                <button class="btn btn-success" type="submit">Submit</button>
            </form>
        </div>
    </div>
@stop

@section('js')
    @parent

@stop