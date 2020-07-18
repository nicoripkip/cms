@extends('templates.ecobirds.master')
@section('title', 'Ecobirds | Payment')
@section('pages')

<div class="wrapper" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="row">
        <div class="payment-column-1"></div>
        <div class="column-1">
            <form action="/success" method="POST" id="form">
                <div class="payment-content">
                    <h1>{{ $home_data->Name }}</h1>
                    <div class="color-bar"></div>
                    <br />
                    <br />
                </div>
                @include('partials.form_template', ['name' => 'Betalen', 'button' => 'afrekenen'])
             </form> 
        </div>

        <div class="payment-column-2 column-1" style="background-color: #edfef0 !important">
            <div class="select-payment">
                <!-- Optie 1 -->
                <div class="payment-option payment-btn">
                    <p class="btn-warning">Omdat er nog problemen zijn met het regelen van id moet u handmatig het geld overmaken</p>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

    <script>
        function submitForm() {
            localStorage.removeItem('product');
            document.getElementById('form').submit();
        }


    </script>
@endsection