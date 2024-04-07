<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
                <p class="text-lg">VisaHack is a job board specialised to find jobs in tech industry with visa sponsorships. You can find your dream job in your dream country.</p>
            </section>
            <section class="bg-white w-2/3  mb-8">
                <!-- search box -->
                <form class="w-full flex justify-between">
                    <div class="border-neutral-300 border grow flex items-center">
                        <span class="pl-2">🔍</span>
                        <input class="p-2 grow outline-none" type="text" placeholder="Keywords"></input>
                    </div>
                    <div class="border-neutral-300 border grow flex items-center">
                        <span class="pl-2">🌐</span>
                        <select class="p-2 grow outline-none">
                              <option value="">Country</option>
                              <option value="volvo">United Kingdom</option>
                              <option value="saab">United Sates</option>
                        </select>
                    </div>
                    <input class="bg-main text-white px-4 py-2" type="submit" value="Search"></input>
                </form>
            </section>
            <section class="flex justify-center w-2/3">
                <div class="w-full border border-neutral-300 bg-white px-6 py-4">
                    <div class="flex justify-between">
                        <h2 class="text-2xl text-neutral-600 font-bold underline">Senior PHP Developer</h2>
                        <a class="bg-main text-white px-4 py-2 bold">Apply</a>
                    </div>
                    <div class="mb-2">Posted at 2024/3/1 by Acme Company</div>
                    <div class="mb-4 text-lg flex gap-4">
                        <span>50,000 - 60,000 GBP</span>
                        <span>London</span>
                        <span>Full Time</span>
                    </div>
                    <div class="mb-4">
                        <p>Senior Web Developer Cardiff / WFH to 65k Do you have strong PHP backend development skills and exposure across the full tech stack? You could be progressing your career in a senior, hands-on role for a digital transformation consultancy / agency, wo...</p>
                    </div>
                    <div>
                        <a class="underline">Read more...</a>
                    </div>
                </div>
            </section>

        </main>
    </body>
</html>
