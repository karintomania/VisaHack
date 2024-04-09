<x-layouts.base>
    <section class="flex flex-col items-center w-full sm:w-1/2 mb-10">
        <!-- hero -->
        <h1 class="text-3xl text-neutral-600 font-bold mb-4">Work Anywhere with <span class="text-main">VisaHack</span></h1>
        <p class="text-lg">VisaHack is a job board specialised to discover tech jobs complemented by visa sponsorship. Land your dream job in your dream country.</p>
    </section>
    <x-search.searchbar :errors="$errors"/>
    <x-search.result :jobs="$jobs"/>
</x-layouts.base>
