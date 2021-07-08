<section class="types">
  <div class="typesBg"></div>
  <div class="d-flex flex-column typeScroll">
    <label class="text-center keep-exp" for="card_name">SIGUE EXPLORANDO</label>
    <div class="d-flex typeScrollHidden">
      @forelse ($categories as $row)
      <div class="typeScrollImg" style=" background-color: white; margin-right: 10px,; width: 24%;">
        <a href="/store/{{$row['id']}}" class="d-flex flex-column">
          @if ($row['image_url'] != null)
          <img src="/api/products/{{$row['image_url']}}" style="padding: 5px;width: 100%">
          @else
          <img src="./assets/images/quimera/mules.png" style="padding: 5px;width: 100%">
          @endif
          <label class="text-center" for="card_name" style="margin-bottom: 0px;font-size: 18px;color: black">{{$row['name']}}</label>
        </a>
      </div>
      @empty

      @endforelse

    </div>
  </div>
</section>