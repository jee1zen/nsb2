@extends('emails.layouts.app')

@section('content')

<h2>Hi {{$name}} </h2>
<p> <b>  Thank you for banking with us!</b></p>
<p>Your verification process is being processed.</p> 
<p>Here’s our bank particulars to make fund transfer.</p>

<table style="border: 0px solid #000" cellpadding="1">
    <tbody>
        <tr>
            <th style="width: 200px; text-align: left; padding: 5px 10px; border: 1px solid #000">Beneficiary Name</th>
            <td style="width: 200px; text-align: left; padding: 5px 10px; border: 1px solid #000">NSB Fund Management Co.Ltd</td>
            <td style="width: 200px; text-align: left; padding: 5px 10px; border: 1px solid #000">NSB Fund Management Co.Ltd</td>
        </tr>
        <tr>
            <th style="width: 200px; text-align: left; padding: 5px 10px; border: 1px solid #000">Account No</th>
            <td style="width: 200px; text-align: left; padding: 5px 10px; border: 1px solid #000">100011378759</td>
            <td style="width: 200px; text-align: left; padding: 5px 10px; border: 1px solid #000">857</td>
        </tr>
        <tr>
            <th style="width: 200px; text-align: left; padding: 5px 10px;border: 1px solid #000">Bank</th>
            <td style="width: 200px; text-align: left; padding: 5px 10px;border: 1px solid #000">National Savings Bank</td>
            <td style="width: 200px; text-align: left; padding: 5px 10px;border: 1px solid #000">Bank of Ceylon</td>
        </tr>
        <tr>
            <th style="width: 200px; text-align: left; padding: 5px 10px;border: 1px solid #000">Branch</th>
            <td style="width: 200px; text-align: left; padding: 5px 10px;border: 1px solid #000">Head Office Branch</td>
            <td style="width: 200px; text-align: left; padding: 5px 10px;border: 1px solid #000">Corporate Branch</td>
        </tr>
        <tr>
            <th style="width: 200px; text-align: left; padding: 5px 10px;border: 1px solid #000">Branch Code</th>
            <td style="width: 200px; text-align: left; padding: 5px 10px;border: 1px solid #000">001</td>
            <td style="width: 200px; text-align: left; padding: 5px 10px;border: 1px solid #000">660</td>
        </tr>
        {{-- <tr>
            <th style="width: 200px; text-align: left; padding: 5px 10px;border: 1px solid #000">SWIFT Code</th>
            <td style="width: 200px; text-align: left; padding: 5px 10px;border: 1px solid #000">NSBFLKLX</td>
            <td style="width: 200px; text-align: left; padding: 5px 10px;border: 1px solid #000">NSBFLKLX</td>
        </tr> --}}

    </tbody>
</table>

<p>This is an automated mail so in case you have any questions for us let us know at nsbfmc@nsb.lk or feel free to contact us on +94112425010.</p>
@endsection