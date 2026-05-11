<div class="flex items-center gap-3">
    @if(file_exists(public_path('images/tensai-logo.png')))
        <img src="{{ asset('images/tensai-logo.png') }}" alt="Tensai" class="h-10 w-10 rounded-full object-contain" />
    @endif
    <div class="flex flex-col leading-tight">
        <span class="text-lg font-bold tracking-wide text-primary-600 dark:text-primary-400">TENSAI</span>
        <span class="text-[10px] font-medium tracking-widest text-gray-500 uppercase">Admin Portal</span>
    </div>
</div>
