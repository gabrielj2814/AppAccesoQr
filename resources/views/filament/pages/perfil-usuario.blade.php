<x-filament-panels::page>

<canvas id="qr"></canvas>

<a id="download-link" download="qrcode.png" href="#" style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);" class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action" type="button">
    <span class="fi-btn-label">
        Descargar QR
    </span>
</a>


<script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>
<script>
      (function() {

        let dataQR=@json($qrAcceso)

        // console.log("datos => ", dataQR)

        var qr = new QRious({
            // background: 'green',
            // backgroundAlpha: 0.8,
            // foreground: 'blue',
            foregroundAlpha: 0.8,
            level: 'H',
            // padding: 25,
            size: 500,
            element: document.getElementById('qr'),
            value: dataQR.token_qr
        });

        var downloadLink = document.getElementById('download-link');
        downloadLink.href = qr.toDataURL('image/png');
      })();
</script>


</x-filament-panels::page>
