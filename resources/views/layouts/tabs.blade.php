<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs centred" role="tablist">
        <li role="presentation" class="active"><a href="#login" aria-controls="home" role="tab" data-toggle="tab">Sign In</a></li>
        <li role="presentation"><a href="#signup" aria-controls="profile" role="tab" data-toggle="tab">Sign Up</a></li>
        <li role="presentation"><a href="#forgot" aria-controls="messages" role="tab" data-toggle="tab">Forgot Password</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="login">
            @include('layouts.login')
        </div>
        <div role="tabpanel" class="tab-pane" id="signup">
            @include('layouts.register')
        </div>
        <div role="tabpanel" class="tab-pane" id="forgot">
            @include('layouts.forgot')
        </div>
    </div>
</div>