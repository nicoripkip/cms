<div class="wrapper">
    <div class="menu-bar">

        <div class="container">
            <div class="menu-bar-header">
                <div class="menu-bar-header-image">
                    <img class="menu-logo" src="@if(isset($algemeen['app_image'])) {{ asset($algemeen['app_image']) }} @else {{ asset('/media/default_logo.png') }} @endif" />
                </div>
                <div class="menu-bar-header-text">
                    <a class="menu-bar-brand brand-size" href="/home">{{ strtoupper($algemeen['cms_naam']) }}</a>
                </div>
            </div>
        </div>
        <ul class="menu-bar-navigation" id="myLinks">
            @foreach($menus as $key => $value)
                <li>
                    <a class="menu-item @if($value->slug == 'contact') active @endif" href="/{{ $value->slug }}">{{ strtoupper($value->name) }}</a>
                </li>
            @endforeach

            <li>
                <a class="menu-item" href="/shoppingcart"><i class="fas fa-shopping-cart"></i></a>
            </li>
            
        </ul>

        <!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
        <div class="hamburgermenu">
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <div class="hamburgermenu-close" id="close">
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-close"></i>
            </a>
        </div>
    </div>
</div>

<script>
    function myFunction() {
        var x = document.getElementById("myLinks");
        var z = document.getElementById("close");
        if (x.style.display === "block") {
            x.style.display = "none";
            z.style.display = "none";   
        } else {
            x.style.display = "block";
            z.style.display = "block";
        }
    }
</script>