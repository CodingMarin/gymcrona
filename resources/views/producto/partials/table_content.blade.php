<table class="table table-hover" id="productos">
    <thead>
        <tr class="border-bottom">
            <th scope="col" class="font-sm">Nº</th>
            <th scope="col" class="font-sm">Imagen</th>
            <th scope="col" class="font-sm">Nombre</th>
            <th scope="col" class="font-sm">Descripcion</th>
            <th scope="col" class="font-sm">Precio</th>
            <th scope="col" class="font-sm">Stock</th>
            <th scope="col" class="font-sm">Marca</th>
            <th scope="col" class="font-sm">Estado</th>
            <th scope="col" class="font-sm">Categoria</th>
            <th scope="col" class="font-sm text-center">Acción</th>
        </tr>
    </thead>
    @php $i = 0 @endphp
    @foreach ($productos as $producto)
        @php $i++ @endphp
        <tbody>
            <tr class="">
                <td scope="row">{{ $i }}</td>
                <td class="font-sm">
                    <picture>
                        <img width="50" src="{{ asset('images/productos/' . $producto->foto_url) }}"
                            alt="{{ $producto->foto_url }}">
                    </picture>
                </td>
                <td class="font-sm">{{ $producto->nombre }}</td>
                <td class="font-sm">{{ $producto->descripcion }}</td>
                <td class="font-sm">S/. {{ $producto->precio }}</td>
                <td class="font-sm">
                    @if ($producto->stock > 0)
                        <span>{{ $producto->stock }} en stock</span>
                    @else
                        <span class="text-danger">{{ $producto->stock }} en stock</span>
                    @endif
                </td>
                <td class="font-sm">{{ $producto->marca }}</td>
                <td>
                    @if ($producto->estado == 1)
                        <span class="badge badge-success font-weight-normal">Activo</span>
                    @else
                        <span class="badge badge-danger font-weight-normal">Inactivo</span>
                    @endif
                </td>
                <td>{{ $producto->categoriaProducto->nombre }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Actions">
                        <a href="{{ route('producto.edit', $producto->id) }}"
                            class="mr-1 btn btn-success btn-sm rounded font-sm rounded">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                <path d="M13.5 6.5l4 4" />
                                <path d="M16 19h6" />
                            </svg>
                        </a>
                        <button type="button" data-toggle="modal" data-target="#eliminarProductoModal"
                            data-id="{{ $producto->id }}" class="btn btn-danger btn-sm font-sm w-100 rounded">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 7l16 0" />
                                <path d="M10 11l0 6" />
                                <path d="M14 11l0 6" />
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    @endforeach
</table>
