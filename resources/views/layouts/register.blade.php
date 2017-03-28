<div class="col-lg-6 col-md-9 col-md-offset-3">
    <div id="sendmessage">Your message has been sent. Thank you!</div>
    <div id="errormessage"></div>

    <form role="form" class="contactForm animated fadeInDown" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}

        <div>
            <h1 class="animated fadeInDown">Join Us Now</h1><br/>
        </div>

        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
            <input id="firstname" type="text" class="form-control input-text" name="firstname"
                   value="{{ old('firstname') }}" required placeholder="First Name">

            @if ($errors->has('firstname'))
                <span class="help-block">
                    <strong>{{ $errors->first('firstname') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
            <input id="lastname" type="text" class="form-control input-text" name="lastname"
                   value="{{ old('lastname') }}" required placeholder="Last Name ">

            @if ($errors->has('lastname'))
                <span class="help-block">
                    <strong>{{ $errors->first('lastname') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
            <input id="username" type="text" class="form-control input-text" name="username"
                   value="{{ old('username') }}" required placeholder="Username">

            @if ($errors->has('username'))
                <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('cell') ? ' has-error' : '' }}">
            <input id="cell" type="text" class="form-control input-text" name="cell"
                   value="{{ old('cell') }}"
                   required autofocu placeholder="Mobile Number" s>

            @if ($errors->has('cell'))
                <span class="help-block">
                    <strong>{{ $errors->first('cell') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
            <input id="location" type="text" class="form-control input-text" name="location"
                   value="{{ old('location') }}" required placeholder="Location">

            @if ($errors->has('location'))
                <span class="help-block">
                    <strong>{{ $errors->first('location') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <input id="email" type="email" class="form-control input-text" name="email"
                   value="{{ old('email') }}"
                   required placeholder="Email Address">

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
            <input id="password-confirm" type="password" class="form-control input-text"
                   name="password_confirmation" required placeholder="Confirm Password">
        </div>

        <div>
            <button type="submit" class="input-btn">Sign Up</button>
        </div>
    </form>
</div>