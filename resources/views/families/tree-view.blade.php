@extends('app')
@section('content')
  <ul>
    @foreach ($families as $person)
      <li>
        {{ $person->name }} ({{ $person->gender }})
        @if ($person->children->count() > 0)
          <ul>
            @foreach ($person->children as $child)
              <li>
                {{ $child->name }} ({{ $child->gender }})
                @if ($child->children->count() > 0)
                  <ul>
                    @foreach ($child->children as $grandchild)
                      <li>
                        {{ $grandchild->name }} ({{ $grandchild->gender }})
                      </li>
                    @endforeach
                  </ul>
                @endif
              </li>
            @endforeach
          </ul>
        @endif
      </li>
    @endforeach
  </ul>
@endsection