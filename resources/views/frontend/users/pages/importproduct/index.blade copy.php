@extends('frontend.users.layouts.master')

<!-- Add Title Here particular page wise -->
@section('title')
{{ 'Tejarh - User Profile' }}
@endsection
@section('content')
<div class="table-responsive">
<table class="table">
        @foreach ($csv_data as $row)
            <tr>
            @foreach ($row as $key => $value)
                <td>{{ $value }}</td>
            @endforeach
            </tr>
        @endforeach
    </table>
</div>

@endsection
@section('script')
<script></script>
@endsection