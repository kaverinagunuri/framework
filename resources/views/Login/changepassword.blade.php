@extends('Login/Dashboard')
@section('content')
<section>
    <div class="login-box-body">
        @if ( session()->has('changepassword') )
        <div class="alert alert-info"> {{ session()->get('changepassword') }}</div>
        @endif
        <h3 class="login-box-msg">Change Password</h3>
        <form action="{{URL::route('resetpassword')}}" method="post" id="Form">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>

            <div class='form-group has-feedback'>
                <input type="email" class="form-control" placeholder="Email" id="UserName" name="UserName" readonly="" value="{{$UserName}}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                <label for="UserName" class="error"></label>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="Password" id="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <label for="Password" class="error"></label>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Confirm Password" name="Confirm"  id="Confirm"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <label for="Confirm" class="error"></label>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" name="forgot" id="forgot" class="btn btn-primary ">Change Password</button>
                </div>

            </div>
        </form>
    </div>
    @endsection
</section>
@section('script')

<script src="{{asset('JavaScript/jquery-2.2.2.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>

<script src="{{asset('JavaScript/Validations.js')}}"></script>
@endsection