@if(!empty($countries))
    @foreach($countries as $country)
        <a href="/country/{{ $country['countryCode'] }}">{{ $country['name'] }} </a> <br />
    @endforeach
    {{ $countries->links() }}
@else
    No available countries to be shown.
@endif
