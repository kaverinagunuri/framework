@extends('Login/Dashboard')
@section('content')
<section>
    <div class="login-box-body">
        @if ( session()->has('status') )
        <div class="alert alert-info"> {{ session()->get('status') }}</div>
        @endif
        <h3 class="login-box-msg">Update Profile</h3>

        <form action="{{URL::route('modifiedprofile')}}" method="post" id="Form">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Full name" id="FirstName" name="FirstName" value="{{$details->FirstName}}">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <label for="FirstName" class="error"></label>

            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Last name" id="LastName" name="LastName" value="{{$details->LastName}}">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                <label for="LastName" class="error"></label>
            </div>
            <div class="form-group has-feedback" id="gender" >
                @if($details->GenderId==0)
                <label for="gender_male">
                    <input  type="radio" id="gender_male" value="Male" name="gender" checked="" />
                    Male
                </label>
                @else
                <label for="gender_female">
                    <input  type="radio" id="gender_female" value="Female" name="gender" checked=""/>
                    Female
                </label>
                @endif
                <br/>
                <label for="gender" class="error"></label>

            </div>

            <div class='form-group has-feedback'>
                <input type="email" class="form-control" placeholder="Email" id="UserName" name="UserName" value="{{$details->UserName}}" readonly="">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                <label for="UserName" class="error"></label>
            </div>
            

            <div class="row">

                <div class="col-xs-4">
                    <button type="submit" id="register" class="btn btn-primary btn-block btn-flat">Update</button>
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
