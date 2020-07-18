@extends('layouts.master')
@section('title', 'Templates | create')
{{-- @include('partials.meta'); --}}
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Templates
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="{{ route('admin.template.index') }}">Templates</a></li>
        <li><a href="{{ route('admin.template.create') }}">Templates aanmaken</a></li>
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
        
        <form action="{{ route('admin.template.store') }}" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <!-- Naam -->
                    <div class="form-group">
                        <label class="form-group">Naam:</label>
                        <input type="text" name="name" class="form-control" placeholder="Naam.." />
                    </div>
                    <!-- Blades -->
                    <div class="form-group">
                        <label class="form-group">Blade bestand:</label>
                        <select name="blade" class="form-control">
                            @foreach ($blades as $blade)
                                <option value="{{ $blade->getRelativePathname() }}">{{ $blade->getRelativePathname() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <!-- Omschrijving-->
                    <div class="form-group">
                        <label class="form-group">Omschrijving:</label>
                        <input type="text" name="description" class="form-control" placeholder="Omschrijving.." />
                    </div>
                    <!-- Opslaan-->
                    <div class="form-group">
                        @csrf
                        <br>
                        <br>
                        <input type="submit" name="submit" class="btn btn-success pull-right" value="Template opslaan" />
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