    @extends('templates.ecobirds.master')
@section('title', 'Ecobirds | Vogelhuisjes detail')
@section('pages')

<div class="wrapper">
    <div class="row">
        <div class="vogeldetail-img">
            <div class="vogeldetail-image">
                <img class="birdhouse-detail-img" src="{{ asset($module_data->Hoofd_afbeelding) }}" />
            </div>
        </div>

        <div class="vogeldetail-content">
            <form class=#" action="/shoppingcart" method="POST">

                <div class="vogeldetail-content-box">
                    <h1>{{ $module_data->Module_titel_2 }}</h1>
                    <div class="color-bar"></div>
                    <br />

                    <div class="vogeldetail-content-color-wrapper">
                        <div class="vogeldetail-content-color color-group">
                            <input type="radio" name="color" class="checkbox_color" id="color_naturel" checked value="naturel" />
                            <label class="normaal-label four col" for="color_naturel" style="background-color:#674d27">Normaal</label>
                        </div>

                        <div class="vogeldetail-content-color color-group">
                            <input type="radio" name="color" class="checkbox_color" id="color_zwart" value="zwart" />
                            <label class="zwart-label four col" for="color_zwart" style="background-color:#000000">Zwart</label>
                        </div>

                        <div class="vogeldetail-content-color color-group">
                            <input type="radio" name="color" class="checkbox_color" id="color_groen" value="groen" />
                            <label class="groen-label four col" for="color_groen" style="background-color:#18693a">Groen</label>
                        </div>
                    </div>
                </div>

                <div class="vogeldetail-content-box">
                    <h1>{{ $module_data->Module_titel_3 }}</h1>
                    <div class="color-bar"></div>
                    <br />
                    <p id="status">Status: {{ $module_data->Status }}</p>
                    <p id="size">Grootte: {{ $module_data->Grootte_lengte }}mm X {{ $module_data->Grootte_breedte }}mm X {{ $module_data->Grootte_hoogte }}mm</p>
                    <p id="material">Materiaal: {{ $module_data->Materiaal }}</p>
                    <p id="bird">Type vogel: {{ $module_data->Vogel }}</p>
                    <br />
                    <p>{{ $module_data->Textbox1 }}</p>
                    <br />
                    <h1>Prijs: €{{ $module_data->Prijs }}</h1>
                    <br />
                    @csrf
                    <button onclick="return false;" class="btn" style="text-align: center">Voeg toe aan winkelwagen</button>
                    <br />
                </div>
            </form>
        </div>
    </div>
</div>

    <script>
        let status = document.getElementById('status');
        let size = document.getElementById('size');
        let material = document.getElementById('material');
        let bird = document.getElementById('bird');
        let name = document.getElementById('name');

        var type = 'A';
        var color = 'naturel';
        var counter = 0;

        $('.checkbox_type').change(function() {
            if (document.getElementById('type_a').checked == 1) {
                document.getElementById('size').textContent = "Grootte: 30mm X 30mm X 30mm";
                type = 'A';
            }
            if (document.getElementById('type_b').checked == 1) {
                document.getElementById('size').textContent = "Grootte: 40mm X 40mm X 40mm";
                type = 'B';
            }
            if (document.getElementById('type_c').checked == 1) {
                document.getElementById('size').textContent = "Grootte 50mm X 50mm X 50mm";
                type = 'C';
            }
            if (document.getElementById('type_d').checked == 1) {
                document.getElementById('size').textContent = "Grootte 60mm X 60mm X 60mm";
                type = 'D';
            }
        });

        $('.checkbox_color').change(function() {
            if (document.getElementById('color_naturel').checked == 1) {
                color = 'naturel';
            }
            if (document.getElementById('color_zwart').checked == 1) {
                color = 'zwart';
            }
            if (document.getElementById('color_groen').checked == 1) {
                color = 'groen';
            }
        });

        Storage.prototype.setObj = function($key, $value) {
            this.setItem($key, JSON.stringify($value));
        }

        Storage.prototype.getObj = function(key) {
            var value = this.getItem(key);
            return value && JSON.parse(value);
        }

        $('.btn').click(function() {
            addToCard();
        });

        function addToCard() {
            
            var confir = confirm("Weet u zeker dat u wilt afrekenen");

            var productJSON = {'id':'{{ $module_data->id }}', 'name':'{{ $module_data->Name }}', 'price':'{{ $module_data->Prijs }}', 'type':type, 'color':color, 'status':status.textContent, 'size':size.textContent, 'material':material.textContent, 'bird':bird.textContent};
            var productArray = [];
            
            if(localStorage.getObj('product')!==null){
                productArray=localStorage.getObj('product');
                productArray.push(productJSON);  
                localStorage.setObj('product', productArray);  
            }
            else{
                productArray.push(productJSON);  
                localStorage.setObj('product', productArray);  
            }

            if (confir == true) {
                location.href = '/shoppingcart';
            } else {
                location.href = '/vogelhuisjes';
            }
        }

        
        
    </script>
@endsection