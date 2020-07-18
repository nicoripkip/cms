@extends('templates.ecobirds.master')
@section('title', 'Ecobirds | Vogelhuisjes')
@section('pages')

<div class="wrapper" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="row">
        <div class="text">
            <div class="box-content-birdhouse">
                <h1>{{ $home_data->{'Pagina titel'} }}</h1>
                <div class="color-bar" style="width: 60px"></div>
                <br />
                <p>{{ $home_data->Textbox1 }}</p>
            </div>
        </div>
    </div>
</div>

<div class="wrapper">
    <div class="row">
            @foreach ($module_data as $key => $item)
                <div class="teasers">
                    <div class="teaser" onclick="location.href = '/vogelhuisjes/{{ $item->slug_url }}'">
                        <div class="teasers-img">
                            <img class="modal-img" src="{{ asset($item->Hoofd_afbeelding) }}" />
                        </div>
        
                        <div class="teasers-content">
                            <h3>{{ $item->Name }}</h3>
                            <div class="color-bar"></div>
                            <br />
                            <span>Status: {{ $item->Status }}</span><br />
                            <span>Grootte: {{ $item->Grootte_lengte }} x {{ $item->Grootte_breedte }} x {{ $item->Grootte_hoogte }}</span><br />
                            <span>Materiaal: {{ $item->Materiaal }}</span><br />
                            <br />
                            <br />
                            <p style="text-align: center;">Klik voor meer info</p>
                        </div>
                    </div>
                </div>
            @endforeach
    </div>
</div>

@endsection