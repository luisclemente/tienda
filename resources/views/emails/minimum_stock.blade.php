@component('mail::message')
# Producto bajo minimos.

Producto: {{ $product->name }}
<br>
Stock: {{ $product->stock }}

@component('mail::button', ['url' => url('/')])
Ir a la tienda
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
