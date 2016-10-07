
return [
    @foreach($resources as $resource)
        "{{ $resource }}",
    @endforeach
];
