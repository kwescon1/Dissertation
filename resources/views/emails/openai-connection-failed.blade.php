<x-mail::message>
    # Error

    There was an error connecting to Open AI service. The error has been specified below.

    Error: {{ $message }}

    Time of error: {{ $errorTime }}

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
