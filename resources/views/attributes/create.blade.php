@extends('layouts.master')
@section('title', 'Attributes | create')
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Attributes
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="{{ route('admin.attribute.index') }}">Attributen</a></li>
      <li><a href="{{ route('admin.attribute.create') }}">Attributen aanmaken</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="box box-primary" style="border-top-color: #1AA650;">
        <div class="box-header with-border">
            <h3 class="box-title">Attributes</h3>
        </div>

        <form action="{{ route('admin.attribute.store') }}" method="POST">
            <div class="row">
                <div class="col-md-6" >
                    <div class="form-group">
                        <label class="form-text">Naam:</label>
                        <input type="text" name="name" class="form-control" placeholder="Naam.." />
                    </div>

                    <div class="form-group">
                          <label class="form-text">Groep:</label>
                          <select name="group" class="form-control">
                            <option value="main">Main</option>
                                <option value="header">Header</option>
                                <option value="body">Body</option>
                                <option value="footer">Footer</option>
                            </select>
                    </div>

                    <div id="attribute-value" class="attribute-value" style="display: none;">
                      <div id="value-input" class="form-group">
                              <label class="form-text">Field 1</label>
                              <input type="text" name="value[1]" class="form-control" placeholder="Field.." />
                              <br />
                      </div>

                      <button onclick="addFields();return false;" class="btn btn-primary"><i class="fas fa-plus-square"></i></button>
                      <button onclick="removeFields();return false;" class="btn btn-primary"><i class="fas fa-minus-square"></i></button>
                  </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-text">Verplicht:</label>
                        <select name="required" class="form-control">
                            <option value=1>Ja</option>
                            <option value=0 selected>Nee</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-text">Type:</label>
                        <select id="select-attribute" name="type" class="form-control">
                            <option value="text">Text</option>
                            <option value="number">Getal</option>
                            <option value="valuta">Valuta</option>
                            <option value="image">Afbeelding</option>
                            <option value="radio">Radio</option>
                            <option value="select">Select</option>
                            <option value="textarea">Textbox</option>
                            <option value="password">Wachtwoord</option>
                            <option value="email">Email</option>
                            <option value="time">Tijd</option>
                            <option value="date">Date</option>
                        </select>
                    </div>

                    <div class="form-group">
                        @csrf
                        <input type="submit" name="submit" class="btn btn-success pull-right" value="Attribute opslaan" />
                    </div>
                </div>
            </div>
        </form>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
  var attribute_form = document.getElementById('attribute-value');
  var attribute_select = document.getElementById('select-attribute');
  var counter = 1;

  if (attribute_select.value == 'select') {
      attribute_form.style.display = "block";
  } else if (attribute_form.value == 'radio') {
      attribute_form.style.display = 'block';
  } else {
      attribute_form.style.display = 'none';
  }

  attribute_select.onchange = function() {
    if (attribute_select.value == 'select') {
      attribute_form.style.display = "block";
    } else if (attribute_select.value == 'radio') {
      attribute_form.style.display = "block";
    } else {
      attribute_form.style.display = "none";
    }
  }

  function addFields() {
      counter += 1;

      let label = document.createElement('label');
      let field = document.createElement('input');
      let br = document.createElement('br');

      label.className = 'form-text';
      label.textContent = `Field ${counter}`;
      label.id = `label${counter}`;

      field.type = 'text';
      field.name = 'value['+counter+']';
      field.id = `select${counter}`;
      field.className = 'form-control';
      field.placeholder = 'Field..';

      br.id = `id${counter}`;

      document.getElementById('value-input').appendChild(label);
      document.getElementById('value-input').appendChild(field);
      document.getElementById('value-input').appendChild(br);
  }


  function removeFields() {
    if (document.getElementById(`label${counter}`) && document.getElementById(`select${counter}`)) {
      let label = document.getElementById(`label${counter}`);
      let field = document.getElementById(`select${counter}`);
      let br = document.getElementbyId(`id${counter}`);

      counter -= 1;

      document.getElementById('value-input').removeChild(field);
      document.getElementById('value-input').removeChild(label);
      document.getElementById('value-input').removeChild(br);
    }
    
    return false;
  }
</script>
@endsection