@extends('layouts.master')
@section('title', 'Mail | builder')
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
        <li><a href="{{ route('admin.mails.builder', [$mail->id]) }}">Mails builder</a></li>
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
            <h3 class="box-title">Builder</h3>
        </div>

        <form action="{{ route('admin.mails.save', [$mail->id]) }}" method="POST" enctype="multipart/form-data">
            <div class="row">
                <!-- Column 1 -->
                <div class="col-md-2">

                </div>
                <!-- Column 2 -->
                <div class="col-md-8">
                    <!-- Mail id -->
                    <div class="form-group">
                        <input type="hidden" name="mails_id" value="{{ $mail->id }}" />
                    </div>
                    <!-- Ontvanger email -->
                    <div class="form-group">
                        <label class="form-text">Ontvanger email: *</label>
                        <input type="text" name="reciever_email" class="form-control" value="{{ $data->to_email ?? '' }}" placeholder="Ontvanger email.." required />
                    </div>
                    <!-- Ontvanger name -->
                    <div class="form-group">
                        <label class="form-text">Ontvanger naam: *</label>
                        <input type="text" name="reciever_name" class="form-control" value="{{ $data->to_name ?? '' }}" placeholder="Ontvanger naam.." required />
                    </div>
                    <!-- Onderwerp -->
                    <div class="form-group">
                        <label class="form-text">Onderwerp: </label>
                        <input type="text" name="subject" class="form-control" value="{{ $data->subject ?? '' }}" placeholder="Onderwerp.." />
                    </div>
                    <!-- Body -->
                    <div class="form-group">
                        <label class="form-text">Body: *</label>
                        <textarea name="body" class="form-control" rows="15" required>{{ $data->body ?? '' }}"</textarea>
                    </div>
                    <!-- Bijvoegingen -->
                    <div class="form-group">
                        <label class="form-text">Bestanden: </label>
                        <input type="file" name="attachment" class="form-control" value="{{ asset($data->attachment ?? '') }}" />
                    </div>
                    <!-- Afzender naam -->
                    <div class="form-group">
                        <label class="form-text">Naam afzender: *</label>
                        <input type="text" name="sender_name" class="form-control" value="{{ $data->from_name ?? '' }}" placeholder="Naam afzender.." required />
                    </div>
                    <!-- Afzender email -->
                    <div class="form-group">
                        <label class="form-text">Email afzender: *</label>
                        <input type="text" name="sender_email" class="form-control" value="{{ $data->from_email ?? '' }}" placeholder="Email afzender.." required />
                    </div>

                    <br />  
                    <br />

                    <!-- Opslaan knop -->
                    <div class="form-group pull-right">
                        @csrf
                        <input type="submit" name="submit" class="btn btn-success" value="Opslaan" />
                    </div>
                </div>
                <!-- Column 3 -->
                <div class="col-md-2">

                </div>
            </div>
        </form>

    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection