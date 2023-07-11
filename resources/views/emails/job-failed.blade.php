<x-mail::message>
    # A job failed

    Job Class : {{ $event->job->resolveName() }}

    Job Body : {{ $event->job->getRawBody() }}

    Exception : {{ $event->exception->getTraceAsString() }}

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
