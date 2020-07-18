@extends('layouts.master')
@section('title', 'Pages | update')
{{-- @include('partials.meta'); --}}
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pages
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="{{ route('admin.page.index') }}"></i>Pagina's</a></li>
      <li><a href="{{ route('admin.page.update', [$page->id]) }}"></i>Pagina's updaten</a></li>
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
            <h3 class="box-title">Pages</h3>
        </div>
        
        <form action="{{ route('admin.page.put', [$page->id]) }}" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <!-- Naam -->
                    <div class="form-group">
                        <label class="form-text">Naam: *</label>
                        <input type="text" name="name" class="form-control" value="{{ $page->name }}" placeholder="Naam.." />
                    </div>
                    <!-- Slug -->
                    <div class="form-group">
                        <label class="form-text">Slug: *</label>
                        <input type="text" name="view" class="form-control" value="{{ $page->view }}" placeholder="Slug.." />
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Icoon -->
                    <div class="form-group">
                        <label class="form-text">Icoon: (Volledige fontawesome tag)</label>
                        <input type="text" name="icon" class="form-control" value="{{ $page->icon }}" placeholder="Icoon.." />
                    </div>
                    <!-- Template -->
                    <div class="form-group">
                      <label class="form-text">Template</label>
                      <select name="template" class="form-control">
                        @foreach($templates as $template)
                          <option value="{{ $template->id }}" @if($page->template_id == $template->id) selected @endif>{{ $template->name }}</option>
                        @endforeach
                      </select>
                  </div>
                    <!-- Submitknop -->
                    <div class="form-group">
                        @csrf
                        <input type="submit" name="submit" class="btn btn-success pull-right" value="Pagina updaten" />
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