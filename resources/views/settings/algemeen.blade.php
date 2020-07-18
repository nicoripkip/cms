@extends('layouts.master')
@section('title', 'Settings - Algemeen')
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Algemeen
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    
          <!-- Main content -->
  <section class="content">
    
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="box box-primary" style="border-top-color: #1AA650;">
        <div class="box-header with-border">
            <h3 class="box-title">Instellingen</h3>
        </div>
        
        <form action="{{ route('admin.setting.put', ['algemeen']) }}" method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="col-lg-12">
                <!-- CMS Naam -->
                <div class="form-group">
                  <label class="form-text">CMS naam</label>
                  <input type="text" name="settings[cms_naam]" class="form-control" @if(isset($settings['cms_naam'])) value="{{ $settings['cms_naam'] }}" @endif placeholder="CMS naam.." />
                </div>
                <!-- Author name  -->
                <div class="form-group">
                  <label class="form-text">Autheur naam</label>
                  <input type="text" name="settings[autheur_naam]" class="form-control" @if(isset($settings['autheur_naam'])) value="{{ $settings['autheur_naam'] }}" @endif placeholder="Autheur naam.." />
                </div>
                <!-- Bedrijfs naam -->
                <div class="form-group">
                  <label class="form-text">Bedrijfsnaam</label>
                  <input type="text" name="settings[bedrijfs_naam]" class="form-control" @if(isset($settings['bedrijfs_naam'])) value="{{ $settings['bedrijfs_naam'] }}" @endif placeholder="Bedrijfsnaam.." />
                </div>  
              </div>
            </div>
            
            <div class="row">
              <!-- Menu kleuren -->
              <div class="col-md-4" style="text-align: center">
                <div class="form-group">
                  <label class="form-text">menu kleuren</label>
                  <input type="color" name="settings[menu_kleur]" @if(isset($settings['menu_kleur'])) value="{{ $settings['menu_kleur'] }}" @endif class="form-control" />
                </div>
              </div>
              <!-- tag kleuren -->
              <div class="col-md-4" style="text-align: center">
                <div class="form-group">
                  <label class="form-text">Tag kleuren</label>
                  <input type="color" name="settings[tag_kleur]" @if(isset($settings['tag_kleur'])) value="{{ $settings['tag_kleur'] }}" @endif class="form-control" />
                </div>
              </div>
              <!-- Kaart kleuren -->
              <div class="col-md-4" style="text-align: center">
                <div class="form-group">
                  <label class="form-text">Kaart kleuren</label>
                  <input type="color" name="settings[kaart_kleur]" @if(isset($settings['kaart_kleur'])) value="{{ $settings['kaart_kleur'] }}" @endif class="form-control" />
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Login picture -->
              <div class="col-md-4" style="text-align: center">
                <label class="form-text">Login afbeelding</label>
                <div class="form-group form-image">
                  <input type="file" id="file_id" class="file_id" value="1" name="settings[login_image]" style="display: none;" />
                  <button onclick="return false" id="button_id" class="create-input-image button_id">
                      <i id="imgIcon" class="fas fa-plus-square imgIcon"></i>
                      <img id="imgPrev" @if(isset($settings['login_image'])) src="{{ asset($settings['login_image']) }}" @endif class="imgPrev" width="100%" height="100%" style="display: none" />
                  </button>
              </div>
              </div>
              <!-- Sidebar picture -->
              <div class="col-md-4" style="text-align: center">
                <label class="form-text">Menu afbeelding</label>
                <div class="form-group form-image">
                  <input type="file" id="file_id" class="file_id" value="2" name="settings[side_image]" style="display: none;" />
                  <button onclick="return false" id="button_id" class="create-input-image button_id">
                      <i id="imgIcon" class="fas fa-plus-square imgIcon"></i>
                      <img id="imgPrev" @if(isset($settings['side_image'])) src="{{ asset($settings['side_image']) }}" @endif class="imgPrev" width="100%" height="100%" style="display: none" />
                  </button>
              </div>
              </div>
              <!-- app Logo -->
              <div class="col-md-4" style="text-align: center">
                <label class="form-text">Applicatie logo</label>
                <div class="form-group form-image">
                  <input type="file" id="file_id" class="file_id" value="3" name="settings[app_image]" style="display: none;" />
                  <button onclick="return false" id="button_id" class="create-input-image button_id">
                      <i id="imgIcon" class="fas fa-plus-square imgIcon"></i>
                      <img id="imgPrev" @if(isset($settings['app_image'])) src="{{ asset($settings['app_image']) }}" @endif class="imgPrev" width="100%" height="100%" style="display: none" />
                  </button>
              </div>
              </div>
            </div>

            <div class="form-group">
              @csrf
              <input type="submit" name="submit" class="btn btn-custom btn-success" value="Instellingen opslaan" />
            </div>
        </form>
        
    </div>

  </section>
  <!-- /.content -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>

  $('.button_id').bind('click', getFile);
  $('.button_id').submit(function() {
    return false;
  });

  
  function getFile() {
      $(this).prev().click();
  }
  
   /**
       * Functie om live afbeeldingen op de  
       * Voorkant van de website te kunnen bekijken
       */
       function readImgURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
  
              reader.onload = function(e) {
                $(input).next().children('.imgPrev').attr('src', e.target.result);
              }
  
              $(input).next().children('.imgIcon').hide();
              $(input).next().children('.imgPrev').show();
  
              reader.readAsDataURL(input.files[0]);
          }
      }
  
      $(".button_id").prev().change(function () {
          readImgURL(this);
      });

      if ($('.imgPrev').val() !== null) {
        $(this).show();
        $(this).next().hide();
      }
  </script>
@endsection