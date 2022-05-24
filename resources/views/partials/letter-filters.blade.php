<form id="letters-filter" class="w-full mb-5 md:w-3/12 md:pr-6" autocomplete="off">
    @foreach ($select as $item)
        <label for="{{ $item['role'] }}" class="block mb-1 text-red-700 uppercase">
            {{ $item['label'] }}
        </label>
        <select x-data="ajaxChoices({ url: '{{ $item['searchUrl'] }}', element: $el })" x-init="initSelect()" id="{{ $item['role'] }}" class="mb-4"
            x-model="formData.{{ $item['role'] }}"></select>
    @endforeach
    <label for="from-year" class="block mb-1 text-red-700 uppercase">From</label>
    <input type="number" x-model="formData.after" class="w-full p-2 mb-4 bg-gray-100 border border-gray-300 rounded-sm"
        id="from-year">
    <label for="to-year" class="block mb-1 text-red-700 uppercase">To</label>
    <input type="number" x-model="formData.before" class="w-full p-2 mb-4 bg-gray-100 border border-gray-300 rounded-sm"
        id="to-year">
    <button @click="submit" type="button"
        class="inline-flex items-center justify-center w-full px-6 py-2 text-white uppercase bg-red-700 border border-red-700 rounded-sm">
        <svg x-show="loading" class="w-5 h-5 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
        </svg>
        <span>{{ __('Vyhledat', 'hiko') }}</span>
    </button>
</form>
