@extends('front.layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="u-mv-large u-text-center">
                <h2 class="u-mb-xsmall">Hi Jessica! Welcome back to the Dashboard.</h2>
                <p class="u-text-mute u-h6">Check out your past searches and the content you’ve browsed in. <a href="#">View last results</a></p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-lg-4">
            <div class="c-card u-p-medium u-text-center u-mb-medium" data-mh="landing-cards">

                <img class="u-mb-small" src="img/icon-intro1.svg" alt="iPhone icon">

                <h4 class="u-h6 u-text-bold u-mb-small">
                    Check your performance. See the results of all your active campaings.
                </h4>
                <a class="c-btn c-btn--info" href="#">Start new Campaign</a>
            </div>
        </div>

        <div class="col-sm-12 col-lg-4">
            <div class="c-card u-p-medium u-text-center u-mb-medium" data-mh="landing-cards">

                <img class="u-mb-small" src="img/icon-intro2.svg" alt="iPhone icon">

                <h4 class="u-h6 u-text-bold u-mb-small">
                    Start console and prepare new stuff for your customers or community!
                </h4>
                <a class="c-btn c-btn--info" href="#">View your reports</a>
            </div>
        </div>

        <div class="col-sm-12 col-lg-4">
            <div class="c-card u-p-medium u-text-center u-mb-medium" data-mh="landing-cards">

                <img class="u-mb-small" src="img/icon-intro3.svg" alt="iPhone icon">

                <h4 class="u-h6 u-text-bold u-mb-small">
                    All Files ready? <br>Start promoting your apps today.
                </h4>
                <a class="c-btn c-btn--info" href="#">Start using Dashboar</a>
            </div>
        </div>
    </div>

    <div class="row u-mt-small">
        <div class="col-lg-6">
            <h3 class="u-mb-small">Dashboard Overview</h3>

            <div class="c-card c-overview-card u-p-medium u-mb-medium">
                <div class="row">
                    <div class="col-4 u-border-right">
                        <div class="c-overview-card__section">
                            <h3 class="u-mb-zero">801, 523</h3>
                            <p class="u-text-mute u-mb-small">Newsletters Sent</p>
                            <canvas id="js-chart-newsletters" width="300" height="250"></canvas>
                        </div>
                    </div>

                    <div class="col-4 u-border-right">
                        <div class="c-overview-card__section">
                            <h3 class="u-mb-zero">801, 523</h3>
                            <p class="u-text-mute u-mb-small">Newsletters Sent</p>
                            <canvas id="js-chart-subscribers" width="300" height="250"></canvas>
                        </div>

                    </div>

                    <div class="col-4">
                        <div class="c-overview-card__section">
                            <h3 class="u-mb-zero">801, 523</h3>
                            <p class="u-text-mute u-mb-small">Newsletters Sent</p>
                            <canvas id="js-chart-conversion" width="300" height="250"></canvas>
                        </div>
                    </div>
                </div>

                <span class="c-divider u-mv-medium u-opacity-medium"></span>

                <div class="row">
                    <div class="col-6 col-md-3 u-border-right">
                        <div class="c-overview-card__section">
                            <p class="u-text-mute u-nospace">Open Rate</p>
                            <h3 class="u-nospace">32.21%</h3>

                            <div class="c-progress c-progress--info c-progress--small u-mb-zero">
                                <div class="c-progress__bar" style="width:15%;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 u-border-right">
                        <div class="c-overview-card__section">
                            <p class="u-text-mute u-nospace">Read Rate</p>
                            <h3 class="u-nospace">75.21%</h3>

                            <div class="c-progress c-progress--info c-progress--small u-mb-zero">
                                <div class="c-progress__bar" style="width:75.21%;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="c-overview-card__section">
                            <p class="u-text-mute u-nospace">Attachments</p>
                            <h3 class="u-nospace">63.45%</h3>

                            <div class="c-progress c-progress--info c-progress--small u-mb-zero">
                                <div class="c-progress__bar" style="width:63.45%;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 u-border-left">
                        <div class="c-overview-card__section">
                            <p class="u-text-mute u-nospace">New Subs</p>
                            <h3 class="u-nospace">72.4%</h3>

                            <div class="c-progress c-progress--success c-progress--small u-mb-zero">
                                <div class="c-progress__bar" style="width:72.4%;"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-6">
            <div class="u-flex u-justify-between">
                <h3 class="u-mb-small">Recently Opened</h3>

                <div class="c-field u-width-25 u-mb-small">
                    <label class="c-field__label u-hidden-visually" for="select-recently">Recently Opened</label>

                    <!-- Select2 jquery plugin is used -->
                    <select class="c-select" name="recently-opened" id="select-recently">
                        <option value="value1">All Types</option>
                        <option value="value2">This day</option>
                        <option value="value3">Last Week</option>
                    </select>
                </div>
            </div>

            <div class="c-card u-p-medium">
                <div class="c-fileitem">
                    <div class="c-fileitem__content">
                        <div class="c-fileitem__img">
                            <img src="img/recent1.jpg" alt="File's image">
                        </div>

                        <p class="c-fileitem__name">
                            <img src="img/icon-pdf.svg" alt="PDF icon">Santorini.pdf
                        </p>
                    </div>

                    <div class="c-fileitem__date">
                        25MB <span class="u-hidden-down@mobile"> <i>|</i> Edited 1 minute ago</span>
                    </div>
                </div><!-- // .c-fileitem -->

                <div class="c-fileitem">
                    <div class="c-fileitem__content">
                        <div class="c-fileitem__img">
                            <img src="img/recent2.jpg" alt="File's image">
                        </div>

                        <p class="c-fileitem__name">
                            <img src="img/icon-pdf.svg" alt="PDF icon">Sea Presentation.pdf
                        </p>
                    </div>

                    <div class="c-fileitem__date">
                        12MB <span class="u-hidden-down@mobile"> <i>|</i> Edited 3 minute ago</span>
                    </div>
                </div><!-- // .c-fileitem -->

                <div class="c-fileitem">
                    <div class="c-fileitem__content">
                        <div class="c-fileitem__img">
                            <img src="img/recent3.jpg" alt="File's image">
                        </div>

                        <p class="c-fileitem__name">
                            <img src="img/icon-doc.svg" alt="PDF icon">Lakes in Austria.doc
                        </p>
                    </div>

                    <div class="c-fileitem__date">
                        25MB <span class="u-hidden-down@mobile"> <i>|</i> Edited 1 minute ago</span>
                    </div>
                </div><!-- // .c-fileitem -->

                <div class="c-fileitem">
                    <div class="c-fileitem__content">
                        <div class="c-fileitem__img">
                            <img src="img/recent4.jpg" alt="File's image">
                        </div>

                        <p class="c-fileitem__name">
                            <img src="img/icon-pdf.svg" alt="PDF icon">Mountain.pdf
                        </p>
                    </div>

                    <div class="c-fileitem__date">
                        54MB <span class="u-hidden-down@mobile"> <i>|</i> Edited on 11/02/2017</span>
                    </div>
                </div><!-- // .c-fileitem -->

                <div class="c-fileitem">
                    <div class="c-fileitem__content">
                        <div class="c-fileitem__img">
                            <img src="img/recent5.jpg" alt="File's image">
                        </div>

                        <p class="c-fileitem__name">
                            <img src="img/icon-doc.svg" alt="PDF icon">Mountains in US.doc
                        </p>
                    </div>

                    <div class="c-fileitem__date">
                        8MB <span class="u-hidden-down@mobile"> <i>|</i>Edited on 09/01/2017</span>
                    </div>
                </div><!-- // .c-fileitem -->
            </div>
        </div>
    </div>
</div>
@endsection