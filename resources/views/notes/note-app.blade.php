<x-app-layout>

    <div class="container">
        <div class="d-flex justify-content-between" style="width:90%">
            <h1 class="h3">Manage Notes</h1>
            <!-- Button trigger modal -->
            <a href="{{ route('dashboard') }}" type="button" class="btn btn-success">Add Note</a>
        </div>

        <table class="table table-hover" style="width:100%">
            <thead>
                <tr>
                    <th scope="col" style="width:10%">Id</th>
                    <th scope="col" style="width:15%">Title</th>
                    <th scope="col" style="width:15%">Actions</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($notes as $note)
                    <td>{{ $note->id }}</td>
                    <td>{{ $note->title }}</td>
                    <td>
                        {{-- @if (empty($note->note_type === 'public')) --}}
                        <button class="btn btn-primary me-2"
                            onclick="window.location.href = '{{ route('note.view', ['id' => Crypt::encrypt($note->id)]) }}'">View</button>
                        <button class="btn btn-success me-2"
                            onclick="window.location.href = '{{ route('note.edit', ['id' => $note->id]) }}'">Edit</button>
                        <a href='{{ route('note.delete', ['id' => $note->id]) }}' class="btn btn-danger"
                            onclick="return confirm('Are you want to delete the user?')" type='submit'>Delete</a>
                    </td>
            </tbody>
            @endforeach
        </table>

    </div>

</x-app-layout>
