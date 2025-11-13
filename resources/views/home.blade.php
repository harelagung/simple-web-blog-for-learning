<x-layout :title='$title' :header='$header'>
    <p class="text-white">
        This is Home Page
    </p>
    {{-- <div class="flex mt-3">
        @for ($i = 1; $i <= 8; $i++)
            @if ($i % 2 === 0)
                <div class="w-8 h-8 bg-teal-500 text-white p-0 me-1 text-xs grid place-items-center">
                    {{ $i }}</div>
            @endif
        @endfor
    </div> --}}
</x-layout>
