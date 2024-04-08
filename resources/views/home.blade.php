<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         @vite('resources/js/app.js')
         @vite('resources/css/app.css')

        <title>VisaHack</title>

    </head>
    <body class="text-neutral-500 bg-neutral-100">
        <header class="flex justify-between px-10 py-4 bg-white mb-20">
            <a href="/"><div class="bg-main text-white px-2 py-1 text-2xl font-bold">VisaHack</div></a>
            <div class="text-main text-xl flex flex-row gap-10">
                <a class="underline">Jobs</a>
                <a class="underline">Blogs</a>
            </div>
        </header>
        <main class="flex flex-col items-center">
            <section class="flex flex-col items-center w-1/2 mb-10">
                <!-- hero -->
                <h1 class="text-3xl text-neutral-600 font-bold mb-4">Work Anywhere with <span class="text-main">VisaHack</span></h1>
                <p class="text-lg">VisaHack is a job board specialised to discover tech jobs complemented by visa sponsorship. Land your dream job in your dream country.</p>
            </section>
            <section class="bg-white w-3/5  mb-12">
                <!-- search box -->
                <form action="{{url('/')}}" class="w-full flex justify-between">
                    <div class="border-neutral-300 border grow flex items-center">
                        <span class="pl-2">🔍</span>
                        <input class="px-2 py-3 grow outline-none" name="keywords" type="text" maxlength="50"
                            placeholder="Keywords (comma[,] for multiple keywords)"
                            value="@if(request()->input('keywords')){{request()->input('keywords')}}@endif"></input>
                    </div>
                    <div class="border-neutral-300 border grow flex items-center">
                        @use('App\Enums\Countries')
                        <span class="pl-2">🌐</span>
                        <select name="country" class="p-2 py-3 grow outline-none">
                              <option value="">Country</option>
                              @foreach(Countries::cases() as $country)
                                  <option value="{{$country->value}}"
                                        @if(request()->input('country') === $country->value) selected @endif>
                                        {{$country->label()}}
                                  </option>
                              @endforeach
                        </select>
                    </div>
                    <input class="bg-main text-white px-4 py-2" type="submit" value="Search"></input>
                </form>
                @if ($errors->any())
                    <div class="bg-red-200 px-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
             </section>
            <div class="w-3/5 border border-neutral-300 mb-12"></div>
            <section class="flex flex-col items-center gap-6 w-2/3 mb-10">
                @foreach ($jobs as $job)
                <div class="w-full border border-neutral-300 bg-white px-6 py-4">
                    <div class="flex justify-between items-start">
                        <h2 
                            class="text-2xl text-neutral-600 font-bold underline cursor-pointer"
                            onClick='search.toggleDetail({{$job->id}})'>{{ $job->title }}</h2>
                        <a class="bg-main text-white px-4 py-2 bold">Apply</a>
                    </div>
                    <div class="mb-2">Posted at {{substr($job->created_at, 0, 10)}} by {{$job->company}}</div>
                    <div class="mb-4 flex gap-4">
                        @if ($job->salary)
                            <span class="bg-orange-100 px-1">{{$job->salary}}</span>
                        @endif
                        <span class="bg-teal-100 px-1">
                            @if ($job->location){{$job->location}},&nbsp;@endif{{$job->country}}
                        </span>
                        @if ($job->job_type) 
                            <span class="bg-lime-100 px-1">{{$job->job_type}}</span>
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
                </div>
                @endforeach
                {{$jobs->links()}}
            </section>

        </main>
    </body>
</html>
