<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Tbill Certificate</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />

</head>

<style>
    .table_data {
        font-size: x-small;

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
                <td style="text-align: right; padding-bottom: 0px">
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
                <td>Customer ID</td>
                <td> &nbsp; <b> {{ $match->cus_id1 }} </b></td>
            </tr>
        </table>
        <div>
            <table width="49%" style="float:left; margin-bottom: 5px;" class="table_data">
                <tr>
                    <th>
                        <u>SELLER</u>

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


            <table width="49%" style="float:left" class="table_data">
                <tr>
                    <th> <u>BUYER</u> </th>
                </tr>
                <tr>
                    <td>{{ $client_title ?? '' }} {{ $client_name }}</td>
                </tr>
                <tr>
                    <td>{{ $client_address_line_1 ?? '' }}</td>
                </tr>
                <tr>
                    <td>{{ $client_address_line_2 ?? '' }}</td>
                </tr>
                <tr>
                    <td>{{ $client_address_line_3 ?? '' }}</td>
                </tr>
            </table>

        </div>
        <div class="clearfix"></div>
        <hr class="solid">


        <h5> <u> Purchase Of Treasury Bills - {{ $match->method }}</u></h5>
        <p style="font-size: small">
            We furnish below the details of government securities,
            purchased from us and recorded in the Central Depository
            System of the Central Bank (Lanka Secure) as a customer
            of NSB Fund Management Co. Ltd.
        </p>
        <table class="table table-bordered table-sm w-auto" style="font-size:small !important">
            <tr>
                <td>Face Value </td>
                <td>@money($match->face_value)</td>
            </tr>
            <tr>
                <td>ISIN</td>
                <td>{{ $match->stock_ref }}</td>
            </tr>
            <tr>
                <td>Date of Sale</td>
                <td>{{ $value_date }}</td>
            </tr>
            <tr>
                <td>Yield </td>
                <td>{{ $match->yield }}% p.a.</td>
            </tr>
            <tr>
                <td>Coupon</td>
                <td>{{ $match->coupon }} p.a.</td>
            </tr>
            {{-- <tr>
              <td>Coupon Dates</td>
              <td>N/A</td>
            </tr> --}}
            <tr>
                <td>Date of Maturity</td>
                <td>{{ $maturity_date }}</td>
            </tr>
            <tr>
                <td>Days to Maturity</td>
                <td>{{ $days_to_maturity }}days</td>
            </tr>
            <tr>
                <td> Price Per Rs. 100/-</td>
                <td>{{ $match->price }}</td>
            </tr>
            <tr>
                <td>Cost of the Security</td>
                <td>@money($match->invested_amount)</td>
            </tr>
            {{-- <tr>
              <td>  
                Value Of the Security which
                Matured On {{$maturity_date}}</td>
              <td>Rs. *******</td>
            </tr> --}}
        </table>
        {{-- <div class="clearfix"></div> --}}
        <hr class="solid">
        <strong style="margin-top: 2px !important; margin-bottom: 2px !important">GENERAL TERMS & CONDITIONS</strong>
        <ul style="padding-left: 0;">

            <li style="font-size:x-small;">Investor/s agrees to provide instructions pertaining to maturity proceeds at
                least seven (07) calendar days prior to maturity. In the event of such instruction not being received,
                the Company may reinvest such proceeds for a period not exceeding the period of the earlier transaction,
                in accordance with the Customer Charter</li>
            <li style="font-size:x-small;">Investor/s shall immediately notify the Company of any changes to existing
                operating instructions along with required supporting documentation.</li>
            <li style="font-size:x-small;">Investor/s shall inform the Company of any discrepancy on a transaction
                relating to investments within 14 working days of such transaction.</li>
            <li style="font-size:x-small;"> Investor/s needs to withdraw before maturity, the company will rediscount
                the instruments at the market rate + margin applicable at discount time subject to the company funding
                availability</li>

        </ul>
        <hr class="solid" style="margin-bottom: 0.5px!important">
        <p class="text-center" style="font-size:x-small; margin-top:1px;">* This is computer generated report and
            signature does not required *</p>
    </div>
</body>

</html>
