<div class="banner" style="background-image: url('{{ $bannerImage }}');">
    <div class="overlay">
        <div class="container banner-content">           
            <h1 class="fw" style="padding-top: 10vh; color: white;">
            <button class="btn btn-success rounded-pill px-4"></button><br>
                {{ $bannerTitle }}</h1>
            <p>{{ $bannerDescription }}</p>
        </div>
        <lord-icon
            src="https://cdn.lordicon.com/xcrjfuzb.json"
            trigger="loop"
            delay="1500"
            colors="primary:#ffffff"
            style="width:50px;height:50px">
        </lord-icon>
    </div>
</div>