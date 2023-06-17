@extends('layouts.client')
@section('content')
<div class="col-md-10 content">
  <div class="panel panel-default">
	<div class="panel-heading">
		<h2>Inquiries</h2>
	</div>
	<div class="panel-body">
        <!-- Success message -->
        
        <div class="row">
            <div class="col-md-6">
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                @endif

                <form action="" method="post" enctype="multipart/form-data">

                    <!-- CROSS Site Request Forgery Protection -->
                    @csrf

                    <div class="form-group">
                        <label>inquiry Type</label>
                      <select name="inquiryType" id="inquieryType" class="form-control">
                          <option value="1">General</option>
                          <option value="2">Complain</option>
                          <option value="3">Suggession</option>
                      </select>
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" maxlength="250" name="message" id="message" rows="4"></textarea>
                    </div>

                    <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
                </form>

            </div>
            <div class="col-md-6">
                <h4>Bank Details Bank</h4>
                <table class="table">
                    <tr>
                        <th>Bank <p>NSB</p></th>
                        <th>Bank <p>BOC</p></th>
                    </tr>
                    <tr>
                        <td>A/C No <p>100011378759</p> </td>
                        <td>A/C No <p>857</p> </td>
                    </tr>
                    <tr>
                        <td>Branch <p>HOB</p> </td>
                        <td>Branch <p>Corporate</p> </td>
                    </tr>
                    <tr>
                        <td>Bank Code <p>7719</p></td>
                        <td>Bank Code <p>7010</p></td>
                    </tr>
                    <tr>
                        <td>Branch Code <p>001</p></td>
                        <td>Branch Code <p>857</p></td>
                    </tr>
                    <tr>
                        <td>SWIFT Code</td>
                        <td>NSBFLKLX</td>
                    </tr>
                </table>
            </div>
        </div>
	 </div>
   </div>
</div>

@endsection
@section('scripts')
	@parent
		<script>
		</script>
@endsection
  		