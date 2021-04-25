@component('mail::message')
    <p>Name: {{$name}}</p>
    <p>Sobrenome: {{$sobrenome}}</p>
    <p>E-mail: {{$email}}</p>
    <p>Assunto: {{$assunto}}</p>
    <p>Mensagem:</p> {{$mensagem}}
@endcomponent
