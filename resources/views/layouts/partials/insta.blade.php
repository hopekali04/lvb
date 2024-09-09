<style>
    .card {
        border-radius: 0; /* Flat corners */
    }
    .card img {
        border-radius: 0; /* Flat corners for images */
    }
</style>
<div class="container-fluid px-0 mt-5">
    <div class="row">
        <div class="col-12 text-center mb-4">
            <button class="btn" style="background-color: #dd7907; border-radius: 5em; padding: 10px 40px; font-size: 1.25rem;">
                <a href="https://www.instagram.com/lovebuildsapparel/" target="_blank" rel="noopener noreferrer" id="insta" style="color: #ffffff;">
                    <strong>OUR INSTA</strong>
                </a>
                <img src="{{ asset('img/instagram.png') }}" alt="Ig Icon" style="height: 40px; width: 40px;" />
            </button>
        </div>
    </div> 
    <!-- Images -->
    <div class="row justify-content-center p-4">
        <div class="col-12 col-md-6 col-lg mb-4">
          <div class="card">
            <img src="{{ asset('img/gal4.jpg') }}" class="card-img" alt="Image 1" />
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg mb-4">
          <div class="card">
            <img src="{{ asset('img/gal5.jpg') }}" class="card-img" alt="Image 2" />
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg mb-4">
          <div class="card">
            <img src="{{ asset('img/gal1.jpg') }}" class="card-img" alt="Image 3" />
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg mb-4">
          <div class="card">
            <img src="{{ asset('img/girl_brown.jpg') }}" class="card-img" alt="Image 1" />
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg mb-4">
          <div class="card">
            <img src="{{ asset('img/gal2.jpg') }}" class="card-img" alt="Image 4" />
          </div>
        </div>
    </div>
</div>
</div>
