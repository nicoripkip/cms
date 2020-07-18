@component('mail::message')
    Beste {{ $data['Voornaam'] }} {{ $data['Tussenvoegsel'] }} {{ $data['Achternaam'] }}

    {{ $body }}

    Met vriendelijke groet,

    {{ $sender }}
    {{ $mail_s }}
@endcomponent