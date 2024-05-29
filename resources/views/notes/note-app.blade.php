<x-app-layout>
    @section('title')
        Notes
    @endsection
    <div class="container">
        <div class="d-flex justify-content-between" style="width:90%">
            <h1 class="h3">Manage Notes</h1>
            <!-- Button trigger modal -->
            <a href="{{ route('note.create') }}" type="button" class="btn btn-success">Add Note</a>
        </div>

        <table class="table table-hover" style="width:100%">
            <thead>
                <tr>
                    <th scope="col" style="width:10%">Id</th>
                    <th scope="col" style="width:15%">Title</th>
                    <th scope="col" style="width:15%">Status</th>
                    <th scope="col" style="width:15%">Actions</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($notes as $note)
                    <td>{{ $note->id }}</td>
                    <td>{{ $note->title }}</td>
                    <td>{{ $note->note_type }}</td>
                    <td>
                        {{-- @if (empty($note->note_type === 'public')) --}}
                        <a href="{{ route('note.show', ['note' => $note->id]) }}" class="btn btn-primary me-2">View</a>
                        <a href="{{ route('note.edit', ['note' => $note->id]) }}" class="btn btn-success me-2">Edit</a>
                        <form method="POST" action="{{ route('note.destroy', ['note' => $note->id]) }}"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"
                                onclick="return confirm('Are you want to delete the user?')">Delete</button>
                        </form>
                    </td>
            </tbody>
            @endforeach
        </table>

    </div>

</x-app-layout>
