@props([
    'errors',
])

<div class="w-full text-gray-400">
    <!-- search box -->
    <form class="w-full flex flex-col sm:flex-row justify-between gap-3 sm:gap-0" action="{{url('/search')}}">
        <x-form.text 
            :icon="'🔍'"
            :name="'keywords'"
            :placeHolder="'Keywords'"
            :maxLength="50"
            :value="request()->input('keywords')?:''"
            class="grow"
        ></x-form.text>
        <div class="bg-base border-main border grow flex items-center">
            <span class="pl-2 md:pl-3">🌐</span>
            <select name="country" class="bg-base p-2 py-3 grow outline-none">
                  <option class="" value="">Country</option>
                  @foreach(App\Enums\Countries::cases() as $country)
                      <option value="{{$country->value}}"
                            @if(request()->input('country') === $country->value) selected @endif>
                            {{$country->label()}}
                      </option>
                  @endforeach
            </select>
        </div>
        <x-form.submit :value="'Search'" />
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
 </div>
