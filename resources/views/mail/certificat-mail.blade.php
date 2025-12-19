@component('mail::message')

@component('mail::panel')
<u>Bonjour {{$receiver}} !</u>,

La demande de certificat <b>{{$title}}</b> de <u>{{$name}}</u> vient d'être accepté par l'équipe RH.
Vous pouvez télécharger le document final en cliquant sur:
@endcomponent

@component('mail::button', ['url' => $url])
Télécharger le certificat
@endcomponent

@component('mail::panel')
Si vous avez du mal à cliquer sur le bouton, copiez et collez le lien suivant dans votre navigateur: 
<strong>{{$url}}</strong>
@endcomponent

L'équipe MADGI.
@endcomponent
