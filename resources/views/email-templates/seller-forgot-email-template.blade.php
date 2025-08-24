<b>{{ $seller->name }}</b><br>
<p>you are receiving this email you request {{ get_settings()->site_name }}</p>
<p>please use the link

<a href="{{ $actionLink }}" target="_blank">{{ $actionLink }}</a></p>
<p>this password reset link is only valid for 15 minute</p>
<p>this email was automaicaly send by {{ get_settings()->site_name }}</p>
