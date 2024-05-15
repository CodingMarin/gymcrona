<div class="card-header d-flex justify-content-between align-items-center" style="gap: 5px">
    <div class="input-group input-group-sm border rounded w-auto">
        <span class="input-group-text border-0 font-sm rounded-0">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                <path d="M21 21l-6 -6" />
            </svg>
        </span>
        <input type="text" class="font-sm form-control border-0" placeholder="Buscar producto" aria-label="search"
            onkeyup="filtrarProducto(this.value)">
    </div>
    <button type="button" data-toggle="modal" data-target="#agregarProductoModal"
        class="ml-auto w-auto btn btn-primary font-sm d-sm-none">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M14 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
            <path d="M12 9.765a3 3 0 1 0 0 4.47" />
            <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
        </svg>
    </button>
    <button type="button" data-toggle="modal" data-target="#agregarProductoModal"
        class="ml-auto w-auto btn btn-primary btn-sm font-sm d-none d-sm-inline-flex">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M14 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
            <path d="M12 9.765a3 3 0 1 0 0 4.47" />
            <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
        </svg>
        &nbsp;Registrar producto
    </button>
</div>
