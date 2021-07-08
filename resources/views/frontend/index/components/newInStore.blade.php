<section class="new">
  <label class="text-left" for="card_name" style="font-family: 'Cedarville Cursive' ,cursive;font-size: 46px; margin-top: 148px;">New in store</label>
</section>

<section class="carousel-brands d-flex justify-content-center flex-row" style="background-color: #e0cfc7ff;margin-top: -100px;">
  <div class="container">
    <div class="row">
      <div class="MultiCarousel" data-items="2,3,5,6" data-slide="1" id="MultiCarousel" data-interval="1000">
        <div class="MultiCarousel-inner">
          @forelse ($products as $row)
          <div class="item">
            <a href="/item/{{$row['id']}}">
              <div class="pad15" style="background: #fff !important;left: 48px !important;float: left;position: relative;">
                <img src="/api/products/{{$row['image_url']}}" style="width: 100%">
              </div>
            </a>
          </div>
          @empty

          @endforelse

        </div>
        <button class="btn btn-primary leftLst" style="background: transparent !important; border-color:transparent !important;">
          <i class="fa fa-caret-left fa-3x" style="color: #946f5e !important;"></i>
        </button>
        <button class="btn btn-primary rightLst" style="background: transparent !important; border-color:transparent !important;">
          <i class="fa fa-caret-right fa-3x" style="color: #946f5e !important;"></i>
        </button>
      </div>
    </div>
  </div>
</section>