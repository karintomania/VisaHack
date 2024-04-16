@props([
    'job',
])

<div class="w-full border border-neutral-300 bg-white px-6 py-4">
    <div class="flex flex-row justify-between items-start gap-4">
        <h2 
            class="text-2xl text-neutral-600 font-bold underline cursor-pointer"
            onClick='search.toggleDetail({{$job->id}})'>{{ $job->title }}</h2>
        <a class="hidden sm:inline btn-main px-4 py-2" href="{{$job->url}}" target="_blank">Apply</a>
    </div>
    <div class="mb-2">Posted at {{substr($job->created_at, 0, 10)}} by {{$job->company}}</div>
    <div class="mb-4 flex flex-row flex-wrap gap-2 sm:gap-4">
        @if ($job->salary)
        <div>
            <span class="bg-orange-100 px-1">{{$job->salary}}</span>
        </div>
        @endif
        <div>
        <span class="bg-teal-100 px-1">
            @if ($job->location){{$job->location}},&nbsp;@endif{{$job->country}}
        </span>
        </div>
        @if ($job->job_type) 
        <div>
            <span class="bg-lime-100 px-1">{{$job->job_type}}</span>
        </div>
        @endif
    </div>
    <div id="job_summary_{{$job->id}}" class="mb-4">
        <p>{{substr($job->getPlainDescription(), 0, 400)}}...</p>
        <div onClick='search.toggleDetail({{$job->id}})' class="underline text-lg cursor-pointer">Read more...</div>
    </div>
    <div id="job_detail_{{$job->id}}" class="hidden mb-4 list-disc">
        <div onClick='search.toggleDetail({{$job->id}})' 
            class="underline mb-4 text-lg cursor-pointer">Read less...</div>
        <p>{!!$job->description!!}</p>
    </div>

    <div class="flex justify-center">
    <a class="block sm:hidden w-3/4 btn-main text-center px-4 py-2" href="{{$job->url}}" target="_blank">Apply</a>
    </div>
</div>
