<x-layouts.base>
    <section class="flex flex-col md:flex-row items-center w-full mb-4 md:mb-20 px-4 md:px-20">
        <!-- hero -->
        <div class="w-full md:w-3/5">
            <h1 class="text-2xl font-bold mb-4">
                <div class="text-xl md:text-3xl text-gray-300 mb-2">Looking for</div>
                <div class="text-3xl sm:text-4xl md:text-6xl text-grad
                    ">A Tech Job Aborad?</div>
            </h1>
            <p class="text-md sm:text-lg">VisaHack is a job board specialised to discover tech jobs complemented by visa sponsorship. Land your dream job in your dream country.</p>
        </div>
        <img class="block w-4/5 md:w-2/5" src="../images/home/plane.png">
    </section>
    <section class="w-full bg-base-light flex flex-col items-center py-16 mb-20 px-2">
        <h2 class="mb-10 font-bold text-grad text-2xl md:text-3xl ">Search Your Dream Job Now</h2>
        <p class="text-md md:text-xl mb-10">There are <span class="text-gray-300 font-bold">{{$count}}</span> jobs with sponsorship available</p>
        <div class="w-full sm:w-4/5 lg:w-3/5 mb-12">
        <x-search.searchbar :errors="$errors"/>
        </div>
    </section>
</x-layouts.base>
