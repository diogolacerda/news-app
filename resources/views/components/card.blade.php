<div class="card bg-base-100 w-96 shadow-xl">
    <div class="card-body">
        @isset($title)
        <h2 class="card-title">
            {{ $title }}
        </h2>
        @endisset
        <p>{{ $slot }}</p>
        <div class="card-actions justify-end">
            @isset($category)
                <div class="">{{ $category }}</div>
            @endisset
        </div>
        @isset($footer)
            <div class="card-actions item-center text-center">
                <button class="btn ">{{ $footer }}</button>
            </div>
        @endisset
    </div>
</div>


{{-- <div class="card card-compact bg-base-100 w-96 shadow-xl">

    <div class="card-body">
      <h2 class="card-title">Shoes!</h2>
      <p>If a dog chews shoes whose shoes does he choose?</p>
      <div class="card-actions container mx-auto">
        <button class="btn btn-primary">Buy Now</button>
      </div>
    </div>
  </div> --}}


