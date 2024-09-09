    <h2 class="text-center mb-4 fw-bold">Top Sell<span class="gold-text">ing Products</span> <img src="{{ asset('img/hot-sale.png') }}" alt=""
    style="height: 50px; width: 50px;"></h2>
    <div class="row">
        <!-- Product 1 -->
        <div class="col-md-4 mb-4">
          <div class="card border-0">
            <img src="{{ asset('img/black.jpg') }}" class="card-img-top prod-img-top" alt="Product 1">
            <div class="card-body">
              <h5 class="card-title"><strong>Product Title 1</strong></h5>
              <p class="card-text">Brief description of the product.</p>
              <div class="d-flex justify-content-between align-items-center">
                <p class="card-text mb-0"><strong>$39.99</strong></p>
                <a href="#" class="btn btn-warning" id="btn-cl">
                  <i class="fas fa-shopping-cart"></i> Buy Now
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- Product 2 -->
        <div class="col-md-4 mb-4">
          <div class="card border-0">
            <img src="{{ asset('img/home2.jpg') }}" class="card-img-top prod-img-top" alt="Product 2">
            <div class="card-body">
              <h5 class="card-title">Product Title 2</h5>
              <p class="card-text">Brief description of the product.</p>
              <div class="d-flex justify-content-between align-items-center">
                <p class="card-text mb-0"><strong>$39.99</strong></p>
                <a href="#" class="btn btn-warning" id="btn-cl">
                  <i class="fas fa-shopping-cart"></i> Buy Now
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- Product 3 -->
        <div class="col-md-4 mb-4">
          <div class="card border-0">
            <img src="{{ asset('img/sun_red.jpg') }}" class="card-img-top prod-img-top" alt="Product 3">
            <div class="card-body">
              <h5 class="card-title">Product Title 3</h5>
              <p class="card-text">Brief description of the product.</p>
              <div class="d-flex justify-content-between align-items-center">
                <p class="card-text mb-0"><strong>$39.99</strong></p>
                <a href="#" class="btn btn-warning" id="btn-cl">
                  <i class="fas fa-shopping-cart"></i> Buy Now
                </a>
              </div>
            </div>
          </div>
        </div>
    </div>
<!-- TESTING DYNAMIC LOADING OF PRODUCTS -->
<h2 class="text-center mb-4 fw-bold">DYNAMIC Top Sell<span class="gold-text">ing Products</span> <img src="{{ asset('img/hot-sale.png') }}" alt=""
  style="height: 50px; width: 50px;"></h2>
 
    <div class="row">
      @foreach($topSellingProducts as $product)
          <div class="col-md-4 mb-4">
              <div class="card border-0">
                  <img src="{{ asset($product->thumbnail) }}" class="card-img-top prod-img-top" alt="{{ $product->product_name }}">
                  <div class="card-body">
                      <h5 class="card-title"><strong>{{ $product->product_name }}</strong></h5>
                      <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                      <div class="d-flex justify-content-between align-items-center">
                          <p class="card-text mb-0"><strong>${{ number_format($product->price, 2) }}</strong></p>
                          <a href="/product/{{ $product->product_id }}" class="btn btn-warning" id="btn-cl">
                              <i class="fas fa-shopping-cart"></i> Buy Now
                          </a>
                      </div>
                  </div>
              </div>
          </div>
      @endforeach
  </div>
      
  