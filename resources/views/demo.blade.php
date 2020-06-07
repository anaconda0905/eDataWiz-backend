@extends('frontLayout.app')
@section('title')
Demo
@stop

@section('style')

@stop
@section('content')
<!-- Banner area -->
<section class="banner_area" data-stellar-background-ratio="0.5">
    <h2>Demo</h2>
    <ol class="breadcrumb">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="#" class="active">Demo</a></li>
    </ol>
</section>
<!-- End Banner area -->

<!-- Map -->
<div class="contact_map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d44479.89286998154!2d103.82086451198887!3d1.363127751268099!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1591332998906!5m2!1sen!2sus" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>
<!-- End Map -->

<!-- All contact Info -->
<section class="all_contact_info">
    <div class="container">
        <div class="row contact_row">
            <div class="col-sm-6 contact_info">
                <h2>Contact Info</h2>
                <p>
                    We're open for any suggestion or just to have a chat. Let's get in touch. Your message was sent, thank you!
                </p>
                <div class="location">
                    <div class="location_laft">
                        <a class="f_location" href="#">location</a>
                        <a href="#">phone</a>
                        <a href="#">fax</a>
                        <a href="#">email</a>
                    </div>
                    <div class="address">
                        <a href="#">2 Venture Drive, #10-04,
                            Vision Exchange, <br />Singapore - 608526</a>
                        <a href="#">(+65) 6899 5782 or 86996780</a>
                        <a href="#">(+65)6564 0790</a>
                        <a href="#">info@edatawiz.com</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 contact_info send_message">
                <h2>Send Us a Message</h2>
                <form class="form-inline contact_box">
                    <input type="text" class="form-control input_box" placeholder="Full Name *">
                    <!-- <input type="text" class="form-control input_box" placeholder="Last Name *"> -->
                    <input type="text" class="form-control input_box" placeholder="Your Email *">
                    <!-- <input type="text" class="form-control input_box" placeholder="Subject"> -->
                    <!-- <input type="text" class="form-control input_box" placeholder="Your Website"> -->
                    <textarea class="form-control input_box" placeholder="Message"></textarea>
                    <button type="submit" class="btn btn-default">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End All contact Info -->

@endsection

@section('scripts')


@endsection