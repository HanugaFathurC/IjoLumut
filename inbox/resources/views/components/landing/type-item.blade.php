@props(['type'])
<a href="{{ route('type.show', $type->slug) }}"
    class="min-w-full p-2 flex flex-row items-center gap-4 rounded-lg bg-white border border-l-4 border-l-sky-700 hover:scale-105 duration-100 lg:transition-transform  hover:border-l-sky-400 transition-colors group shadow-md">
    <img src="{{ $type->image }}" alt="{{ $type->name }}" class="object-cover w-10 rounded-lg">
    <div>
        <h2 class="text-base text-gray-700 ">{{ $type->name }}</h2>
    </div>
</a>
