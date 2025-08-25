
<p>{{ $seller->name }}</p>
<p>your password on {{ get_settings()->site_name }}</p>
<br>
<p>login id : {{ isset($seller->username) ? $seller->username. 'or ' : '' }}
{{ $seller->email }}
<br>
    <b>password: </b> {{ $new_password }}
</p>
<br>
<p>{{ get_settings()->site_name }}</p>
