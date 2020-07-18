@php
    use App\FormsAttributesModel;
    use App\FormsModel;
 
    $form = FormsModel::where('name', $name)->get()->first();
    $form_data = FormsAttributesModel::where('form_id', $form->id)->where('active', 1)->get();
@endphp

<div class="row">
    @if (count($form_data) > 0)
        @foreach ($form_data as $value)
            @include('partials.fields.'.$value->Attributes->type.'_field')
        @endforeach
        @else 
            <h3 style="text-align: center;">Geen attributen gevonden</h3>
    @endif

    <div class="col-md-12"><br /></div>
    <div class="col-md-12"><br /></div>
    <div class="col-md-12" style="text-align: left;">
        <div class="form-group">
            @csrf
            <button class="btn" onclick="submitForm()">@if(isset($button)) {{ $button }} @else verstuur @endif</button>
        </div>
    </div>
</div>

<script src="https://smtpjs.com/v3/smtp.js"></script>
    <script>
        // functie voor het pushen van data naar de database
        function submitForm() {
            let inputs = document.getElementsByClassName('variable-field');

            var object_data = {'name': '{{ $name }}', '_token':'{{ csrf_token() }}'};
            for (let i = 0;i < inputs.length;i++) {
                object_data[inputs[i].parentElement.children[0].textContent.replace(/[\s&\/\\#,+()$~%.'":*?<>{}]/g, '')] = inputs[i].value;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'post',
                url: 'http://127.0.0.1:8000/ajax/post/createMailResult',
                dataType: 'json',
                data:  object_data,
                success: function(data) {
                    document.getElementById('contact-form').style.display = "none";
                    document.getElementById('form-succeed').style.display = "block";
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(xhr.responseText);
                    alert(thrownError);
                },
            });

            return false;
        }
    </script>