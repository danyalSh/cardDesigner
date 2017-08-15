@extends('layouts1.body')
@section('section')
    <div class="row no-gutter">
        <div class="col-sm-12 col-md-12 col-lg-9" style="background:#F9F9F9;">
            <div class="p-20 clearfix">
                <div class="pull-right">
                    <a href="pages-material-bird.html" target="_blank" class="btn btn-round-sm btn-link" data-toggle="tooltip" title="Play material bird">
                    </a>
                </div>
                <h4 class="grey-text">
                    <span class="hidden-xs">Performance summary and KPI's</span>
                </h4>
            </div>
            <div class="p-20 no-p-t">
                <div class="row gutter-14 kpi-dashboard">
                    <div class="col-md-4">
                        <div class="card small">
                            <div class="theme-lighten-1 p-10">
                                <div class="pull-right">
                                    <div> <i class="md md-trending-up text-rgb-5"></i> 3% </div>
                                </div>
                                <h4 class="no-margin white-text w600">Sales per day</h4>
                                <div class="f11" style="opacity:0.8"> <i class="md md-star-outline"></i> Latest 10 May, 10:00 </div>
                                <div class="p-10 p-t-30">
                                    <div id="chart-line-1"></div>
                                </div>
                            </div>
                            <div class="card-content p-10">
                                <div class="row">
                                    <div class="col-md-6 text-center" style="border-right: 1px #F0F0F0 solid;">
                                        <h3 class="no-margin w300">$4181,-</h3>
                                        <p class="grey-text w600">Total revenue</p>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <h3 class="no-margin w300">233</h3>
                                        <p class="grey-text w600">Today sales</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card small">
                            <div class="theme-secondary-lighten-1 p-10">
                                <div class="pull-right">
                                    <div> <i class="md md-trending-up  text-rgb-5"></i> 6% </div>
                                </div>
                                <h4 class="no-margin white-text w600">Customers per day</h4>
                                <div class="f11" style="opacity:0.8"> <i class="md md-star-outline"></i> Latest 10 May, 10:00 </div>
                                <div class="p-10 p-t-30">
                                    <div id="chart-line-2"></div>
                                </div>
                            </div>
                            <div class="card-content p-10">
                                <div class="row">
                                    <div class="col-md-6 text-center" style="border-right: 1px #F0F0F0 solid;">
                                        <h3 class="no-margin w300">2584</h3>
                                        <p class="grey-text w600">Monthly total</p>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <h3 class="no-margin w300">89</h3>
                                        <p class="grey-text w600">Today total</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card small">
                            <div class="green lighten-1 p-10">
                                <div class="pull-right">
                                    <div> <i class="md md-trending-up  text-rgb-5"></i> 9% </div>
                                </div>
                                <h4 class="no-margin white-text w600">Newsletter signups</h4>
                                <div class="f11" style="opacity:0.8"> <i class="md md-star-outline"></i> Latest 10 May, 10:00 </div>
                                <div class="p-10 p-t-30">
                                    <div id="chart-line-3"></div>
                                </div>
                            </div>
                            <div class="card-content p-10">
                                <div class="row">
                                    <div class="col-md-6 text-center" style="border-right: 1px #F0F0F0 solid;">
                                        <h3 class="no-margin w300">1597</h3>
                                        <p class="grey-text w600">Monthly total</p>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <h3 class="no-margin w300">34 </h3>
                                        <p class="grey-text w600">Today total</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grey-text small p-t-20">SwapCards - Admin Panel</div>
            </div>
        </div>
    </div>
@stop