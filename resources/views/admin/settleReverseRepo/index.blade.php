@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
          Reverse Repo Requests
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Transaction">
                <thead>
                    <tr>
                         <th>
                             
                         </th>
                        <th>
                            Client
                        </th>
                        <th>
                          Reverse Repo
                        </th>
                        <th>
                           Instruction
                          </th>
                        <th>
                           Date
                        </th>
                        <th>
                           Status
                        </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($reverseRepos)
                    @foreach($reverseRepos as $key => $reverseRepo)
                        <tr data-entry-id="{{ $reverseRepo->id }}">
                            <td># {{ $reverseRepo->id}}</td>
                            <td>
                                {{$reverseRepo->client->name}}
                            </td>
                            <td>
                              {{$reverseRepo->reverseRepo->investment->ref_no}} -{{$reverseRepo->reverseRepo->investment->InvestmentType->name}} - @money($reverseRepo->reverseRepo->amount)
                            </td>
                            <td>
                                {{Config::get('constants.SETTLE_REPO_TYPES')[$reverseRepo->instruction]}}
                            </td>
                            <td>
                               {{$reverseRepo->created_at}} &nbsp;({{ $reverseRepo->created_at->diffForHumans()}})
                            </td>
                            <td>
                                {{Config::get('constants.WITHDRAW_REQUEST_STATUS')[$reverseRepo->status]}}
                            </td>
                            <td>
                                <a href="{{route('admin.settleReverseRepo.show',$reverseRepo->id)}}" class="btn btn-primary">proceed</a>
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
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 0, 'desc' ]],
    pageLength: 100,
      columnDefs: [{
          orderable: true,
          className: '',
          targets: 0
      }]
  });
  $('.datatable-Transaction:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
