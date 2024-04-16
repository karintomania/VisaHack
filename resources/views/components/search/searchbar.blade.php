@props([
    'errors',
])

<div class="w-full sm:w-4/5 lg:w-3/5 mb-12">
    <!-- search box -->
    <form class="w-full flex flex-col sm:flex-row justify-between gap-3 sm:gap-0" action="{{url('/')}}">
        <div class="bg-white border-neutral-300 border grow flex items-center">
            <span class="pl-2">🔍</span>
            <input class="px-2 py-3 grow outline-none" name="keywords" type="text" maxlength="50"
                placeholder="Keywords"
                value="@if(request()->input('keywords')){{request()->input('keywords')}}@endif"></input>
        </div>
        <div class="bg-white border-neutral-300 border grow flex items-center">
            <span class="pl-2">🌐</span>
            <select name="country" class="bg-white p-2 py-3 grow outline-none">
                  <option value="">Country</option>
                  @foreach(App\Enums\Countries::cases() as $country)
                      <option value="{{$country->value}}"
                            @if(request()->input('country') === $country->value) selected @endif>
                            {{$country->label()}}
                      </option>
                  @endforeach
            </select>
        </div>
        <input class="btn-main px-4 py-2" type="submit" value="Search"></input>
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
