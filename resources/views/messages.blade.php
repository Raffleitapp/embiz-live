@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold text-gray-900 mb-6">Messages</h1>
        
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="text-center py-8">
                <div class="text-6xl text-gray-300 mb-4">📧</div>
                <h2 class="text-xl font-semibold text-gray-900 mb-2">No Messages Yet</h2>
                <p class="text-gray-600 mb-6">
                    Your messages will appear here once you start receiving them.
                </p>
                <button class="text-white py-2 px-4 rounded-md hover:opacity-90 transition duration-150"
                        style="background-color: #006C5F;">
                    Compose Message
                </button>
            </div>
        </div>
    </div>
</div>
@endsection