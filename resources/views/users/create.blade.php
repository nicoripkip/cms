@extends('layouts.master')
@section('title', 'Gebruikers - Create')
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Gebruikers
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="{{ route('admin.user.index') }}">Gebruikers</a></li>
        <li><a href="{{ route('admin.user.create') }}">Gebruikers aanmaken</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="box box-primary" style="border-top-color: #1AA650;">
        <div class="box-header with-border">
            <h3 class="box-title">Gebruikers aanmaken</h3>
        </div>
        
        <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group form-image">
                            <input type="file" id="file_id" name="image" style="display: none;" />
                            <button onclick="return false" id="button_id" class="create-input-image">
                                <i id="imgIcon" class="fas fa-plus-square"></i>
                                <img id="imgPrev" width="100%" height="100%" style="display: none" />
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Gebruikersnaam -->
                        <div class="form-group">
                            <label class="form-text">Gebruikersnaam *</label>
                            <input type="text" name="username" class="form-control" placeholder="Gebruikersnaam.." required />
                        </div>
                        <!-- Email adres -->
                        <div class="form-group">
                            <label class="form-text">Email adres *</label>
                            <input type="email" name="email" class="form-control" placeholder="Email adres.." required />    
                        <div>
                        <!-- Rechten -->
                        <div class="form-group">
                            <label class="form-text">Rechten *</label>
                            <select class="form-control" name="role">
                                @foreach($users as $role)
                                    <option value={{ $role->role->id }}>{{ $role->role->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Wachtwoord -->
                        <div class="form-group">
                            <label class="form-text">Wachtwoord *</label>
                            <input type="password" name="password" class="form-control" placeholder="Wachtwoord.." required />
                        </div>
                        <!-- Wachtwoord herhalen -->
                        <div class="form-group">
                            <label class="form-text">Wachtwoord herhalen *</label>
                            <input type="password" name="password_sec" class="form-control" placeholder="Wachtwoord herhalen.." required />
                        </div>
                        <!-- Submit knop -->
                        <div class="form-group">
                            @csrf
                            <input type="submit" name="submit" class="btn btn-success" value="Gebruiker aanmaken" />
                        </div>
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

document.getElementById('button_id').addEventListener('click', getFile);
document.getElementById('button_id').onsubmit = function() {
    return false;
};

function getFile() {
    document.getElementById('file_id').click();
}

 /**
     * Functie om live afbeeldingen op de  
     * Voorkant van de website te kunnen bekijken
     */
     function readImgURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#imgPrev').attr('src', e.target.result);
            }

            document.getElementById('imgIcon').style.display = "none";
            document.getElementById('imgPrev').style.display = "block";

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#file_id").change(function () {
        readImgURL(this);
    });
</script>

@endsection
