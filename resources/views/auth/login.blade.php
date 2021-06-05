@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="login-box visible widget-box no-border">
    <div class="widget-body">
        <div class="widget-main">
            <h4 class="header blue lighter bigger">
                <i class="ace-icon fa fa-coffee green"></i>
                Please Enter Your Information
            </h4>

            <div class="space-6"></div>

            <form method="POST" action="{{ route('login') }}" autocomplete="off" id="login-form">

                @csrf

                <fieldset>
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <input type="email" class="form-control @error('email') error @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email" required />
                            <i class="ace-icon fa fa-envelope"></i>
                        </span>

                        @error('email')
                        <label id="email-error" class="error" for="email">{{$message}}</label>
                        @enderror

                    </label>

                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <input type="password" class="form-control @error('password') error @enderror" name="password" placeholder="Enter Password" required />
                            <i class="ace-icon fa fa-lock"></i>
                        </span>

                        @error('password')
                        <label id="password-error" class="error" for="password">{{$message}}</label>
                        @enderror
                    </label>

                    <div class="space"></div>

                    <div class="clearfix">
                        <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                            <i class="ace-icon fa fa-key"></i>
                            <span class="bigger-110">Login</span>
                        </button>
                    </div>

                    <div class="space-4"></div>
                </fieldset>
            </form>
        </div><!-- /.widget-main -->
    </div><!-- /.widget-body -->
</div><!-- /.login-box -->
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $("#login-form").validate();
    });
</script>
@endpush