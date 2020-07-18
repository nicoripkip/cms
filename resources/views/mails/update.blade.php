@extends('layouts.master')
@section('title', 'Mail | update')
{{-- @include('partials.meta'); --}}
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Mails
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li><a href="{{ route('admin.mails.index') }}">Mails</a></li>
        <li><a href="{{ route('admin.mails.update', [$mail->id]) }}">Mails updaten</a></li>
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

        <form action="{{ route('admin.mails.put', [$mail->id]) }}" method="POST">
            <div class="row">
                <!-- Column 1 -->
                <div class="col-md-6">
                    <!-- Naam -->
                    <div class="form-group">
                        <label class="form-text">Naam: *</label>
                        <input type="text" name="name" class="form-control" value="{{ $mail->name }}" placeholder="Naam.." required />
                    </div>
                    <!-- Type mail -->
                    <div class="form-group">
                        <label class="form-text">Type: *</label>
                        <select name="type_id" class="form-control" required>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" @if($type->id == $mail->type_id) selected @endif>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- forms -->
                    <div class="form-group">
                        <label class="form-text">Formulier: *</label>
                        <select name="forms_id" class="form-control" required>
                            @foreach ($forms as $form)
                                <option value="{{ $form->id }}" @if($form->id == $mail->forms_id) selected @endif>{{ $form->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Column 2 -->
                <div class="col-md-6">
                    <!-- Omschrijving -->
                    <div class="form-group">
                        <label class="form-text">Omschrijving: </label>
                        <textarea class="form-control" name="description" rows="5">{{ $mail->description }}</textarea>
                    </div>

                    <br />
                    <br />

                    <!-- Opslaan knop -->
                    <div class="form-group pull-right">
                        @csrf
                        <input type="submit" name="submit" class="btn btn-success" value="Updaten" />
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