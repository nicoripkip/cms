@extends('layouts.master')
@section('title', 'Themes | detail')
{{-- @include('partials.meta'); --}}
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Themes
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="{{ route('admin.theme.index') }}">Thema's</a></li>
        <li><a href="{{ route('admin.theme.detail', [$theme->id]) }}">Thema's bekijken</a></li>
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
            <h3 class="box-title">Detail</h3>
        </div>
        
        <div class="row">
            <!-- Column 1 -->
            <div class="col-md-6">
                <!-- Naam -->
                <div class="form-group">
                    <h3>Naam: </h3>
                </div>
                <!-- Omschrijving -->
                <div class="form-group">
                    <h3>Omschrijving: </h3>
                </div>
                <!-- Autheur -->
                <div class="form-group">
                    <h3>Autheur: </h3>
                </div>
                <!-- Bedrijf -->
                <div class="form-group">
                    <h3>Bedrijf: </h3>
                </div>
                <!-- Licentie -->
                <div class="form-group">
                    <h3>Licentie: </h3>
                </div>
            </div>
            <!-- Column 2 -->
            <div class="col-md-6">
                <!-- Naam -->
                <div class="form-group">
                    <h3>{{ $theme->name }}</h3>
                </div>
                <!-- Omschrijving -->
                <div class="form-group">
                    <h3>{{ $theme->description }}</h3>
                </div>
                <!-- Autheur -->
                <div class="form-group">
                    <h3>{{ $theme->author }}</h3>
                </div>
                <!-- Bedrijf -->
                <div class="form-group">
                    <h3>{{ $theme->company }}</h3>
                </div>
                <!-- Licentie -->
                <div class="form-group">
                    <h3>{{ $theme->lisence }}</h3>
                </div>
            </div>
        </div>

    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection