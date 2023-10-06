<p>Dear {{ $admin->name }}</p>
<p>
    Your password on laravel system was changed successfully.
    Here is your new login credentials:
    <br>
    <b>Login ID: </b>{{ $admin->username }} or {{ $admin->email }}
    <br>
    <b>Password: </b> {{ $new_password }}
    </p>
    <br>
    Please, keep your credentials cinfidantial. Your username and password are your own credentials and you should
    never share them with anybody else.
    <p>
           Cyberclashpunk will not be liable for any misuse of your username or password.
    </p>
    <br>
    ------------------------------------------------------------------
    <p>
     This email was automatically sent by cyberclashpunk system. Do not reply for it.
    </p>