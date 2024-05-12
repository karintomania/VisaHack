@props([
    'job',
])

<div class="w-full bg-base-light px-6 py-4 border border-gray-700">
    <div class="flex flex-row justify-between items-start gap-4">
        <h2 
            class="text-2xl text-gray-300 font-bold underline cursor-pointer"
            onClick='search.toggleDetail({{$job->id}})'>{{ $job->title }}</h2>
        <a class="hidden sm:inline btn-main px-4 py-2" href="{{$job->url}}" target="_blank">Apply</a>
    </div>
    <div class="mb-2">Posted  
        {{ $job->created_at->diffInDays(now()) <= 7 ? $job->created_at->diffForHumans() : 'on ' . $job->created_at->toFormattedDateString() }} by {{$job->company}}</div>
    <div class="mb-4 flex flex-row flex-wrap gap-x-2 gap-y-4 sm:gap-4">
        @if ($job->salary)
        <div>
            <span class="text-sm sm:text-md text-yellow-500 bg-opacity-20 bg-yellow-600 font-bold border border-yellow-600 px-2 py-1 whitespace-nowrap">{{$job->salary}}</span>
        </div>
        @endif
        <div>
        <span class="text-sm sm:text-md text-lime-500 bg-opacity-20 bg-lime-600 font-bold border border-lime-600 px-2 py-1  whitespace-nowrap">
            @if ($job->location){{$job->location}},&nbsp;@endif{{$job->country}}
        </span>
        </div>
        @if ($job->job_type) 
        <div>
            <span class="text-sm sm:text-md text-sky-500 bg-opacity-20 bg-sky-600 font-bold border border-sky-600 px-2 py-1  whitespace-nowrap">{{$job->job_type}}</span>
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
