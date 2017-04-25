<div class="col-lg-6 col-md-9 col-md-offset-3">
    <form class="form animated fadeInDown" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div>
            <h1 class="animated fadeInDown">Sign in</h1><br/>
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

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <input id="password" type="password" class="form-control input-text" name="password"
                   required placeholder="Password">
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        Remember Me
                    </label>
                </div>
            </div>
        </div>

        <div>
            <button type="submit" class="input-btn">Sign In</button>
        </div>
    </form>
</div>