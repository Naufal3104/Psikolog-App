{{-- resources/views/components/footer.blade.php --}}
<footer
    class="relative"
    :class="darkMode ? 'bg-gray-900 text-gray-400' : 'bg-white text-slate-900'"
>
    <div class="bb ze ki xn 2xl:ud-px-0">
        <div class="bh ch pm tc uf sf yo wf xf ap cg fp bj flex justify-center py-8">
            <div class="animate_top text-center">
                <p class="xl">
                    &copy; {{ now()->year }} Psikologi RSUD Jombang. All Rights Reserved.
                </p>
            </div>
        </div>
    </div>

    <!-- ====== Back To Top Start ===== -->
    <button class="xc wf xf ie ld vg sr gh tr g sa ta _a"
            @click="window.scrollTo({top: 0, behavior: 'smooth'})"
            @scroll.window="scrollTop = (window.pageYOffset > 50)"
            :class="{ 'uc' : scrollTop }">
        <svg class="uh se qd" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z"/>
        </svg>
    </button>
    <!-- ====== Back To Top End ===== -->
</footer>
