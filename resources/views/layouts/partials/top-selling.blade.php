<div class="container">
    <div class="row h-40 g-2 py-1">
        @foreach($categories as $category)
        <div class="col-md-4">
            <div class="card card-span h-100 text-white" style="height: 30vh;">
                <img class="card-img h-60" src="{{ asset($category->thumbnail) }}" alt="{{ $category->category_name }}" />
                <div class="card-img-overlay bg-dark-gradient">
                    <div class="d-flex align-items-end justify-content-center h-100">
                        <a class="btn btn-lg text-light" href="categories/{{ $category->category_id }}" role="button">
                            <span style="color: rgb(255, 255, 255); font-size: 18px;">
                                <div class="p-2 px-4" style="border-radius: 2rem; width: 100%; display: flex; align-items: center; justify-content: center; background-color:#DD7907;">
                                    <span style="margin-right: 10px;">{{ $category->category_name }}</span>
                                    <i class="fas fa-cart-arrow-down" style="color: #2B2118;"></i>
                                </div>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="container px-4 px-lg-5 mt-5 text-center">
        <a href="/shop">
            <button class="btn-custom-yellow">VIEW ALL COLLECTIONS</button>
        </a>
    </div>
</div>

