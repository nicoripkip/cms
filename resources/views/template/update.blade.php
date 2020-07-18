@extends('layouts.master')
@section('title', 'Templates | update')
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
        <li><a href="{{ route('admin.template.update', [$template->id]) }}">Templates updaten</a></li>
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
            <h3 class="box-title">Update</h3>
        </div>
        
        <form action="{{ route('admin.template.put', [$template->id]) }}" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <!-- Naam -->
                    <div class="form-group">
                        <label class="form-group">Naam:</label>
                        <input type="text" name="name" value="{{ $template->name }}" class="form-control" placeholder="Naam.." />
                    </div>
                    <!-- Blades -->
                    <div class="form-group">
                        <label class="form-group">Blade bestand:</label>
                        <select name="blade" class="form-control">
                            @foreach ($blades as $blade)
                                <option value="{{ $blade->getRelativePathname() }}" @if($template->blade == $blade->getRelativePathname()) selected @endif>{{ $blade->getRelativePathname() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <!-- Omschrijving-->
                    <div class="form-group">
                        <label class="form-group">Omschrijving:</label>
                        <input type="text" name="description" value="{{ $template->description }}" class="form-control" placeholder="Omschrijving.." />
                    </div>
                    <!-- Opslaan-->
                    <div class="form-group">
                        @csrf
                        <br>
                        <br>
                        <input type="submit" name="submit" class="btn btn-success pull-right" value="Template updaten" />
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