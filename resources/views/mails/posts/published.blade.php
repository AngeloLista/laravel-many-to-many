@component('mail::message')
#  Your Post has been successfully published.
 
<p><strong>Post tile: </strong>{{ $post->title }}</p>
<p><strong>Contenuto: </strong>{{ $post->content }}</p>
<address><strong>From: </strong>{{ $post->author->name }}, <strong>Email: </strong>{{ $post->author->email }}</address>
 
@component('mail::button', ['url' => $url])
View Post
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent