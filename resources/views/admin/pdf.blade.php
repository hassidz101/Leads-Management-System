<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Lead number: {{getLeadNumber($lead->id)}}</title>
    <link rel="icon" type="image/x-icon" href="{{env('APP_URL')}}/admin/images/favicon.ico"  />
    <style>
        @font-face {
            font-family: SourceSansPro;
            src: url({{env('APP_URL')}}/admin/css/pdf/SourceSansPro-Regular.ttf);
        }

        @media print {
            body {-webkit-print-color-adjust: exact;}
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #0869E1;
            text-decoration: none;
        }

        body {
            position: relative;
            width: 21cm;
            height: 27.8cm;
            margin: 0 auto;
            color: #555555;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-family: SourceSansPro;
        }

        header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #AAAAAA;
        }

        #logo {
            float: left;
            margin-top: 8px;
        }

        #logo img {
            height: 40px;
        }

        #company {
            float: right;
            text-align: right;
        }


        #details {
            margin-bottom: 50px;
        }

        #agentid {
            padding-left: 6px;
            border-left: 6px solid #0869E1;
            float: left;
        }

        #agentid .to {
            color: #777777;
        }

        h2.nameid {
            font-size: 1.4em;
            font-weight: normal;
            margin: 0;
        }

        #leaddetailsid {
            float: right;
            text-align: right;
        }

        #leaddetailsid h1 {
            font-size: 2.4em;
            line-height: 1em;
            font-weight: bold;
            margin: 0  0 10px 0;
        }

        #invoice h1.unprocessed {
            color: #0869E1;
        }

        #leaddetailsid h1.appointment {
            color: #2BC844;
        }

        #leaddetailsid h1.not_reached_1 {
            color: #9568FF;
        }
        #leaddetailsid h1.not_reached_2 {
            color: #9568FF;
        }
        #leaddetailsid h1.not_reached_3 {
            color: #9568FF;
        }
        #leaddetailsid h1.not_reached_4 {
            color: #9568FF;
        }
        #leaddetailsid h1.not_reached_5 {
            color: #9568FF;
        }

        #leaddetailsid h1.deadline {
            color: #ED3DD1;
        }

        #leaddetailsid h1.closed {
            color: #FF5166;
        }

        #leaddetailsid h1.not_closed {
            color: #FFBF00;
        }

        #leaddetailsid h1.no_interests {
            color: #2A353A;
        }

        #leaddetailsid .leadnumberid {
            font-size: 1.1em;
            color: #777777;
        }

        #leaddetailsid .dateofissueid {
            font-size: 1.1em;
            color: #777777;
        }

        table.persinf {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table.persinf th {
            text-align: left;
            background-color: #0869E1;
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 5px;
            padding-bottom: 5px;
            font-size: 16px;
            color: #ffffff;
        }

        table.persinf td {
            text-align: left;
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .borderr {
            border-top: 1px solid #AAAAAA;
        }

        #hinweisid{
            font-size: 1em;
            margin-bottom: 25px;
            margin-top: 25px;
        }

        #investitionsbetragid{
            padding-left: 6px;
            border-left: 6px solid #0869E1;
        }

        #investitionsbetragid .investitionsbetragid1 {
            font-size: 1.2em;
            font-weight: bold;
        }

        footer {
            color: #777777;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #AAAAAA;
            padding: 8px 0;
            text-align: center;
        }


    </style>
</head>
<body>
<header class="clearfix">
    <div id="logo">
        <img src="{{env('APP_URL')}}/admin/images/logo.png">
    </div>
    <div id="company">
        <h2 class="nameid">{{env('APP_NAME')}}</h2>
        <div>Customer relationship management</div>
        <div><a href="{{env('APP_URL')}}" target="_blank">{{env('APP_URL_TWO')}}</a></div>
    </div>
    </div>
