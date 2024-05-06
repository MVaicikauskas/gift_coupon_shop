<x-mail::message>
    # Test

    This is test email

{{--    <x-mail::button :url="$url">--}}
{{--        View Order--}}
{{--    </x-mail::button>--}}

    Thanks,<br>
    {{ $project->{\App\Models\Project::COL_NAME} }}
</x-mail::message>
