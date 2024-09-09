<x-layouts.base>
    <section class="flex flex-col items-center w-full mb-4 md:mb-10 px-4 md:px-16">
        <!-- hero -->
        <div class="w-full md:w-3/5 text-center">
            <h1 class="text-2xl sm:text-3xl md:text-4xl text-grad font-bold mb-10">
                Create an Account
            </h1>
            <p>By creating signing in, you understand and agree to our Terms. You also acknowledge our Privacy policies.</p>
        </div>
    </section>
    <section class="w-full flex flex-col items-center px-2">
        <form class="w-full md:w-2/5 xl:w-1/5 flex flex-col items-center">
            <x-form.text 
                    :icon="'✉️'"
                    :name="'email'"
                    :placeHolder="'Email'"
                    :maxLength="100"
                    :value="request()->input('email')?:''"
                    class="w-full grow mb-4"
                ></x-form.text>
            <x-form.text 
                :type="'password'"
                :icon="'🔑'"
                :name="'password'"
                :placeHolder="'Password'"
                :maxLength="100"
                :value="request()->input('email')?:''"
                class="w-full grow mb-4"
                ></x-form.text>

            <input class="block btn-main px-4 py-2" type="submit" value="Sign In"></input>
        </form>
    </section>
</x-layouts.base>
