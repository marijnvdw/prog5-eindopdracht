@props(['categories'])
<select name="sightseeing-options" id="sightseeing-options">
    @foreach($categories as $category)
    <option value="{{$category->name}}">{{$category->name}}</option>
    @endforeach
</select>
