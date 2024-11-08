<div class="card bg-base-100 shadow-xl">
    <div class="card-body">
        @isset($title)
        <h2 class="card-title">
            {{ $title }}
        </h2>
        @endisset
        <p>{{ $slot }}</p>

        @isset($footer)
        <div class="card-actions justify-between items-center">
            @isset($category)
                <a href="{{ route('home.index', ['category_id' => $category->id]) }}" class="badge badge-ghost">{{ $category->name }}</a>
            @endisset
            <button class="btn">{{ $footer }}</button>
        </div>
        @endisset
    </div>
</div>




