<div class="flex items-center space-x-2">
    <label for="tcPerPage">{{ __('Per page:') }}</label>
    <select 
        wire:model.live="tcPerPage" 
        id="tcPerPage"
        class="rounded focus:outline-none focus:ring-0 border-gray-300 focus:border-primary py-1.5"
    >
        @foreach ($options as $option)
            <option value="{{ $option }}">{{ $option }}</option>
        @endforeach
    </select>
</div>
