<x-app-layout>
    <span class="text-danger">
        @if (Session::has('error'))
            {{ session::get('error') }}
        @endif
    </span>

    <form action="{{ route('invite.user') }}" method="POST">
        @csrf
        <label for="email">Enter user email</label><br><br>
        <input type="text" name="email" id="email"><br><br>
        @error('email')
            <p class="text-danger">{{ $message }}</p><br>
        @enderror
        <button type="submit" class="btn btn-warning" name="submit">Submit</button><br><br>
    </form>

    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($collegues as $collegue)
                <td>{{ $collegue->id }}</td>
                <td>{{ $collegue->email }}</td>
                <td>{{ $collegue->status }}</td>
        </tbody>
        @endforeach
    </table>

</x-app-layout>
