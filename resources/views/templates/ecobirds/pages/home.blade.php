@extends('templates.ecobirds.master')
@section('title', 'Ecobirds | Home')

@section('pages')
    <div class="wrapper" style="margin-top: 100px; margin-bottom: 100px;">
        <div class="row">
            <!-- Column 1 -->
            <div class="slider-text">
                <!-- Textbox 1 -->
                <div class="home-textbox-1">
                    <h1>Welkom</h1>
                    <div class="color-bar" style="width: 60px"></div>
                    <br />
                    <p>{{ $home_data->Textbox1 }}</p>
                </div>
            </div>
            <!-- Column 2 -->
            <div class="slider-image">
                <!-- slider div -->
                <div class="slider-box">
                    <div class="owl-carousel owl-theme owl-loaded">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                                <div class="owl-item"><img class="slider_image" src="{{ asset($home_data->Slider_image_1) }}" /></div>
                                <div class="owl-item"><img class="slider_image" src="{{ asset($home_data->Slider_afbeelding_2) }}" /></div>
                                <div class="owl-item"><img class="slider_image" src="{{ asset($home_data->Slider_afbeelding_3) }}" /></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper">
        <div class="row">
            <div class="teasers">
                <div class="teaser" onclick="location.href = '/vogelhuisjes'">
                    <div class="teasers-image">
                        <img class="" src="{{ asset($home_data->Modal_image_1) }}" />
                    </div>

                    <div class="teasers-content">
                        <h3>{{ $home_data->Modal_titel_1 }}</h3>
                        <div class="color-bar"></div>
                        <br />
                        <p>{{ $home_data->Modal_textbox_2 }}</p>
                    </div>
                </div>

                <div class="teaser" onclick="location.href = '/blog'">
                    <div class="teasers-image">
                        <img class="" src="{{ asset($home_data->Modal_image_2) }}" />
                    </div>

                    <div class="teasers-content">
                        <h3>{{ $home_data->Modal_titel_2 }}</h3>
                        <div class="color-bar"></div>
                        <br />
                        <p>{{ $home_data->Modal_textbox_2 }}</p>
                    </div>
                </div>

                <div class="teaser" onclick="location.href = '/contact'">
                    <div class="teasers-image">
                        <img class="" src="{{ asset($home_data->Modal_image_3) }}" />
                    </div>

                    <div class="teasers-content">
                        <h3>{{ $home_data->Modal_titel_3 }}</h3>
                        <div class="color-bar"></div>
                        <br />
                        <p>{{ $home_data->Modal_textbox_3 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper">
        <div class="row">
            <div class=""></div>
            <div class="">
                <div class="">

                </div>
            </div>
            <div class=""></div>
        </div>
    </div>

<script>
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    autoplay:true,
    responsiveClass:true,
    nav: false,
    navText: ['<div class="owl-nav slider-nav-box-left"><div class="owl-prev slider-button"><i class="fas fa-chevron-left"></i></div></div>', '<div class="owl-nav slider-nav-box-right"><div class="owl-next slider-button"><i class="fas fa-chevron-right"></i></div></div>'],
    responsive:{
        0:{
            items:1,
            dots: false,
            autoheight:true,
        },
        600:{
            items:1,
            autoheight:true,
        },
        1000:{
            items:1,
            loop:true,
            dots:false,
            autoheight:true,
        }
    }
})
});

let modals = document.getElementsByClassName("modal-box");

for (modal of modals) {
    
}
</script>

@endsection