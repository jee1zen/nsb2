@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
      Add Branches To Bank - {{$bank->name}}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.banks.storeBranches",$bank->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">Branch Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header">
     Branches Of {{$bank->name}}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                           Branch ID
                        </th>
                        <th>
                           Branch Name
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if($bank->hasBranches())
                    @foreach($bank->branches()->get() as $key => $branch)
                        <tr data-entry-id="{{ $bank->id }}">
                            <td>

                            </td>
                            <td>
                                #{{ $branch->id ?? '' }}
                            </td>
                            <td>
                                {{$branch->name}}
                            </td>
                            <td>
                             
                                

                                @can('user_edit')
                                    <a class="btn btn-xs btn-danger" href="{{ route('admin.banks.deleteBranch', $branch->id) }}">
                                       Delete
                                    </a>
                                @endcan

                                {{-- @can('user_delete')
                                    <form action="{{ route('admin.users.destroy', $client->user_id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan --}}

                            </td>

                        </tr>
                        
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection