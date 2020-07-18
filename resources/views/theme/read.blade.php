@extends('layouts.master')
@section('title', 'Theme - Read')
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Thema's
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="{{ route('admin.theme.index') }}"><i class="fa fa-dashboard"></i>Thema's</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="theme-wrapper">
    
      @foreach($themes as $theme)
          <div class="theme-card" onclick="selectTheme()">
            <img src="#" class="theme-card-image" width="300px" height="220px" />
            <h1 class="theme-card-h1">{{ $theme->name }}</h1>
            <div class="theme-card-hover-wrapper">
              <div class="theme-card-hover">
                <a class="theme-card-button" href="#" style="background-color: {{ $algemeen['kaart_kleur'] }}">Selecteren</a>
                <a class="theme-card-button" href="{{ route('admin.theme.detail', [$theme->id]) }}" style="background-color: {{ $algemeen['kaart_kleur'] }}">Details</a>
                <a class="theme-card-button" href="{{ route('admin.theme.delete', [$theme->id]) }}" onclick="event.preventDefault();sure();document.getElementById('delete-form').submit();" style="background-color: {{ $algemeen['kaart_kleur'] }}">Verwijderen</a>
              </div>
            </div>
          </div>
          
      @endforeach
      
      <div class="theme-card">
        <div class="theme-card-wrapper">
          <a href="{{ route('admin.theme.create') }}"><i class="fas fa-plus-square theme-card-icon"></i></a>
        </div>
      </div>

    </div>

    <form id="delete-form" method="post" action="{{ route('admin.theme.delete', [$theme->id ?? '']) }}" style="display:none;">
      @csrf
    </form>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    function selectTheme() {
        ///
    }

    function sure() {
      return confirm("Weet je het zeker dat je het thema wilt verwijderen!");
    }
</script>

@endsection