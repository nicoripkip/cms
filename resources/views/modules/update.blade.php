@extends('layouts.master')
@section('title', 'Module | update')
{{-- @include('partials.meta'); --}}
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Modules
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="{{ route('admin.module.index') }}">Modules</a></li>
      <li><a href="{{ route('admin.module.update', $module->id) }}">Modules updaten</a></li>
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
        
        <form action="{{ route('admin.module.put', [$module->id]) }}" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <!-- Naam -->
                    <div class="form-group">
                        <label class="form-text">Naam: *</label>
                        <input type="text" name="name" class="form-control" value="{{ $module->name }}" required placeholder="Naam.." />
                    </div>
                    <!-- Slug -->
                    <div class="form-group">
                        <label class="form-text">Slug: *</label>
                        <input type="text" name="slug" class="form-control" value="{{ $module->slug }}" required placeholder="Slug.." />
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Icon -->
                    <div class="form-group">
                        <label class="form-text">Icon: * (Volledige font-awesome link)</label>
                        <input type="text" name="icon" class="form-control" value="{{ $module->icon }}" required placeholder="Icon.." />
                    </div>
                    <!-- button -->
                    <div class="form-group">
                        @csrf
                        <input type="submit" name="submit" class="btn btn-success pull-right" value="Module updaten" />
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