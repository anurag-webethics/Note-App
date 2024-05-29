<header class="bg-white dark:bg-gray-800 shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h3>Note App</h3>
    </div>
</header>
<div style="border: 1px solid grey;
margin: 0 20%;
padding: 50px;">
    <div class="border-1 w-75 m-auto h-50 p-5">
        <h1 class="h2">{{ $note->title }}</h1>
        <span>{!! $note->description !!}</span>
    </div>
</div>
