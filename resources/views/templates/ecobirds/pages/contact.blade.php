@extends('templates.ecobirds.master')
@section('title', 'Ecobirds | Contact')
@section('pages')

<div class="wrapper" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="row">
        <div class="col-md-6 column-1-contact">
            <div class="contact-content-box">
                <h1>{{ $home_data->{'Pagina titel'} }}</h1>
                <div class="color-bar"></div>
                <br />
                <p>{{ $home_data->Textbox1 }}</p>
                <li><span><i class="fas fa-phone-alt"></i> {{ $home_data->Telefoonnummer }}</span></li>
                <li><span><i class="fas fa-envelope"></i> {{ $home_data->Email }}</span></li>
                <li><span><i class="fas fa-map-marker-alt"></i> {{ $home_data->Adres }}</span></li>
            </div>
        </div>

        <div class="col-md-6 column-2-contact">
            <div class="contact-form-box">
                <h1>{{ $home_data->{'Formulier titel'} }}</h1>
                <div class="color-bar" style="width: 60px"></div>
                <br />
                <br />
                <form action="#" method="POST">
                    @include('partials.form_template', ['name' => 'Contact'])
                </form>
            </div>
        </div>
    </div>
</div>

@endsection