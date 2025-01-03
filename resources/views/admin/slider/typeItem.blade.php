<label for="type" class="form-label">Select {{$name}}</label>
<select name="movie_id" id="movie_id" class="form-control" required>
    <option value="">----Select {{$name}}------</option>
    
    @foreach ($items as $item)
        <option value="{{$item->id}}" {{$item->id==$movieId ? 'selected':''}}>{{$item->title}}</option>
    @endforeach
</select>
<span class="text-danger movie_idError"></span>