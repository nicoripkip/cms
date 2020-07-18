@extends('layouts.master')
@section('title', 'Themes| create')
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
      <li><a href="{{ route('admin.theme.create') }}">Thema's aanmaken</a></li>
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
            <h3 class="box-title">Create</h3>
        </div>
        
        <form action="{{ route('admin.theme.store') }}" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <!-- Naam -->
                    <div class="form-group">
                        <label class="form-group">Naam:</label>
                        <input type="text" name="name" class="form-control" placeholder="Naam.." />
                    </div>
                    <!-- Autheur -->
                    <div class="form-group">
                        <label class="form-group">Autheur:</label>
                        <input type="text" name="author" class="form-control" placeholder="Autheur.." />
                    </div>
                    <!-- Lisencie -->
                    <div class="form-group">
                        <label class="form-group">Lisentie:</label>
                        <select name="lisence" class="form-control">
                            <option value="Academic Free License">Academic Free License</option>
                            <option value="Affero General Public License 3.0">Affero General Public License 3.0</option>
                            <option value="Apache License 1.X">Apache License 1.X</option>
                            <option value="Apache Lisence 2.0">Apache License 2.0</option>
                            <option value="Apple Public Source License 1.X">Apple Public Source License 1.X</option>
                            <option value="Apple Public Source License 2.0">Apple Public Source License 2.0</option>
                            <option value="IBM Public License">IBM Public License</option>
                            <option value="GNU Affero General Public License">GNU Affero General Public License</option>
                            <option value="GNU General Public License V2">GNU General Public License V2</option>
                            <option value="GNU General Public License V3">GNU General Public License V3</option>
                            <option value="GNU Lesser General Public License">GNU Lesser General Public License</option>
                            <option value="MIT">MIT</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <!-- Omschrijving-->
                    <div class="form-group">
                        <label class="form-group">Omschrijving:</label>
                        <input type="text" name="description" class="form-control" placeholder="Omschrijving.." />
                    </div>
                    <!-- Bedrijf -->
                    <div class="form-group">
                        <label class="form-group">Bedrijf:</label>
                        <input type="text" name="company" class="form-control" placeholder="Bedrijf.." />
                    </div>
                    <!-- selected -->
                    <div class="form-group">
                        <input type="hidden" name="selected" value="0" />
                    </div>
                    <!-- Opslaan-->
                    <div class="form-group">
                        @csrf
                        <br>
                        <br>
                        <input type="submit" name="submit" class="btn btn-success pull-right" value="Theme opslaan" />
                    </div>
                </div>
            </div>
        </form>

    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection