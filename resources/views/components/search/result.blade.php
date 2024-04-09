@props([
    'jobs',
])
<section class="flex flex-col items-center gap-6 w-full sm:w-2/3 mb-10">
    @if($jobs->total() > 0)
    <div class="px-4 w-full font-bold">
        {{$jobs->total()}} results founds
    </div>
    @foreach ($jobs as $job)
        <x-search.job :job="$job"/>
    @endforeach
    {{$jobs->links()}}
    @else
        No results for this search. Try different keywords.
    @endif
</section>
