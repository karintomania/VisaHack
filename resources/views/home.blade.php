<x-layouts.base>
    <section class="flex flex-col items-center w-full md:w-1/2 mb-4 md:mb-20">
        <!-- hero -->
        <h1 class="text-2xl mb-4 text-center font-bold">
            <div class="text-gray-300 mb-2 block sm:inline">Work Anywhere with</div>
            <div class=" block sm:inline text-3xl text-main">VisaHack</div>
        </h1>
        <img class="block w-full sm:w-3/5" src="../images/home/plane.png">
    </section>
    <x-search.searchbar :errors="$errors"/>
</x-layouts.base>
