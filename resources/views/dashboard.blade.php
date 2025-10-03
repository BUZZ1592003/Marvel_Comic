@extends('layouts.app')

@section('title','Dashboard')

@section('header')
  <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Marvel Universe Dashboard') }}
  </h2>
@endsection

@section('content')
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <h3 class="text-2xl font-bold mb-4">
            Welcome to Marvel Comics, {{ auth()->user()->name }}!
          </h3>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-red-600 text-white p-6 rounded-lg text-center">
              <h4 class="text-xl font-bold">📚 Series</h4>
              <a href="{{ route('series.index') }}" class="inline-block mt-2 bg-white text-red-600 px-4 py-2 rounded">Browse Series</a>
            </div>
            <div class="bg-blue-600 text-white p-6 rounded-lg text-center">
              <h4 class="text-xl font-bold">📖 Comics</h4>
              <a href="{{ route('comics.index') }}" class="inline-block mt-2 bg-white text-blue-600 px-4 py-2 rounded">Read Comics</a>
            </div>
            <div class="bg-yellow-600 text-white p-6 rounded-lg text-center">
              <h4 class="text-xl font-bold">🦸 Characters</h4>
              <a href="{{ route('characters.index') }}" class="inline-block mt-2 bg-white text-yellow-600 px-4 py-2 rounded">Meet Heroes</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