</header>
<main>
    <div id="details" class="clearfix">
        <div id="agentid">
            <div class="agentid1">AGENT:</div>
            <h2 class="nameid">{{!empty($lead->agent) ? $lead->agent->full_name: '-- --'}}</h2>
            <div class="usernameid">{{!empty($lead->agent) ? '@'.$lead->agent->username: '-- --'}}</div>
            <div class="emailid"><a href="mailto:{{!empty($lead->agent) ? $lead->agent->email: '-- --'}}">{{!empty($lead->agent) ? $lead->agent->email: '-- --'}}</a></div>
        </div>
        <div id="leaddetailsid">
            <h1 class="{{$lead->lead_status}}">{{ucfirst(str_replace('_', ' ', $lead->lead_status))}}</h1>
            <div class="leadnumberid">Lead number: <a href="{{route('admin.lead-detail-view', ['id' => $lead->faker_id])}}">{{getLeadNumber($lead->id)}}</a></div>
            <div class="dateofissueid">Date of issue: {{date('d/m/Y', strtotime($lead->created_at))}}</div>
        </div>
    </div>
    @php
        $interested_in = explode(',', $lead->interested_in);
        $reachability = explode(',', $lead->reachability);
    @endphp
    <table class="persinf" border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th>Personal information</th>
            <th>Details</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Anrede: </td>
            <td>{{$lead->gender}}</td>
        </tr>
        <tr>
            <td>Vorname: </td>
            <td>{{ucfirst($lead->first_name)}}</td>
        </tr>
        <tr>
            <td>Nachname: </td>
            <td>{{ucfirst($lead->last_name)}}</td>
        </tr>
        <tr>
            <td>Email: </td>
            <td>{{$lead->email}}</td>
        </tr>
        <tr>
            <td>Telefonnummer: </td>
            <td>{{$lead->phone}}</td>
        </tr>
        <tr>
            <th>Interessen</th>
            <th>Details</th>
        </tr>
        <tr>
            <td>Investments in einen PreSale</td>
            <td>{{in_array('Investments in einen PreSale', $interested_in) ? "Yes": "No"}}</td>
        </tr>
        <tr>
            <td>Investments in NFTs</td>
            <td>{{in_array('Investments in NFTs', $interested_in) ? "Yes": "No"}}</td>
        </tr>
        <tr>
            <td>Investments in Krypto</td>
            <td>{{in_array('Investments in Krypto', $interested_in) ? "Yes": "No"}}</td>
        </tr>
        <tr>
            <td>Kostenlose Krypto-Beratung</td>
            <td>{{in_array('Kostenlose Krypto-Beratung', $interested_in) ? "Yes": "No"}}</td>
        </tr>
        <tr>
            <td>Kostenlose NFT-Beratung</td>
            <td>{{in_array('Kostenlose NFT-Beratung', $interested_in) ? "Yes": "No"}}</td>
        </tr>
        <tr>
            <td>Etwas anderes</td>
            <td>{{in_array('Etwas anderes', $interested_in) ? "Yes": "No"}}</td>
        </tr>
        <tr>
            <th>Erreichbarkeit</th>
            <th>Details</th>
        </tr>
        <tr>
            <td>Vormittags</td>
            <td>{{in_array('Vormittags', $reachability) ? "Yes": "No"}}</td>
        </tr>
        <tr>
            <td>Nachmittags</td>
            <td>{{in_array('Nachmittags', $reachability) ? "Yes": "No"}}</td>
        </tr>
        <tr>
            <td>Abends</td>
            <td>{{in_array('Abends', $reachability) ? "Yes": "No"}}</td>
        </tr>
        </tbody>
    </table>
    <div class="borderr"></div>

    <div id="hinweisid"><b>Hinweis:</b>
        <br>
        {{$lead->notice}}</div>

    <div id="investitionsbetragid">
        <div>INVESTITIONSBETRAG:</div>
        <div class="investitionsbetragid1">{{$lead->investment_amount}}</div>
    </div>
</main>
<footer>
    This document is generated on {{env('APP_URL')}}<br><a href="{{env('APP_URL')}}">www.{{env('APP_URL_TWO')}}</a>
</footer>
</body>
</html>