<p>Dear {{ $admin->name }}</p>
<br>
<p>
   your password change successfully
    <br>
    <b>Login Id:</b> {{ $admin->username }} or {{ $admin->email }}
    <br>
    <b>Password:</b> {{ $new_password }}
</p>
<br>
<a href="{{ $actionLink }}" target="_blank" style="color: #fff;border-color:#22bc66;border-style:solid;
  border-width:5px 10px;background-color: #00e091;display: inline-block;text-decoration: none;border-radius: 3px ">Reset password</a>
<br>
    <br>
    <b>NB:</b> This link will valid within 15 minutes
If you did not request for a password reset, please ignore this email

