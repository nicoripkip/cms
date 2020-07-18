@extends('layouts.master')
@section('title', 'Menu | read')
{{-- @include('partials.meta'); --}}
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Menu
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="{{ route('admin.menu.index') }}">Menu</a></li>
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
            <h3 class="box-title">Menu</h3>
            <a class="btn btn-success pull-right" href="#" onclick="newMenu();">Nieuw</a>
        </div>
        
        <form action="{{ route('admin.menu.store') }}" method="POST">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <h1>Menu elementen</h1>
                    </div>
                    <div class="menu-group menu_inactive" id="menu_inactive">
                        <ul>
                            @foreach ($menu_inactive as $key => $value)
                                <div class="menu_card">
                                    <input class="form-control" type="text" name="name" value="{{ $value->name }}" placeholder="Titel.." />
                                    <input class="form-control" type="text" name="slug" value="{{ $value->slug }}" placeholder="Slug.." />
                                    <br />
                                    <select name="pages" class="form-control">
                                        @foreach($pages as $page)
                                            <option value="{{$page->id}}" @if($value->page_id == $page->id) selected @endif>{{ $page->name }}</option> 
                                        @endforeach
                                    </select>
                                    <select name="sub_menu" class="form-control">
                                        <option value="0">false</option>
                                        <option value="1">true</option>
                                    </select>
                                    <input type="hidden" name="active" value="{{ $value->active }}" class="active-input" />
                                    <input type="hidden" name="order" value="{{ $value->order }}" class="order-inputs" />
                                </div>
                            @endforeach
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="form-group">
                        <h1>Active elementen</h1>
                    </div>
                    <div class="menu-group" id="menu_active">
                        @foreach($menu_active as $key => $value)
                            <div class="menu_card">
                                <input class="form-control" type="text" name="menu[menu{{$key}}][name]" value="{{ $value->name }}" placeholder="Titel.." />
                                <input class="form-control" type="text" name="menu[menu{{$key}}][slug]" value="{{ $value->slug }}" placeholder="Slug.." />
                                <br />
                                <select name="menu[menu{{$key}}][pages]" class="form-control">
                                    @foreach($pages as $page)
                                        <option value="{{$page->id}}" @if($value->page_id == $page->id) selected @endif>{{ $page->name }}</option> 
                                    @endforeach
                                </select>
                                <select name="menu[menu{{$key}}][sub_menu]" class="form-control">
                                    <option value="0" @if($value->sub_menu == 0) selected @endif>false</option>
                                    <option value="1" @if($value->sub_menu == 1) selected @endif>true</option>
                                </select>
                                <input type="hidden" name="menu[menu{{$key}}][active]" value="{{ $value->active }}" class="active-input" />
                                <input type="hidden" name="menu[menu{{$key}}][order]" value="{{ $value->order }}" class="order-inputs" />
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        @csrf
                        <input type="submit" name="submit" class="btn btn-success pull-right" value="Opslaan" />     
                    </div>
                </div>
            </div>            
        </form>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script src='{{ asset('js/dragula/dist/dragula.min.js') }}'></script>
<script>
    var counter = 0;

    function newMenu() {
        counter = counter + 1;

        let newElement = document.createElement("div");
        let titleInput = createInputElement('form-control', 'text', 'name', 'Titel..');
        let slugInput = createInputElement('form-control', 'text', 'slug', 'Slug..');
        let newBr = document.createElement("br");
        let pagesInput = document.createElement("select");
        let trueFalseInput = document.createElement("select");
        let activeInput = document.createElement('input');
        let orderInput = document.createElement('input');

        pagesInput.name = "pages";
        pagesInput.className = "form-control";

        trueFalseInput.name = "sub_menu";
        trueFalseInput.className = "form-control";

        activeInput.type = "hidden";
        activeInput.name = "active";
        activeInput.value = 0;
        activeInput.className = "active-input";

        orderInput.type = "hidden";
        orderInput.name = "order";
        orderInput.value = 0;
        orderInput.className = "order-input";

        let henk = {!! $pages !!};
        henk.forEach((item, index) => {
            let optionElement = document.createElement("option");
            optionElement.value = item.id;
            optionElement.textContent = item.name;
            pagesInput.appendChild(optionElement);
        });

        var trueFalse = [{ value: 0, name: false, }, { value: 1, name: true, }];
        trueFalse.forEach((item, index) => {
            let optionElement = document.createElement("option");
            optionElement.value = item.value;
            optionElement.textContent = item.name;
            trueFalseInput.appendChild(optionElement);
        });

        newElement.className = "menu_card";
        newElement.id = "menu_card_" + counter;
        newElement.draggable = true;
        newElement.appendChild(titleInput);
        newElement.appendChild(slugInput);
        newElement.appendChild(newBr);
        newElement.appendChild(pagesInput);
        newElement.appendChild(trueFalseInput);
        newElement.appendChild(activeInput);
        newElement.appendChild(orderInput);

        document.getElementById("menu_inactive").appendChild(newElement); 
    }

    function createInputElement(classname, type, name, placeholder) {
        let element = document.createElement('input');
        element.className = classname;
        element.type = type;
        element.name = name;
        element.placeholder = placeholder;
        return element;
    }
 
    var nup;

    let el = document.getElementById('menu_in');
    
    var drake = dragula([document.getElementById('menu_inactive'), document.getElementById('menu_active')]);
    drake.on('drop', function(el, target, source, sibling) {
        if (target == document.getElementById('menu_active')) {
            el.children[5].value = 1;
            var test = el.id;
            for (let i = 0; i < target.children.length; i++) {
                target.children[i].children[6].value = i+1;

                // set all names
                console.log(target.children[i].children);
                target.children[i].children[0].name = `menu[menu${i}][name]`;
                target.children[i].children[1].name = `menu[menu${i}][slug]`;
                target.children[i].children[3].name = `menu[menu${i}][pages]`;
                target.children[i].children[4].name = `menu[menu${i}][sub_menu]`;
                target.children[i].children[5].name = `menu[menu${i}][active]`;
                target.children[i].children[6].name = `menu[menu${i}][order]`;
            }      
        } else {
            el.children[5].value = 0;
        }
    });
</script>

@endsection