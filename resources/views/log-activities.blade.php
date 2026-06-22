@extends('layouts.admin')
@section('title','Log Aktivitas')
@section('content')
<main class="p-gutter lg:p-xl relative overflow-x-hidden custom-scrollbar">
    <div class="absolute inset-0 batik-overlay bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
    <div class="max-w-6xl mx-auto space-y-lg relative z-10">
        <div class="flex justify-end mb-4 space-x-2">
            <form action="{{ route('logs.index') }}" method="GET" class="flex items-center">
                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Search" class="border border-outline-variant/20 rounded-l-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary" />
                <button type="submit" class="bg-primary text-on-primary px-4 py-2 rounded-r-md hover:bg-primary/90 transition-colors flex items-center">
                    <span class="material-symbols-outlined mr-1">search</span>
                </button>
                <button type="button" onclick="window.location.href='{{ route('logs.index') }}'" class="ml-2 bg-secondary text-on-secondary px-4 py-2 rounded-md hover:bg-secondary/90 transition-colors flex items-center">
                    <span class="material-symbols-outlined mr-1">refresh</span>
                </button>
            </form>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-outline-variant">
                <thead class="bg-surface-container-low">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-on-surface-variant">No</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-on-surface-variant">Time</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-on-surface-variant">Subject</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-on-surface-variant">URL</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-on-surface-variant">Action By</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-outline-variant/10">
                    @forelse($data as $log => $result)
                        <tr>
                            <td class="px-4 py-2 text-sm text-on-surface">{{ $log + $data->firstitem() }}</td>
                            <td class="px-4 py-2 text-sm text-primary"><small>{{ \Carbon\Carbon::parse($result->created_at)->diffForHumans() }}</small></td>
                            <td class="px-4 py-2 text-sm text-on-surface">{{ $result->subject }}</td>
                            <td class="px-4 py-2 text-sm text-warning"><small>{{ $result->url }}</small></td>
                            <td class="px-4 py-2 text-sm text-on-surface">
                                {{ $result->users && $result->users->santris ? $result->users->santris->name : 'N/A' }}<br>
                                <small class="text-info">{{ $result->users->email }}</small>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-4 text-center text-on-surface-variant">Tidak ada data.</td>
                            </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6 flex justify-center">
            {{ $data->links() }}
        </div>
    </div>
</main>
@endsection