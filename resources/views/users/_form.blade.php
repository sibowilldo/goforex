<div class="box-body">
            <div class="form-group row has-feedback{{ $errors->has('firstname') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <input id="firstname" type="text" class="form-control" placeholder="First Name" name="firstname" value="{{ old('firstname') }}" required autofocus>
                    <i class="glyphicon glyphicon-user form-control-feedback"></i>
                    @if ($errors->has('firstname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('firstname') }}</strong>
                        </span>
                    @endif            
                </div>
            </div>

            <div class="form-group row has-feedback{{ $errors->has('lastname') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <input id="lastname" type="text" class="form-control"  placeholder="Last Name" name="lastname" value="{{ old('lastname') }}" required autofocus>
                    <i class="glyphicon glyphicon-user form-control-feedback"></i>
                    @if ($errors->has('lastname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <div class="col-xs-12">
                    <div class="alert alert-info">Username will be auto generated and sent to the user</div>
                </div>
            </div>

            <div class="form-group row has-feedback{{ $errors->has('cell') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <input id="cell" type="text" class="form-control"  placeholder="Contact Number (Mobile)" name="cell" value="{{ old('cell') }}" required autofocus>
                    <i class="glyphicon glyphicon-phone form-control-feedback"></i>
                    @if ($errors->has('cell'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cell') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row has-feedback{{ $errors->has('location') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <input id="location" type="text" class="form-control"  placeholder="Location" name="location" value="{{ old('location') }}" required autofocus>
                    <i class="glyphicon glyphicon-pushpin form-control-feedback"></i>
                    @if ($errors->has('location'))
                        <span class="help-block">
                            <strong>{{ $errors->first('location') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="col-xs-12">
                    <input id="email" type="email" class="form-control"  placeholder="E-Mail Address" name="email" value="{{ old('email') }}" required>
                    <i class="glyphicon glyphicon-envelope form-control-feedback"></i>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <div class="col-xs-12">
                    <div class="alert alert-info">Password will be auto generated and sent to the user</div>
                </div>
            </div>

            <div class="form-group row has-feedback">
                <div class="col-xs-12">
                    <input id="password-confirm" type="password" class="form-control"  placeholder="Confirm Password" name="password_confirmation" required>
                    <i class="glyphicon glyphicon-lock form-control-feedback"></i>
                </div>
            </div>

</div>
<div class="box-footer">
	{!! Form::submit($buttonText, ['class' => 'btn btn-primary']) !!}
</div>

<br>