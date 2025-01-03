@foreach($moviesCategory as $index=>$category)
<div class="col-sm-12">
    @php
        if(isset($movie)){
            $selected_categories = @$movie->movieHasCategories->pluck('id')->toArray();
        }else{
            $selected_categories  = [];
        }
    @endphp
    
    <input type="checkbox" class="category-selection" id="category" name="category[]" value="{{$category->id}}" {{(in_array($category->id, $selected_categories)) ? 'checked' : ''}}> {{$category->title}}
    @if(count($category->childCat) > 0)
            @include('admin.movie.category-checkbox', ['moviesCategory' => $category->childCat])
    @endif
</div>
@endforeach




@push('scripts')
<script>
    $(document).ready(function(){
        $('.category-selection').on('click', function(e){
            let category_id = $(this).data('category_id');
            if($(this).is(":checked")) {
                
            }else {
                var dataId = $("input:checkbox").data("category_id");
                var elements = $("[data-category_id='" + dataId + "']");
                $("input[type='checkbox'][data-category_id='"+$(this).data("category_id")+"']").prop("checked", false);
            }
        });
    });
</script>
@endpush