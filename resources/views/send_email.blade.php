<!-- resources/views/send_email.blade.php -->
@extends('admin.layout.layout')

@section('content')
<div class="container">
    <h1>Send Email</h1>
    <form action="{{ route('send.email') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="to">To:</label>
            <input type="email" class="form-control" id="to" name="to" required>
        </div>
        <div class="form-group">
            <label for="subject">Subject:</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
        </div>
        <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Email</button>
    </form>
</div>
@endsection
