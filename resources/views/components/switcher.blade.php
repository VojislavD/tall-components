@props(['label' => null])

<div 
    x-data="{ active: @entangle($attributes->wire('model')) }" 
    @click="active = !active" 
    class="flex items-center space-x-2 cursor-pointer"
>
    @if ($label)
        <span>
            {{ $label }}
        </span>
    @endif
    
    <div 
        class="relative w-12 h-6 bg-gray-300 rounded-full" 
        :class="{ 'bg-primary' : active }"
    >
        <label 
            class="absolute left-0 w-6 h-6 bg-white border-2 rounded-full transition duration-100 ease-linear cursor-pointer" 
            :class=" active ? 'translate-x-full' : 'translate-x-0'"
        ></label>
    </div>
</div>
