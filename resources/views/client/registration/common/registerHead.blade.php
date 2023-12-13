<div class="row">
    <div class="col-md-8">
        <h2 id="heading">Register For An Account in NSB FM</h2>
        <p>Fill all form field to go to next step</p>
    </div>
    <div class="col-md-4">
        <div class="pull-right inner-logo">
            <img src="{{ asset('storage/images/fmc.jpg') }}" width="100%">
        </div>
    </div>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div><br />
@endif
