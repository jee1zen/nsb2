@extends('layouts.admin')
@section('content')
@can('team_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
          Inquiries
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Client</th>
                    <td> {{ $inquiry->user->name ?? '' }}</td>
                </tr>
                <tr>
                    <th>Client Type</th>
                    <td> {{ $inquiry->user->roles()->first()->title ?? '' }}</td>
                </tr>
                <tr>
                    <th>Inquiry Type</th>
                   <td>{{ Config::get('constants.INQUIRY_TYPES')[$inquiry->type] ?? '' }}</td> 
                </tr>
                <tr>
                    <th>Date</th>
                    <td> {{ $inquiry->created_at ?? '' }}{{($inquiry->created_at->diffForHumans()) ?? ''}}</td>
                </tr>
                <tr>
                    <th>
                        Message
                    </th>
                    <td>
                        {{$inquiry->message}}
                    </td>
                </tr>
              
                
            </table>
        </div>
    </div>
</div>

@endsection
@section('scripts')
@parent
<script>

</script>
@endsection