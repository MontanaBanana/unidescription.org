Hello,

<p>You were invited to collaborate on {{ $project->title }} by <a href="mailto:{{ $invited_by->email }}">{{ $invited_by->name }}</a> on the <a href="{{ url('/') }}">UniDescription</a> website.</p>

<p><a href="{{ url('/auth/login') }}">Click here to login</a>. </p>

<p>Thanks!<br />
- The UniDescription team<br />
<a href="{{ url('/') }}">www.unidescription.com</a></p>