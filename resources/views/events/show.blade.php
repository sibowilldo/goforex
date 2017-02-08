@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box">
                <div class="box-content">
                    <table id="user" class="table table-bordered table-striped table-force-topborder"
                           style="clear: both">
                        <tbody>
                        <tr>
                            <td width="25%">ID</td>
                            <td width="50%">
                                <a href="{{ url('events/'.$event->id.'/edit') }}">{{ $event->id }}</a>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%">Reference</td>
                            <td width="50%">
                                {{ $event->reference }}
                            </td>
                        </tr>
                        <tr>
                            <td width="25%">Name</td>
                            <td width="50%">
                               {{ $event->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>Host</td>
                            <td>
                                {{ $event->host }}
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>
                                {{ $event->address }}
                            </td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>
                                {{ $event->description }}
                            </td>
                        </tr>
                        <tr>
                            <td>Number Of Seats</td>
                            <td>
                                {{ $event->number_of_seats }}
                            </td>
                        </tr>
                        <tr>
                            <td>Start Date</td>
                            <td>
                                {{ $event->start_date }}
                            </td>
                        </tr>
                        <tr>
                            <td>End Date</td>
                            <td>
                                {{ $event->end_date }}
                            </td>
                        </tr>
                        <tr>
                            <td>Start Time</td>
                            <td>
                                {{ $event->start_time }}
                            </td>
                        </tr>
                        <tr>
                            <td>End Time</td>
                            <td>
                                {{ $event->end_time }}
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                {{ $event->status_is }}
                            </td>
                        </tr>
                        <tr>
                            <td>Created At</td>
                            <td>
                                {{ $event->created_at }}
                            </td>
                        </tr>
                        <tr>
                            <td>Updated At</td>
                            <td>
                                {{ $event->updated_at }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop