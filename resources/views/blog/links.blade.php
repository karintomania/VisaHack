<x-layouts.base>
    <section class="flex flex-col items-center w-full py-0 sm:py-10 px-4">
        <h1 class="text-2xl sm:text-3xl font-bold mb-10"><span class="text-grad">Useful Tips</span> to work abroad</h1>
        <div class="flex flex-col gap-y-4 w-full sm:w-4/5">
        @foreach ($links as $link)
            <div class="flex flex-col px-6 py-4 bg-base-light border border-gray-700">
                <a class="text-xl sm:text-2xl text-gray-300 font-bold underline cursor-pointer" href="{{$link->url}}">{{$link->title}}</a>
                <p class="mb-4">posted at {{$link->publishedAt->toFormattedDateString()}}</p>
                <p class="text-lg">{{$link->excerpt}}...</p>
            </div>
        @endforeach
        </div>
    </section>
</x-layouts.base>
