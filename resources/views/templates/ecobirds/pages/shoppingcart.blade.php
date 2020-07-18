@extends('templates.ecobirds.master')
@section('title', 'Ecobirds | Shoppingcard')
@section('pages')

<div class="wrapper" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="row">
        <div class="shopping-cart-column-1"></div>
        <div class="shopping-cart-column-2 column-1" style="padding: 10px;">
            <div class="shoppingcart-title">
                <h1>{{ $home_data->{'Pagina titel'} }}</h1>
                <div class="color-bar" style="width: 60px;"></div>
            </div>

            <div class="shoppingcart-list" id="cart-list">
                
            </div>

            <div class="form-group">
                <button class="btn" id="pay-button" onclick="location.href = '/payment'">Afrekenen</button>
            </div>
        </div>
        <div class="shopping-cart-column-1">
            <div class="cart-dip">
                <h1 id="total">Totaal: €</h1>
                <div class="color-bar" style="width: 60px;"></div>
            </div>
        </div>
    </div>
</div>

    <script>
        var list = document.getElementById('cart-list');
        var total = 0;

        Storage.prototype.setObj = function($key, $value) {
            this.setItem($key, JSON.stringify($value));
        }

        Storage.prototype.getObj = function(key) {
            var value = this.getItem(key);
            return value && JSON.parse(value);
        }

        function henk(event) {
            let btn = document.getElementsByClassName('delete-button');

            deleteCartItems(event.target.parentElement.parentElement.parentElement.children[0].children[0].textContent);
        }

        function deleteCartItems(id) {
            let array  = [];
            let productList = localStorage.getObj('product');
            id = parseInt(id)-1;

            productList = productList.filter(function(val) {
                return val != null || val != undefined;
            });

            total = total - parseFloat(productList[id].price);
            delete productList[id];
            productList = productList.filter(function(val) {
                return val != null || val != undefined;
            });

            console.log(productList);  

            localStorage.removeItem('product');
            localStorage.setObj('product', productList);
            console.log(localStorage.getObj('product'));
            location.reload();
        }

        function getCartItems() {
            // localStorage.clear();
            let productList = localStorage.getObj('product');
            productList = productList.filter(function(val) {
                return val != null || val != undefined;
            });
            console.log(productList);

            for (let cartItem in productList) {
                
                console.log(cartItem);
                total = total + parseFloat(productList[cartItem].price);
                list.innerHTML += `<li>
                                    <div class="cart-box">
                                        <div class="row">
                                                <div class="col-sm-2 cart-column">
                                                    <h3 class='id'>${parseInt(cartItem)+1}</h3>
                                                </div>
                                                <div class="col-sm-2 cart-column">
                                                    <h3>€ ${productList[cartItem].price}</h3>
                                                </div>
                                                <div class="col-sm-2 cart-column">
                                                    <h3>${productList[cartItem].name}</h3>
                                                </div>
                                                <div class="col-sm-2 cart-column">
                                                    <h3>Kleur: ${productList[cartItem].color}</h3>
                                                </div>
                                                <div class="col-sm-2 cart-column">
                                                    <input type="number" name="aantal" class="form-control" length="2" value="1" />
                                                </div>
                                                <div class="col-sm-2 cart-column">
                                                    <button class="btn delete-button" style="color: red; font-size: 40px;" onclick="henk(event)"><i class="far fa-times-circle"></i></button>
                                                </div>
                                            </div> 
                                        </div>
                                    </li>`;
            }
        }

        getCartItems();

        let button = document.getElementById('pay-button');
        if (document.getElementById('cart-list').children.length == 0) {
            button.disabled = true;
        } else {
            button.disabled = false;
        }

        document.getElementById('total').innerText = 'Totaal: €' + total.toFixed(2);
    </script>
@endsection