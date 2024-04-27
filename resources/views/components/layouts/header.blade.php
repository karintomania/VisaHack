<header class="bg-base mb-20">
    <div class="hidden sm:flex justify-between px-10 py-4 shadow-lg shadow-cyan-500/20">
        <div><a href="/" class="text-main px-4 py-2 font-bold text-2xl">VisaHack</a></div>
        <div class="text-main text-xl flex flex-col sm:flex-row gap-2 sm:gap-10">
            <a class="underline shadow-cyan-500/50" href="{{url('/')}}">Jobs</a>
            <a class="underline" href="{{url('/blogs')}}">Blogs</a>
        </div>
    </div>
    <div class="flex sm:hidden flex-col px-5 py-2 shadow-lg shadow-cyan-500/20">
        <div class="flex justify-between">
            <div><a href="/" class="text-main px-2 py-1 text-2xl font-bold">VisaHack</a></div>
            <div id="show-nav-list" class="cursor-pointer text-xl text-main font-bold" onClick="header.toggleNavList()">...</div>
            <div id="hide-nav-list" class="hidden cursor-pointer text-main text-xl font-bold" onClick="header.toggleNavList()">X</div>
        </div>
        <div id="nav-list" class="hidden text-main text-xl flex flex-col text-center">
            <a class="underline py-3" href="{{url('/')}}">Jobs</a>
            <a class="underline py-3" href="{{url('/blogs')}}">Blogs</a>
        </div>
    </div>
</header>
