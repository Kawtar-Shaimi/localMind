@props(['type', 'message'])

@if ($type === 'error')
    <div class="w-1/2 mx-auto mb-10 bg-red-500 text-white font-bold rounded-lg p-3 border border-black hover:border-white transition-colors duration-200">
        {{ $message }}
    </div>
@else
    <div class="w-1/2 mx-auto mb-10 bg-green-500 text-white font-bold rounded-lg p-3 border border-black hover:border-white transition-colors duration-200">
        {{ $message }}
    </div>
@endif
