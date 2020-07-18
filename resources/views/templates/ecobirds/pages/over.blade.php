@extends('templates.ecobirds.master')
@section('title', 'Ecobirds | Over')
@section('pages')

<div class="wrapper" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="row">
        <div class="col-md-8 column-1-over">
            <div class="over-content-box">
                <h1>{{ $home_data->{'Pagina titel'} }}</h1>
                <div class="color-bar" style="width: 60px"></div>
                <br />
                <p>{{ $home_data->Textbox1 }}</p>
            </div>
        </div>

        <div class="col-md-4 column-2-over">
            <div class="over-img-box">
                <img class="over-img" src="{{ asset($home_data->Hoofd_afbeelding) }}" />
            </div>
        </div>
    </div>
</div>

@endsection