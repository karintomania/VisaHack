<header class="bg-base z-20 relative sm:fixed w-full">
    <div class="hidden sm:flex items-center justify-between px-10 py-4 shadow-lg shadow-cyan-500/20">
        <a href="/" class="flex items-center gap-2">
            <div class="font-bold text-2xl text-grad">VisaHack</div>
            <img class="block h-10" src="{{url('/images/home/icon.svg')}}" />
        </a>
        <div class="text-main text-xl flex flex-col sm:flex-row gap-2 sm:gap-10">
            <a class="hover:text-secondary" href="{{url('/search')}}">Jobs</a>
            <a class="duration-500 hover:text-secondary" href="{{url('/blogs')}}">Blogs</a>
        </div>
    </div>
    <div class="flex sm:hidden flex-col px-5 py-2 shadow-lg shadow-cyan-500/20">
        <div class="flex justify-between">
            <a href="/" class="flex items-center gap-2">
                <div class="font-bold text-2xl text-grad">VisaHack</div>
                <img class="block h-10" src="{{url('/images/home/icon.svg')}}" />
            </a>
            <div id="show-nav-list" class="cursor-pointer text-xl text-main font-bold" onClick="header.toggleNavList()">...</div>
            <div id="hide-nav-list" class="hidden cursor-pointer text-main text-xl font-bold" onClick="header.toggleNavList()">X</div>
        </div>
        <div id="nav-list" class="hidden text-main text-xl flex flex-col text-center">
            <a class="py-3" href="{{url('/search')}}">Jobs</a>
            <a class="py-3" href="{{url('/blogs')}}">Blogs</a>
        </div>
    </div>
</header>
