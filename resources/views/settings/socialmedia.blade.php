@extends('layouts.master')
@section('title', 'Settings - Social Media')
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Social Media
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
        
        <form action="{{ route('admin.setting.put', ['socialmedia']) }}" method="POST">
            <!-- Facebook -->
            <div class="form-group">
                <label class="form-text">Facebook url</label>
                <input type="text" name="settings[facebook]" class="form-control" @if(isset($media['facebook'])) value="{{ $media['facebook'] }}" @endif placeholder="Facebook url" />
            </div>
            <!-- Instagram -->
            <div class="form-group">
                <label class="form-text">Instagram url</label>
                <input type="text" name="settings[instagram]" class="form-control" @if(isset($media['instagram'])) value="{{ $media['instagram'] }}" @endif placeholder="Instagram url" />
            </div>
            <!-- Snapchat -->
            <div class="form-group">
                <label class="form-text">Snapchat url</label>
                <input type="text" name="settings[snapchat]" class="form-control" @if(isset($media['snapchat'])) value="{{ $media['snapchat'] }}" @endif placeholder="Snapchat url" />
            </div>
            <!-- Twitter -->
            <div class="form-group">
                <label class="form-text">Twitter url</label>
                <input type="text" name="settings[twitter]" class="form-control" @if(isset($media['twitter'])) value="{{ $media['twitter'] }}" @endif placeholder="Twitter url" />
            </div>
            <!-- Github -->
            <div class="form-group">
                <label class="form-text">Github url</label>
                <input type="text" name="settings[github]" class="form-control" @if(isset($media['github'])) value="{{ $media['github'] }}" @endif placeholder="Github url" />
            </div>
            <!-- Submit -->
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

@endsection