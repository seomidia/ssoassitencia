@component('mail::message')
<p>O curriculum de {{$name}} esta em anexo e acaba de ser enviado pelo site .</p>
    <p>Name: {{$name}}</p>
    <p>Sobrenome: {{$sobrenome}}</p>
    <p>E-mail: {{$email}}</p>
    <p>Telefone: {{$telefone}}</p>
@endcomponent
