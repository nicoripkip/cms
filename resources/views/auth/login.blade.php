@php
    use App\MessageModel;
    $messages = MessageModel::where('read', 0)->orderby('time')->limit(3)->get();    
@endphp
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Inlogscherm</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link href="{{ asset('css/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/login.css') }}" rel="stylesheet" />
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 main-column">
                    <div class="image-box">
                        <img src="{{ asset($algemeen['app_image']) }}" width="317" height="272" class="image" />
                    </div>

                    <div class="form-box">
                        <form action="{{ route('login') }}" method="POST">
                            <div class="form-group">
                                <input id="email" type="email" class="input-form @error('email') is-invalid @enderror" placeholder="Email-adres.." name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                 
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input id="password" type="password" class="input-form @error('password') is-invalid @enderror" placeholder="Wachtwoord.." name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <br>
                            <br>

                            <div class="form-group" style="text-align: center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                @csrf
                                <button type="submit" class="btn btn-block" style="color: white;background-color: {{ $algemeen['menu_kleur'] }}">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="link-box">
                        <a href="#" class="link-left">Email vergeten</a>
                        <a href="#" class="link-right">Ons volgen</a>
                    </div>
                </div>

                <div class="col-md-8 image-column" style="background: url('{{ asset($algemeen['login_image'] ?? '') }}') no-repeat center center fixed; background-size: cover;">
                    <div class="image-column-content">
                        <div class="close-item">
                            <a href="#" id="close-btn" class="close-btn" style="color: {{ $algemeen['menu_kleur'] }}"><i class="fas fa-times"></i></a>
                        </div>        
                    
                        <div id="card-box" class="card-box">
                            <!-- Dit zijn de kaart items -->
                            @foreach ($messages as $message) 
                                <div class="card-item" style="color: {{ $algemeen['menu_kleur'] }}">
                                    <div class="card-icon">
                                        <i class="{{ $message->image }}"></i>
                                    </div>

                                    <div class="card-content">
                                        <p>{{ $message->message }}</p>
                                    </div>

                                    <div class="card-btn">
                                        <input type="checkbox" name="checkcard" class="card-check" />
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>           
            </div>
        </div>

        <script>
            let close = document.getElementById('close-btn');
            let box = document.getElementById('card-box');
            let check = document.getElementsByClassName('card-check');
            let items = document.getElementsByClassName('card-item');

            close.onclick = function() {
                for (let item of items) {
                    if (item.children[2].children[0].checked == true) {
                        item.remove();
                    } else {
                        continue;
                    }
                }

                if (box.children.length > 1) {
                    close.disabled;
                }   
            }

            if (box.children.length > 1) {
                close.disabled;
            }
        </script>
        <script src="https://kit.fontawesome.com/2098348b1b.js"></script>
    </body>
</html>