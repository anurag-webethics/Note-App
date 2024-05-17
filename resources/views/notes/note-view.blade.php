<x-app-layout>
    <div class="border-1 w-75 m-auto h-75 p-5">
        <p class="text-end" style="word-wrap:break-word">
            @if ($note->note_type == 'public')
                @php echo $note->share_link @endphp
            @endif
        </p>
        <h1 class="h2">{{ $note->title }}</h1>
        <span>{{ strip_tags($note->description) }}</span>
    </div>

</x-app-layout>
