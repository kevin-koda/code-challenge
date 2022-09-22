<!--
    /*
        must include the following:
        name, region, code, no. countries bordering the current one
    */
-->
@if(!$info)
    Country information unavailable.
@else
    Country name: {{ $info['officialName'] }} <br />
    Region: {{ $info['region'] }} <br />
    Code: {{ $info['countryCode'] }} <br />
    No of countries bordering {{ count($info['borders']) }} 

    <br /><br />
    <!-- 
        Display the next 4 holidays for the current year, count of total holidays
    -->
    There are {{ $holidayCount }} holidays this year. Next {{ count($holidays) }} holidays for the current year are: <br /><br />
    @foreach($holidays as $holiday)
        {{ $holiday['name'] . ' ('.$holiday['date'].')' }} <br />
    @endforeach

    <br /><br />
    <a href="/">Back to list of countries</a>
@endif

