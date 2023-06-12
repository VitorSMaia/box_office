<div>
    <div class="fixed right-0 top-0 m-5" x-data="{ open: @entangle('show') }">
        <div x-show="open"
             @click.outside="open=false"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="flex items-center gap-x-2 bg-gray-400 border-l-4 border-gray-700 py-2 px-3 shadow-md mb-2">
            <!-- icons -->
            <span class="material-symbols-outlined text-white  rounded-full text-3xl">
                {{ $icon ?? '' }}
            </span>
            <!-- message -->
            <div class="text-white max-w-xs">
                {{ $message ?? ''}}
            </div>
        </div>
    </div>
</div>

