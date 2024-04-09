<header class="bg-white mb-20">
    <div class="hidden sm:flex justify-between px-10 py-4">
        <div><a href="/" class="bg-main text-white px-2 py-1 text-2xl font-bold">VisaHack</a></div>
        <div class="text-main text-xl flex flex-col sm:flex-row gap-2 sm:gap-10">
            <a class="underline" href="{{url('/')}}">Jobs</a>
            <a class="underline" href="{{url('/blogs')}}">Blogs</a>
        </div>
    </div>
    <div class="flex sm:hidden flex-col px-5 py-2">
        <div class="flex justify-between">
            <div class="mb-2"><a href="/" class="bg-main text-white px-2 py-1 text-2xl font-bold">VisaHack</a></div>
            <div id="show-nav-list" class="cursor-pointer text-xl font-bold" onClick="header.toggleNavList()">...</div>
            <div id="hide-nav-list" class="hidden cursor-pointer text-xl font-bold" onClick="header.toggleNavList()">X</div>
        </div>
        <div id="nav-list" class="hidden text-main text-xl flex flex-col text-center">
            <a class="underline border border-neutral-200" href="{{url('/')}}">Jobs</a>
            <a class="underline border border-neutral-200" href="{{url('/blogs')}}">Blogs</a>
        </div>
    </div>
</header>
