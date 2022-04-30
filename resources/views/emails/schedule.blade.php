<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <style>
        *{
            box-sizing: border-box;
        }

        html {
            background-color: #9dd3e9;
        }

        body {
            color: #272727;
            font-family: "Quicksand", serif;
            font-style: normal;
            font-weight: 400;
            letter-spacing: 0;
            padding: 1rem;
        }

        .main {
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            font-size: 24px;
            font-weight: 400;
            text-align: center;
        }

        img {
            height: auto;
            width: 90px;
            vertical-align: middle;
        }

        .btn {
            color: #ffffff;
            padding: 0.8rem;
            font-size: 14px;
            text-transform: uppercase;
            border-radius: 4px;
            font-weight: 400;
            display: block;
            width: 100%;
            cursor: pointer;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: transparent;
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .cards_item {
            display: flex;
            padding: 1rem;
        }

        .card {
            background-color: white;
            border-radius: 0.25rem;
            box-shadow: 0 20px 40px -14px rgba(0, 0, 0, 0.25);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .card_content {
            padding: 1rem;
            background-color: #ffffff;
        }

        .card_title {
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: capitalize;
            margin: 0px;
        }

        .card_text {
            color: #ffffff;
            font-size: 0.875rem;
            line-height: 1.5;
            margin-bottom: 1.25rem;
            font-weight: 400;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #333;
            color: white;
            font-weight: bold;
        }

        td, th {
            padding: 6px;
            border: 1px solid #ccc;
            text-align: left;
        }

    </style>

    <title>@lang("Schedule status") test</title>
</head>

<body>
    <div class="main">
        <h1>{{ __('Teacher abscent for the day') }}</h1>
        <div class="card">
            <div class="card_image">
                <img src="{{ asset($app_setting->logo) }}" alt="{{ $app_setting->name }}" />
            </div>
            <div class="card_content">
                <table>
                    <thead>
                        <tr>
                            <th>@lang('Teacher')</th>
                            <th>@lang('Faculty')</th>
                            <th>@lang('Date')</th>
                            <th>@lang('Hours')</th>
                            <th>@lang('Room')</th>
                            <th>@lang('Cours')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $schedule)
                            <tr>
                                <td>
                                    {{ $schedule->teacher->last_name }} {{ $schedule->teacher->first_name }}
                                </td>
                                <td>{{ $schedule->faculty->name }}</td>
                                <td>{{ $schedule->date }}</td>
                                <td>
                                    {{ substr($schedule->start_time, 0, 5) }} -
                                    {{ substr($schedule->end_time, 0, 5) }}</td>
                                <td>{{ $schedule->room->name }}</td>
                                <td>{{ $schedule->course->title }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
