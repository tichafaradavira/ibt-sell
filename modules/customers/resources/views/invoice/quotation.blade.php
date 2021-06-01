<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            color: #777;
        }

        body h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .quotation-number {
            color: #196F3D;
            font-weight: bold;
        }

        .company-name {
            color: #873600;
        }

        .customer-email {
            color: #2E86C1;
        }

        .footer {
            position: absolute;
            bottom: 20px;
        }

        .footer-text {
            color: #3498DB;
            font-style: italic;
            font-size: 15px;
        }

        .quotation-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .quotation-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .quotation-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .quotation-box table tr td:nth-child(2) {
            text-align: right;
        }

        .quotation-box table tr.top table td {
            padding-bottom: 20px;
        }

        .quotation-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .quotation-box table tr.information table td {
            padding-bottom: 40px;
        }

        .quotation-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .quotation-box table tr.details td {
            padding-bottom: 20px;
        }

        .quotation-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .quotation-box table tr.item.last td {
            border-bottom: none;
        }

        .quotation-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .quotation-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: justify;
            }

            .quotation-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: justify;
            }
        }
    </style>
</head>

<body>
<div class="quotation-box">
    <table>
        <tr class="top">
            <td colspan="3">
                <table>
                    <tr>
                        <td class="title">
                            <span class="company-name">{{$vendor->company_name}}</span>
                        </td>
                        <td>
                            Quotation #:<span class="quotation-number">{{$quotation->number}}</span><br/>
                            Created: {{$quotation->created_at->toFormattedDateString()}}<br/>
                            Valid Until: {{$quotation->expires_at->toFormattedDateString()}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="information">
            <td colspan="3">
                <table>
                    <tr>
                        <td>
                            {{$vendor->settings['street_address']}}<br/>
                            {{$vendor->settings['suburb']}}<br/>
                            {{$vendor->settings['city']}}<br>
                            {{$vendor->settings['country']}}, {{$vendor->settings['zip_code']}}
                        </td>
                        @if($quotation->customer)
                        <td>
                            {{$quotation->customer->street_address ? $quotation->customer->street_address : "Street Address" }}
                            <br/>
                            {{$quotation->customer->suburb ? $quotation->customer->suburb : "Suburb" }}<br/>
                            {{$quotation->customer->city ? $quotation->customer->city : "City"}}<br>
                            {{$quotation->customer->country ? $quotation->customer->country : "Country"}}
                            , {{$quotation->customer->country ? $quotation->customer->zip_code : "Zip Code"}}<br>
                            <span class="customer-email">{{$quotation->customer->email}}</span>
                        </td>
                        @else
                            <td>
                                {{$quotation->lead->street_address ? $quotation->lead->street_address : "Street Address" }}
                                <br/>
                                {{$quotation->lead->suburb ? $quotation->lead->suburb : "Suburb" }}<br/>
                                {{$quotation->lead->city ? $quotation->lead->city : "City"}}<br>
                                {{$quotation->lead->country ? $quotation->lead->country : "Country"}}
                                , {{$quotation->lead->country ? $quotation->lead->zip_code : "Zip Code"}}<br>
                                <span class="customer-email">{{$quotation->lead->email}}</span>
                            </td>
                        @endif
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="top">
            <td colspan="3">
                <table>
                    <tr>

                        <td>
                            <h3>Summary</h3>
                            {{$quotation->summary}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>Product/Service description</td>
            <td>Quantity</td>
            <td>Unit price</td>
        </tr>
        @foreach ($quotation->items  as $item)
            <tr class="item">
                <td>{{$item['description']}}</td>
                <td>{{$item['quantity']}}</td>
                <td>{{$vendor->settings['currency']}}{{$item['price']}}</td>
            </tr>
        @endforeach


        <tr class="total">
            <td></td>
            <td colspan="2">Total: {{$vendor->settings['currency']}}{{$quotation->total_amount}}</td>
        </tr>
    </table>
</div>
<div class="footer">
    <hr>
    <p class="footer-text">Powered by IBT Sell, the ultimate micro business suite for the freelancer.</p>
</div>
</body>
</html>
