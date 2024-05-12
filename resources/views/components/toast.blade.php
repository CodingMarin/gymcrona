<div class="position-fixed bottom-0 right-0 p-3 rounded hide w-100" style="z-index: 9999; right: 0; bottom: 0;">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-body align-items-center d-flex rounded" style="background:#FFFCF0; color: #DC7609;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 9v4" />
                <path
                    d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                <path d="M12 16h.01" />
            </svg>
            {{ $slot }}
        </div>
    </div>
</div>
