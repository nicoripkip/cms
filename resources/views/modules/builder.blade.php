@extends('layouts.master')
@section('title', 'Module | builder')
{{-- @include('partials.meta'); --}}
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Module
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="{{ route('admin.module.index') }}">Modules</a></li>
        <li><a href="{{ route('admin.module.builder', $module->id) }}">Module builder</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <form action="{{ route('admin.module.save', $module->id) }}" method="POST">
        <div class="box box-primary" style="border-top-color: #1AA650;">
            <div class="box-header with-border">
                <h3 class="box-title">Main</h3>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="el-active" id="active_main" style="float: left; width: 100%;">
                        @foreach($active_main as $key => $value)
                            <div class="item_card">
                                <h3>{{ $value->Attributes->name }}</h3>
                                <select id="select_main" name="module_main[{{ $value->Attributes->name }}][bootstrap]" class="item-select">
                                    <option value="col-md-2" @if($value->bootstrap == "col-md-2") selected @endif>col-md-2</option>
                                    <option value="col-md-4" @if($value->bootstrap == "col-md-4") selected @endif>col-md-4</option>
                                    <option value="col-md-6" @if($value->bootstrap == "col-md-6") selected @endif>col-md-6</option>
                                    <option value="col-md-8" @if($value->bootstrap == "col-md-8") selected @endif>col-md-8</option>
                                    <option value="col-md-10" @if($value->bootstrap == "col-md-10") selected @endif>col-md-10</option>
                                    <option value="col-md-12" @if($value->bootstrap == "col-md-12") selected @endif>col-md-12</option>
                                </select>
                                <input type="hidden" name="module_main[{{ $value->Attributes->name }}][attribute_id]" value="{{ $value->attribute_id }}" />
                                <input type="hidden" name="module_main[{{ $value->Attributes->name }}][order]" value="{{ $value->order }}" />
                                <input type="hidden" name="module_main[{{ $value->Attributes->name }}][active]" value="{{ $value->active }}" />
                                <input type="hidden" name="module_main[{{ $value->Attributes->name }}][used]" value="{{ $value->Attributes->used }}" />
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="el-inactive" id="inactive_main">
                        @foreach($attributes_main as $key => $value)
                            <div class="item_card">
                                <h3>{{ $value->name }}</h3>
                                    <select name="module_main[{{ $value->name }}][bootstrap]" class="item-select">
                                    <option value="col-md-2">col-md-2</option>
                                    <option value="col-md-4" selected>col-md-4</option>
                                    <option value="col-md-6">col-md-6</option>
                                    <option value="col-md-8">col-md-8</option>
                                    <option value="col-md-10">col-md-10</option>
                                    <option value="col-md-12">col-md-12</option>
                                </select>
                                <input type="hidden" name="module_main[{{ $value->name }}][attribute_id]" value="{{ $value->id }}" />
                                <input type="hidden" name="module_main[{{ $value->name }}][order]" value="0" />
                                <input type="hidden" name="module_main[{{ $value->name }}][active]" value="0" />
                                <input type="hidden" name="module_main[{{ $value->name }}][used]" value="0" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        

        <div class="box box-primary" style="border-top-color: #1AA650;">
            <div class="box-header with-border">
                <h3 class="box-title">Body</h3>
            </div>
        
            <div class="row">
                <div class="col-md-6">
                    <div class="el-active" id="active_body">
                        @foreach($active_body as $key => $value)
                            <div class="item_card">
                                <h3>{{ $value->Attributes->name }}</h3>
                                <select id="select_body" name="module_body[{{ $value->Attributes->name }}][bootstrap]" class="item-select">
                                    <option value="col-md-2" @if($value->bootstrap == "col-md-2") selected @endif>col-md-2</option>
                                    <option value="col-md-4" @if($value->bootstrap == "col-md-4") selected @endif>col-md-4</option>
                                    <option value="col-md-6" @if($value->bootstrap == "col-md-6") selected @endif>col-md-6</option>
                                    <option value="col-md-8" @if($value->bootstrap == "col-md-8") selected @endif>col-md-8</option>
                                    <option value="col-md-10" @if($value->bootstrap == "col-md-10") selected @endif>col-md-10</option>
                                    <option value="col-md-12" @if($value->bootstrap == "col-md-12") selected @endif>col-md-12</option>
                                </select>
                                <input type="hidden" name="module_body[{{ $value->Attributes->name }}][attribute_id]" value="{{ $value->attribute_id }}" />
                                <input type="hidden" name="module_body[{{ $value->Attributes->name }}][order]" value="{{ $value->order }}" />
                                <input type="hidden" name="module_body[{{ $value->Attributes->name }}][active]" value="{{ $value->active }}" />
                                <input type="hidden" name="module_body[{{ $value->Attributes->name }}][used]" value="{{ $value->Attributes->used }}" />
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="el-inactive" id="inactive_body">
                        @foreach($attributes_body as $key => $value)
                            <div class="item_card">
                                <h3>{{ $value->name }}</h3>
                                <select name="module_body[{{ $value->name }}][bootstrap]" class="item-select">
                                    <option value="col-md-2">col-md-2</option>
                                    <option value="col-md-4" selected>col-md-4</option>
                                    <option value="col-md-6">col-md-6</option>
                                    <option value="col-md-8">col-md-8</option>
                                    <option value="col-md-10">col-md-10</option>
                                    <option value="col-md-12">col-md-12</option>
                                </select>
                                <input type="hidden" name="module_body[{{ $value->name }}][attribute_id]" value="{{ $value->id }}" />
                                <input type="hidden" name="module_body[{{ $value->name }}][order]" value="0" />
                                <input type="hidden" name="module_body[{{ $value->name }}][active]" value="0" />
                                <input type="hidden" name="module_body[{{ $value->name }}][used]" value="0" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

       
                    <br>
                    <div class="form-group">
                        @csrf
                        <input type="submit" name="submit" class="btn btn-success pull-right" value="Template opslaan" />
                    </div>
                </div>
            </div>
        </div>
    </form>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script src='{{ asset('js/dragula/dist/dragula.min.js') }}'></script>
