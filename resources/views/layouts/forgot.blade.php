<div class="col-lg-6 col-md-9 col-md-offset-3">
    <form class="form animated fadeInDown" method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}

        <div>
            <h1 class="animated fadeInDown">Forgot Password</h1><br/>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <input id="email" type="email" class="form-control input-text" name="email"
                   value="{{ old('email') }}" required placeholder="Email Address">
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div>
            <button type="submit" class="input-btn">Reset Password</button>
        </div>
    </form>
</div>