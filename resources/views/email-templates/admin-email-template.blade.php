<p>Dear {{ $admin->name }}</p>
<p>
    we are recieved a request to reset the password for account with{{ $admin->email }}
    you can reset your password by clicking the button below
    <br>
<a href="{{ $actionLink }}" target="_blank" style="color: #fff;border-color:#22bc66;border-style:solid;
  border-width:5px 10px;background-color: #00e091;display: inline-block;text-decoration: none;border-radius: 3px ">Reset password</a>
<br>
    <br>
    <b>NB:</b> This link will valid within 15 minutes
If you did not request for a password reset, please ignore this email
</p>
