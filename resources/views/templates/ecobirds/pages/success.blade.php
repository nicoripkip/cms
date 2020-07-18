@extends('templates.ecobirds.master')
@section('title', 'Ecobirds | Success')
@section('pages')

<div class="wrapper" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="row">
       <div class="success-column-1"></div>
       <div class="success-column-2">
            <div class="success-header">
                <h3>{{ $home_data->{'Pagina titel'} }}</h3>
                <div class="color-bar"></div>
            </div>
            
            <br />

            <div class="success-body">
                <p>{{ $home_data->Textbox1 }}</p>
            </div>

            <br>
            <br>

            <div class="form-group">
                <button class="btn">Factuur downloaden</button>
            </div>
       </div>
       <div class="success-column-1"></div>
    </div>
</div>

    <script>
        function submitForm() {
            localStorage.removeItem('product');
            document.getElementById('form').submit();
        }


    </script>
@endsection