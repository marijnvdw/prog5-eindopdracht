@props(['active' => false])

<a {{$attributes}} class="{{$active ? 'active' : ''}} block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
    {{$slot}}
</a>
