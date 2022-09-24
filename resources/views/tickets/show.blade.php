@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">Ticket #{{ $ticket->id }}</div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    Offender's Name
                                </th>
                                <td>
                                    {{ $ticket->title }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Offender's Email
                                </th>
                                <td>
                                    {{ $ticket->author_email }}

                                </td>
                            </tr>
                            <tr>
                                <th>
                                   NID
                                </th>
                                <td>
                                    {{ $ticket->nid }}

                                </td>
                            </tr>
                            <tr>
                                <th>
                                Location
                                </th>
                                <td>
                                    {{ $ticket->location }}

                                </td>
                            </tr>
                            <tr>
                                <th>
                                Vehicle Number
                                </th>
                                <td>
                                    {{ $ticket->vehicleNum }}

                                </td>
                            </tr>
                            <tr>
                                <th>
                                licence Number
                                </th>
                                <td>
                                    {{ $ticket->licence }}

                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Description
                                </th>
                                <td>
                                    {!! $ticket->content !!}

                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.ticket.fields.attachments') }}
                                </th>
                                <td>
                                    @foreach($ticket->attachments as $attachment)
                                        <a href="{{ $attachment->getUrl() }}">{{ $attachment->file_name }}</a>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.ticket.fields.status') }}
                                </th>
                                <td>
                                    {{ $ticket->status->name ?? '' }}
                                </td>

                            </tr>
                            <tr>
                                <th>
                                    Amount To Pay
                                </th>
                                <td>
                                    Rs {{ $ticket->category->amount ?? '' }}
                                </td>
                            </tr>

                            @auth
                            <tr>
                                <th>
                                    {{ trans('cruds.ticket.fields.comments') }}
                                </th>
                                <td>
                                    @forelse ($ticket->comments as $comment)
                                        <div class="row">
                                            <div class="col">
                                                <p class="font-weight-bold"><a href="mailto:{{ $comment->author_email }}">{{ $comment->author_name }}</a> ({{ $comment->created_at }})</p>
                                                <p>{{ $comment->comment_text }}</p>
                                            </div>
                                        </div>
                                        @if(!$loop->last)
                                            <hr />
                                        @endif
                                    @empty
                                        <div class="row">
                                            <div class="col">
                                                <p>There are no comments.</p>
                                            </div>
                                        </div>
                                    @endforelse
                                </td>
                            </tr>
                            @endauth
                        </tbody>
                    </table>
                    <form action="{{ route('tickets.storeComment', $ticket->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="comment_text">If you want to dispute this ticket, comment your reasons down below: </label>
                            <textarea class="form-control @error('comment_text') is-invalid @enderror" id="comment_text" name="comment_text" rows="3" required></textarea>
                            @error('comment_text')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">@lang('global.submit')</button>
                        <a class="btn btn-success float-right" href="{{ route("tickets.makePayment", $ticket->id) }}"> Proceed to payment </a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
