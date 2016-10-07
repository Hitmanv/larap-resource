
return [
@foreach($resources as $k => $v)
    "{{ $k }}" => "{{ $v }}",
@endforeach
];
