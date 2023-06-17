@extends('layouts.client')
@section('content')
<div class="col-md-10 content">
  	<div class="panel panel-default">
	<div class="panel-heading">
		<h2>Change Password</h2>
	</div>
    @if(Session::has('message'))
    <div class="alert alert-success">
        {{Session::get('message')}}
    </div>
    @endif
	<div class="panel-body">
        <form method="POST" action="{{ route("profile.password.update") }}">
            @csrf
            {{-- <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.user.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div> --}}
            <div class="form-group">
                <label class="required" for="title">Current Password</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="current_password" id="current_password" required>
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="title">New {{ trans('cruds.user.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="new_password" id="new_password" required>
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="title">Repeat New {{ trans('cruds.user.fields.password') }}</label>
                <input class="form-control" type="password" name="new_confirm_password" id="new_confirm_password" required>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>

	</div>
	
     </div>
</div>
@endsection
@section('scripts')
	@parent
		<script>
		</script>
@endsection
  		