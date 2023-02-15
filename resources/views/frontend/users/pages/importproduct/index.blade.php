@extends('frontend.users.layouts.master')

@section('title')
{{ 'Tejarh - User New Items' }}
@endsection

@section('content')
<div class="my-items-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend.users.site.index')}}"><i class="fas fa-home"></i> @lang('frontend-messages.header2.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('frontend-messages.conditions.new_items')</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="pagination-hidden-section">
                <input type='hidden' id='current_page' />
                <input type='hidden' id='show_per_page' />
            </div>
        </div>
        <div class="products-wrapper">
            <form action="{{route('frontend.users.pages.importproduct.import')}}" method="POST">
            @csrf
            <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}" />
            <div class="table-responsive">
                <table class="table">
                    @if (isset($headings))
                    <thead>
                        <tr>
                            @foreach ($headings[0][0] as $csv_header_field)
                            {{-- @dd($headings)--}}
                            <th class="px-6 py-3 bg-gray-50">
                                <span class="text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">{{ $csv_header_field }}</span>
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    @endif
                    <tbody>
                        @foreach ($csv_data as $row)
                        <tr>
                            @foreach ($row as $key => $value)
                            <td>{{ $value }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="form-group submit">
                <input type="submit" class="btn btn-primary" value="Import" style="width: 169px;">
            </div>
        </form>
    </div>
    </div>
</div>

<div class="try-tejarg-app-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/try-tejarg-app.png') }}">
            </div>
            <div class="col-md-7">
                <div class="mo-application">
                    <h2>@lang('frontend-messages.header.try_the_tejrah_app')</h2>
                    <p>@lang('frontend-messages.header.try_the_tejrah_app_sub_text')</p>
                    <ul>
                        <li>
                            <a target="_blank" href="https://www.google.com/"><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/google-play.png') }}">
                            </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://www.google.com/"><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/app-store.png') }}">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection