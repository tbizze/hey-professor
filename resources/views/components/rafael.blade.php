@props(['title' => 'Título padrão'])
<div class=" bg-white mt-4 rounded-lg p-4 mb-4">
    <div class=" text-black font-bold uppercase pt-1">{{ $title }}</div>
    <div class="text-lg text-red-600 bg-slate-50 font-bold border-2 border-red-300 px-4 py-1 rounded my-2">
        {{ $slot ?: 'Hello' }}
    </div>
</div>
