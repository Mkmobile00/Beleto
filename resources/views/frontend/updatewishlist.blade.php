<div class="col" id="updateWishList">
    @foreach (userWishList($customer) as $data)
    <div class="d-flex justify-content-between border-bottom mb-3">
        <div class="wishlist_img">
            <img src="{{@$data['image']}}" alt="img" style="width: 100%">
            <div class="overlay_close"><i class="fa fa-close removeWishlist" data-id="{{$data['id']}}"></i></div>
        </div>
        <div class="ms-4">
            <p style="margin: 0;"><strong>{{@$data['title']}}</strong></p>
            <span>{{@$data['rating']}}</span>

            <div class="description">
                <a href="{{route('movieDetailsPage',[@$data['slug'],@$data['type']])}}">View</a>
            </div>
        </div>
    </div>
   
    @endforeach
</div>