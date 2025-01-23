@extends('layout')

@section('content')
    <p>Section 1</p>

    <input type="text" id="search" placeholder="Search items..." style="width: 100%; padding: 8px; margin-bottom: 16px;">

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Note</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data['items'] as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->status ? 'Available' : 'Out of Stock' }}</td>
                    <td>{{ $item->note ?? 'N/A' }}</td>
                    <td>{{ $item->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>{{ $item->updated_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">No items available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection