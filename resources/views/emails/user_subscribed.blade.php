@component('mail::message')
    # {{ __("Nuevo Subscriptor!") }}

    {{ __("Enhorabuena :user_name te has inscrito en la suscripción :plan_type",
                ['user_name' => $user_name, 'plan_type' => $plan_type]) }}

    @component('mail::button', ['url' => url('/' ), 'color' => 'red'])
        {{ __("Ir a la web") }}
    @endcomponent

    {{ __("Gracias") }},<br>
    {{ config('app.name') }}

@endcomponent