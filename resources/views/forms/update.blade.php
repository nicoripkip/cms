@extends('layouts.master')
@section('title', 'Formulieren | update')
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Formulieren
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="{{ route('admin.forms.index') }}">Formulieren</a></li>
        <li><a href="{{ route('admin.forms.update', [$forms->id]) }}">Formulieren updaten</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="box box-primary" style="border-top-color: #1AA650;">
        <div class="box-header with-border">
            <h3 class="box-title">update</h3>
        </div>

        <form action="{{ route('admin.forms.put', $forms->id) }}" method="POST">
            <div class="row">
                <!-- column 1 -->
                <div class="col-md-6">
                    <!-- Naam -->
                    <div class="form-group">
                        <label class="form-text">Naam: *</label>
                        <input type="text" name="name" class="form-control" value="{{ $forms->name }}" placeholder="Naam.." required />
                    </div>
                    <!-- Icoon -->
                    <div class="form-group">
                        <label class="form-text">Icoon: * (Hele font awesome link)</label>
                        <input type="text" name="icon" class="form-control" value="{{ $forms->icon }}" placeholder="Icoon.." required />
                    </div>
                    <!-- Email bevestiging -->
                    <div class="form-group">
                        <label class="form-text">Email bevestiging: *</label>
                        <select class="form-control" id="confirm-email" name="confirm_email">
                            <option value="0" @if($forms->confirm_email == 0) seleced @endif>Nee</option>
                            <option value="1" @if($forms->confirm_email == 1) seleced @endif>Ja</option>
                        </select>
                    </div>

                    <?php 
                        $array = [];
                        $array = explode(';', $forms->value);
                    ?>

                    <!-- Emal gebeuren -->
                    <div id="email-group">
                        <!--  email -->
                        <div class="form-group">
                            <label class="form-text">Email adres: </label>
                            <input type="email" name="email[email]" class="form-control" value="{{ $array[0] ?? '' }}" placeholder="Email adres.." />
                        </div>
                        <!-- ApiToken -->
                        <div class="form-group">
                            <label class="form-text">Api Token: </label>
                            <input type="text" name="email[token]" class="form-control" value="{{ $array[1] ?? '' }}" placeholder="Api token.." />
                        </div>
                        <!-- Subject -->
                        <div class="form-group">
                            <label class="form-text">Subject: </label>
                            <input type="text" name="email[subject]" class="form-control" value="{{ $array[2] ?? '' }}" placeholder="Subject.." />
                        </div>
                        <!-- Text -->
                        <div class="form-group">
                            <label class="form-text">Text: </label>
                            <input type="text" name="email[text]" class="form-control" value="{{ $array[3] ?? '' }}" placeholder="Subject.." />
                        </div>
                    </div>
                </div>
                <!-- Column 2 -->
                <div class="col-md-6">
                    <!-- Omschrijving -->
                    <div class="form-group">
                        <label class="form-text">Omschrijving: *</label>
                        <textarea name="description" class="form-control" rows="5" required>{{ $forms->description }}</textarea>
                    </div>
                    <!-- Betaal mogelijkheid -->
                    <div class="form-group">
                        <label class="form-text">Betaal mogelijkheid: *</label>
                        <select name="use_payment" id="use-payment" class="form-control">
                            <option value="0" selected>Nee</option>
                            <option value="1">Ja</option>
                        </select>
                    </div>

                    <!-- payment box -->
                    <div id="payment-group">
                        <!-- Rekening nummer -->
                        <div class="form-group">
                            <label class="form-text">Rekening nummer: </label>
                            <input type="text" name="payment[rekening]" class="form-control" placeholder="Rekening nummer.." />
                        </div>
                        <!-- KVK nummer -->
                        <div class="form-group">
                            <label class="form-text">KVK nummer: </label>
                            <input type="number" name="payment[kvk]" class="form-control" placeholder="KVK nummer.." />
                        </div>
                    </div>

                    <br />
                    <br />

                    <!-- Opslaan knop -->
                    <div class="form-group">
                        @csrf
                        <input type="submit" name="submit" class="btn btn-success pull-right" value="Formulieren updaten" />
                    </div>
                </div>
            </div>
        </form>
        
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    // head variables
    let mail_box = document.getElementById('confirm-email');
    let payment_box = document.getElementById('use-payment');

    // change variables 
    let email = document.getElementById('email-group');
    let payment = document.getElementById('payment-group');

    // Functie voor het veranderen van de waarde van de selectbox 
    mail_box.onchange = function() {
        if (this.value == 1) {
            email.style.display = "block";
            for(let i =0;i < email.children.length; i++) {
                email.children[i].children[1].disabled = false;
            }
        } else if (this.value == 0) {
            email.style.display = "none";
            for (let i = 0;i < email.children.length;i++) {
                email.children[i].children[1].disabled = true;
            }
        }
    }

    // functie voor het veranderen van waarde van de selectbox
    payment_box.onchange = function() {
        if (this.value == 1) {
            payment.style.display = "block";
            for (let i = 0;i < payment.children.length;i++) {
                payment.children[i].children[1].disabled = false;
            }
        } else if (this.value == 0) {
            payment.style.display = "none";
            for (let i = 0;i < payment.children.length;i++) {
                payment.children[i].children[1].disabled = true;
            }
        }
    }

    if (mail_box.value == 1) {
        email.style.display = "block";
        for(let i =0;i < email.children.length; i++) {
            email.children[i].children[1].disabled = false;    
        }
    } else if (mail_box.value == 0) {
        email.style.display = "none";
        for(let i =0;i < email.children.length; i++) {
            email.children[i].children[1].disabled = true;
        }
    }
    if (payment_box.value == 1) {
        payment.style.display = "block";
        for (let i = 0;i < payment.children.length;i++) {
            payment.children[i].children[1].disabled = false;
        }
    } else if (payment_box.value == 0) {
        payment.style.display = "none";
        for (let i = 0;i < payment.children.length;i++) {
            payment.children[i].children[1].disabled = true;
        }
    }
</script>

@endsection