<script>
    var drake_main = dragula([document.getElementById('active_main'), document.getElementById('inactive_main')]);
    drake_main.on('drop', function(el, target, source, sibling) {
        if (target == document.getElementById('active_main')) {
            el.children[4].value = 1;
            el.children[5].value = 1;

            for (let i = 0; i < target.children.length; i++) {
                target.children[i].children[3].value = i+1;
            }
        } else {
            el.children[4].value = 0;
            el.children[5].value = 0;
        }
    });

    var drake_body = dragula([document.getElementById('active_body'), document.getElementById('inactive_body')]);
    drake_body.on('drop', function(el, target, source, sibling) {
        if (target == document.getElementById('active_body')) {
            el.children[4].value = 1;
            el.children[5].value = 1;

            for (let i = 0; i < target.children.length; i++) {
                target.children[i].children[3].value = i+1;
            }
        } else {
            el.children[4].value = 0;
            el.children[5].value = 0;
        }
    });

    $('.item-select').change(function() {
        if ($(this).val() == 'col-md-2') {
            $(this).parent().css('width', '15.25%');
        } else if ($(this).val() == 'col-md-4') {
            $(this).parent().css('width', '30.5%');
        } else if ($(this).val() == 'col-md-6') {
            $(this).parent().css('width', '45.75%');
        } else if ($(this).val() == 'col-md-8') {
            $(this).parent().css('width', '61%');
        } else if ($(this).val() == 'col-md-10') {
            $(this).parent().css('width', '76.25%');
        } else if ($(this).val() == 'col-md-12') {
            $(this).parent().css('width', '91.50%');
        }
    });

    var item = document.getElementsByClassName('item-select');

    for (let i= 0; i < item.length; i++ ){
       if (item[i].value == 'col-md-2') {
            item[i].parentElement.style.width = '15.25%';
       } else if (item[i].value == 'col-md-4') {
            item[i].parentElement.style.width = '30.5%';
       } else if (item[i].value == 'col-md-6') {
            item[i].parentElement.style.width = '45.75%';
       } else if (item[i].value == 'col-md-8') {
            item[i].parentElement.style.width = '61%';
       } else if (item[i].value == 'col-md-10') {
            item[i].parentElement.style.width = '76.25%';
       } else if (item[i].value == 'col-md-12') {
            item[i].parentElement.style.width = '91.50%';
       }
    }
</script>

@endsection