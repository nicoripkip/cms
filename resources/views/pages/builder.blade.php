@extends('layouts.master')
@section('title', 'Pages | builder')
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
        <li><a href="{{ route('admin.page.builder', [$page->id]) }}"></i>Pagina builder</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('admin.page.save', [$page->id]) }}" method="POST" enctype="multipart/form-data">
        <!-- main tag -->
        <div class="box box-primary" style="border-top-color: #1AA650;">
            <div class="box-header with-border">
                <h3 class="box-title">Main</h3>
            </div>
                
            <div class="row">
                @if (count($attributes_main) > 0)
                    @foreach($attributes_main as $value)
                        @include('partials.fields.'.$value->Attributes->type.'_field')
                    @endforeach
                @else 
                    <h3 style="text-align: center;">Helaas, geen attributen gevonden</h3>
                @endif
            </div>

        </div>

        <!-- header tag -->
        <div class="box box-primary" style="border-top-color: #1AA650;">
            <div class="box-header with-border">
                <h3 class="box-title">Header</h3>
            </div>
                
            <div class="row">
                @if (count($attributes_header) > 0)
                    @foreach($attributes_header as $value)
                        @include('partials.fields.'.$value->Attributes->type.'_field')
                    @endforeach
                @else 
                    <h3 style="text-align: center;">Geen attributen gevonden</h3>
                @endif
            </div>

        </div>
    
        <!-- body tag -->
        <div class="box box-primary" style="border-top-color: #1AA650;">
            <div class="box-header with-border">
                <h3 class="box-title">Body</h3>
            </div>
                
            <div class="row">
                @if (count($attributes_body) > 0)
                    @foreach($attributes_body as $value)
                        @include('partials.fields.'.$value->Attributes->type.'_field')
                    @endforeach
                @else 
                    <h3 style="text-align: center;">Geen attributen gevonden</h3>
                @endif
            </div>

        </div>

        <!-- footer tag -->
        <div class="box box-primary" style="border-top-color: #1AA650;">
            <div class="box-header with-border">
                <h3 class="box-title">Footer</h3>
            </div>
                
            <div class="row">
                @if (count($attributes_footer) > 0)
                    @foreach($attributes_footer as $value)
                        @include('partials.fields.'.$value->Attributes->type.'_field')
                    @endforeach    
                @else 
                    <h3 style="text-align: center;">Geen attributen gevonden</h3>
                @endif
            </div>

        </div>

        <!-- slug tag -->
        <div class="box box-primary" style="border-top-color: #1AA650;">
            <div class="box-header with-border">
                <h3 class="box-title">Slug</h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <!-- Slug titel -->
                    <div class="form-group">
                        <label class="form-text">Slug titel *  (max 255 characters)</label>
                        <input type="text" name="page[slug_titel]" class="form-control" value="{{ $page_data->slug_titel ?? '' }}" required placeholder="Slug titel.." />
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <!-- Slug verhaal -->
                    <div class="form-group">
                        <label class="form-text">Slug verhaal (max 255 characters)</label>
                        <textarea class="form-control" name="page[slug_story]" value="{{ $page_data->slug_story ?? '' }}"></textarea>
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <!-- slug url -->
                    <div class="form-group">
                        <label class="form-text">Slug url *  (max 255 characters)</label>
                        <input type="text" name="page[slug_url]" class="form-control" value="{{ $page_data->slug_url ?? '' }}" required placeholder="Slug url.." /> 
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>
                
            <div class="form-group">
                @csrf
                <input type="submit" name="submit" class="btn btn-succes" value="Pagina opslaan" />
            </div>
            
        </div>
    </form>

    

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    let input = document.getElementsByClassName('text_form');
    for (let x of input) {
        x.click(function() {
            console.log(x);
        });
    }

    $('.button_id').bind('click', getFile);
    function getFile() {
      $(this).prev().click();
  }

  function readImgURL(input) {
          if (input.files && input.files[0]) {
              var reader = new FileReader();
  
              reader.onload = function(e) {
                $(input).next().children('.imgPrev').attr('src', e.target.result);
              }
  
              $(input).next().children('.imgText').hide();
              $(input).next().children('.imgPrev').show();
  
              reader.readAsDataURL(input.files[0]);
          }
      }

      $(".button_id").prev().change(function () {
          readImgURL(this);
      });

      if ($('.imgPrev').val() !== null) {
        $(this).show();
        $(this).next().hide();
      }

</script>
@endsection