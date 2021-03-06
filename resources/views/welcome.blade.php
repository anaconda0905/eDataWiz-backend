@extends('frontLayout.app')
@section('title')
Home Page
@stop

@section('style')

@stop
@section('content')


<!-- Slider area -->
<section class="slider_area row m0">
    <div class="slider_inner">
        <div data-thumb="images/slider-1.jpg" data-src="images/slider-1.jpg">
            <div class="camera_caption">
                <div class="container">
                    <h5 class=" wow fadeInUp animated">Thinking Ahead with AI </h5>
                    <h3 class=" wow fadeInUp animated" data-wow-delay="0.5s">to the Future of Industry</h3>
                    <p class=" wow fadeInUp animated" data-wow-delay="0.8s">
                        Our engineering services are designed to help manufacturers identify areas within the
                        organization that will benefit the most from digitalization.
                    </p>
                </div>
            </div>
        </div>
        <div data-thumb="images/slider-2.jpg" data-src="images/slider-2.jpg">
            <div class="camera_caption">
                <div class="container" style="padding-right: 20%;">
                    <h5 class=" wow fadeInUp animated">One-Stop Digital Transformation </h5>
                    <h3 class=" wow fadeInUp animated" data-wow-delay="0.5s">in Manufacture & Heavy-Duty Industry
                    </h3>
                    <p class=" wow fadeInUp animated" data-wow-delay="0.8s">Strategizing the best manufacturing
                        operation approaches to integrate smart outcomes from this era of Digital Transformation.
                    </p>
                </div>
            </div>
        </div>
        <div data-thumb="images/slider-3.jpg" data-src="images/slider-3.jpg">
            <div class="camera_caption">
                <div class="container" style="padding-left: 30%;">
                    <h5 class=" wow fadeInUp animated">Accelerating Digital </h5>
                    <h3 class=" wow fadeInUp animated" data-wow-delay="0.5s">Implementations & Managing Risks</h3>
                    <p class=" wow fadeInUp animated" data-wow-delay="0.8s">Empowering the internal processes with
                        the power of advanced technologies which will walk you through advanced features and
                        principles of operating flexibly.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Slider area -->

<!-- About Us Area -->
<section class="about_us_area row">
    <div class="container">
        <div class="tittle wow fadeInUp">
            <h2>ABOUT US</h2>
            <h3>REINFORCING INNOVATION THROUGH DIGITAL TRANSFORMING SOLUTIONS</h3>
            <p>
                E-data Wiz Digital Solution is a reputed consultancy service provider that specializes in delivering services
                related to automating, transforming and modernising industries with digitalised solutions.
                Our pivotal function is to introduce a digital shift to a company by bringing in organisational,
                operational and structural transformations befitting both, the present and future. Turning your idea
                into reality, our solutions use robust AI techniques to evolve & enhance every facet of the
                manufacturing operation approach from targeted enhancement to a complete reinvention of the
                capabilities. The methods that we use to transform your business are reliable and known to deliver
                outstanding returns. Hence, you just need to keep peace of mind and go ahead with obtaining the
                services available.
            </p>
        </div>
        <div class="row about_row">
            <div class="col-md-4 about-col">
                <div class="dt-sc-icon-box type13 violet " data-delay="0" style="height:330px">
                    <div class="icon-wrapper"><span class="fa fa-eye"> </span></div>
                    <div class="icon-content">
                        <h5>Vision</h5>
                        <p>The vision of E-data Wiz Digital Solution is to offer value-oriented and high-end solutions to the
                            industries along with the latest technological applications while ensuring unified
                            digital transformation.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 about-col">
                <div class="dt-sc-icon-box type13 violet " data-delay="0" style="height:330px">
                    <div class="icon-wrapper"><span class="fa fa-dot-circle-o"> </span></div>
                    <div class="icon-content">
                        <h5>Mission</h5>
                        <p>We turn your ideas into reality. Our solutions use robust AI techniques to evolve &
                            enhance every facet of the manufacturing operation approach from targeted enhancement to
                            a complete reinvention of the capabilities.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 about-col">
                <div class="dt-sc-icon-box type13 violet " data-delay="0" style="height:330px">
                    <div class="icon-wrapper"><span class="fa fa-life-ring"> </span></div>
                    <div class="icon-content">
                        <h5>Value Proposition</h5>
                        <p>Every service we offer is based on a belief of connecting and rebuilding your enterprise
                            with evolved, productive and advanced technologies.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End About Us Area -->

<!-- why choose us -->
<section class="why_choose_us">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Why choose us?</h2>
                <h3>
                    <span class="span-1">
                        We can provide solutions for all
                    </span>
                    <span class="span-2">
                        your industrial needs.
                    </span>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="progress--circle progress--75">
                    <div class="progress__number">75%</div>
                </div>
                <h3>Increase in customer satisfaction</h3>
            </div>
            <div class="col-md-3">
                <div class="progress--circle progress--70">
                    <div class="progress__number">70%</div>
                </div>
                <h3>In new customer acquisition</h3>
            </div>
            <div class="col-md-3">
                <div class="progress--circle progress--45">
                    <div class="progress__number">45%</div>
                </div>
                <h3>Increase in productivity</h3>
            </div>
            <div class="col-md-3">
                <div class="progress--circle progress--25">
                    <div class="progress__number">26%</div>
                </div>
                <h3>Reduction in Costs</h3>
            </div>
        </div>
    </div>
</section>
<!-- end why choose us -->

@endsection

@section('scripts')


@endsection