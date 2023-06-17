<!DOCTYPE html>
<html>

<head>
    <title>Repo Certificate</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
</head>
<style>
    .table_data {
        font-size: x-small;
        margin-bottom: 1px;

    }

    .page-break {
        page-break-before: avoid;
        page-break-after: avoid;
        page-break-inside: avoid;
        margin-bottom: 0px !important;


    }
</style>

<body>
    <div class="page-break">
        <table width="100%" style="float:right; margin-top:-35px !important; margin-left:-25px;">
            <tr>
                <td>

                </td>
                <td style="text-align: right">
                    <img src="{{ public_path('storage/images/certificate_head_logo.png') }}" alt=""
                        style="width:200px; height: 70px; margin-bottom:0px; margin-top:0px;">
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="font-size: x-small; text-align: right">Reg. No. PB 795 | Wholly Owned Subsidiary of NSB</td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: x-small; text-align: right">No 400, Galle Road, Colombo 03.
                    Telephone: 2425010 Fax: 2574387 Email nsbfmc@nsb.lk</td>
            </tr>
        </table>

        <div class="clearfix"></div>
        <hr class="solid">
        <table class="table_data">
            <tr>
                <th>Customer ID</th>
                <th> {{ $cus_id }}</th>
            </tr>
        </table>

        <table width="49%" style="float:left; margin-bottom:5px" class="table_data">
            <tr>
                <th>
                    <u>Borrower</u>
                </th>
            </tr>
            <tr>
                <td> NSB Fund Management Co. Ltd</td>

            </tr>
            <tr>
                <td>No 400</td>
            </tr>
            <tr>
                <td>Galle Road</td>
            </tr>
            <tr>
                <td>Colombo 03</td>

            </tr>
            <tr>
                <td>Telephone : 0112425010</td>
            </tr>
            <tr>
                <td>Fax : 0112574387</td>
            </tr>
            <tr>
                <td> Date: {{ $today }}</td>
            </tr>
        </table>
        <table width="49%" style="float:left;" class="table_data">
            <tr>
                <th> <u>Customer</u></th>
            </tr>
            <tr>
                <td>{{ $client->title }} {{ $client->name }}</td>
            </tr>
            <tr>
                <td>{{ $client->address_line_1 }}</td>
            </tr>
            <tr>
                <td>{{ $client->address_line_2 }}</td>
            </tr>
            <tr>
                <td>{{ $client->address_line_3 }}</td>
            </tr>
        </table>
        <div class="clearfix"></div>
        <hr class="solid" style="margin-top:0px; ">

        <h5> <u> Investment In Repurchase Agreement @money($invested_value)</u></h5>
        <p style="font-size:small">
            We furnish below the details of government securities,
            purchased from us and recorded in the Central Depository
            System of the Central Bank (Lanka Secure) as a customer
            of NSB Fund Management Co. Ltd.
        </p>
        <table class="table table-bordered table-sm w-auto" style="font-size:small !important">
            <tr>
                <td>Face Value </td>
                <td>@money($maturity_value)</td>
            </tr>
            <tr>
                <td>Date of Sale</td>
                <td>{{ $value_date }}</td>
            </tr>
            {{-- <tr>
              <td>Yield	</td>
              <td>{{$yield}}% p.a.</td>
            </tr> not coming from CSV --}}

            <tr>
                <td>Date of Maturity</td>
                <td>{{ $mat_date }}</td>
            </tr>
            <tr>
                <td>Days to Maturity</td>
                <td>{{ $days_to_maturity }}days</td>
            </tr>
            <tr>
                <td> Cost of the Current Investment</td>
                <td>@money($invested_value)</td>
            </tr>
            {{-- <tr>
                <td> </td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
              </tr> --}}
            <tr>
                <td>Security Substitution Allowed</td>
                <td>Y</td>
            </tr>
            <tr>
                <td>Securities replenishment Allowed</td>
                <td>Y</td>
            </tr>
            <tr>
                <td>Securities Removal Allowed</td>
                <td>Y</td>
            </tr>
            <tr>
                <td>Securities tradability Allowed</td>
                <td>Y</td>
            </tr>
        </table>
        <h6>Underlying Securities</h6>
        <table class="table table-bordered table-sm w-auto" style="font-size: small">
            <thead>
                <tr>
                    <th>
                        ISIN
                    </th>
                    <th>
                        Amount
                    </th>
                    <th>
                        Maturity Date
                    </th>
                    <th> Market Value

                    </th>
                    <th>
                        Haircut
                    </th>
                </tr>
            </thead>
            <tbody>
                {{-- {{dd($isin_array)}} --}}
                @foreach ($isin_array as $isin)
                    <tr>
                        <td> {{ $isin['isin'] }}</td>

                        <td> @money($isin['face_value'])</td>

                        <td> {{ $isin['maturity_date'] }} </td>

                        <td>@money($isin['market_value'])</td>

                        <td> {{ $isin['haircut'] }}% </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        <hr class="solid">
        {{-- <div class="clearfix"></div> --}}

        <h6><u>Terms & Condition </u> </h6>
        <table class="table_data" style="margin-bottom:1px;font-size:x-small">
            <tbody>
                <tr>
                    <td>1) Security Valuation</td>
                    <td>The Market value derived using the full price of the securities which considered the rates
                        published by the Central Bank of Sri Lanka</td>
                </tr>
                <tr>
                    <td>2) On Maturity</td>
                    <td>We will reinvest the proceeds and renew the repurchase agreement for the full value, Unless
                        we receive instructions to the contrary at least one week prior to the maturity date.</td>
                </tr>
            </tbody>
        </table>
        <hr class="solid" style="margin-bottom: 0.5px!important">
        <p class="text-center" style="font-size:x-small; margin-top:1px;">* This is computer generated report and
            signature does not required *</p>

    </div>
</body>

</html>
