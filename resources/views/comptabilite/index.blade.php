@extends('templates.app')
@section('title') Information  @endsection
@section('section-title')Notification aux parents notes de la semaine @endsection
@section('robot')
    <meta name="robots" content="nofollow, noindex"/>@stop
@section('content')
    <div class="row top_tiles" style="margin: 10px 0;">

        @if(!is_null($solde))
            <div class="col-md-3 col-sm-3 col-xs-6 tile">
                <span class="count_top">Scolarité à perçevoir</span>
                <h2>{{$solde->sum('montant_scolarite')}} <i class="green">xof</i></h2>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 tile">
                <span class="count_top">Scolarité restant</span>
                <h2>{{$solde->sum('reste')}} <i class="green">xof</i></h2>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 tile">
                <span class="count_top">Scolarité perçu</span>
                <h2>{{$solde->sum('montant_verse')}} <i class="green">xof</i></h2>
            </div>
        @else
            <div class="col-md-3 col-sm-3 col-xs-6 tile">
                <span>Total scolarité</span>
                <h2>0 <i class="green">xof</i></h2>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 tile">
                <span>Scolarité à perçevoir</span>
                <h2>0 <i class="green">xof</i></h2>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 tile">
                <span>Scolarité perçu</span>
                <h2>0 <i class="green">xof</i></h2>
            </div>
        @endif
        @if(is_null($depense))
            <div class="col-md-3 col-sm-3 col-xs-6 tile">
                <span class="count_top">Total dépense</span>
                <h2>{{$depense->sum('montant')}} <i class="green">xof</i></h2>
            </div>
        @else
            <div class="col-md-3 col-sm-3 col-xs-6 tile">
                <span class="count_top">Total dépense</span>
                <h2>0 <i class="green">xof</i></h2>
            </div>
        @endif
    </div>
    <hr>
    <div class="row">
        <!-- bar charts group -->
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Bar Chart Group
                        <small>Sessions</small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content2">
                    <div id="graphx" style="width: 100%; height: 300px; position: relative;">
                        <svg height="300" version="1.1" width="496" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             style="overflow: hidden; position: relative; top: -0.599976px;">
                            <desc>Created with Raphaël @@VERSION</desc>
                            <defs></defs>
                            <text style="text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                  x="20.5" y="260" text-anchor="end" font-family="sans-serif" font-size="12px"
                                  stroke="none" fill="#888888" font-weight="normal">
                                <tspan dy="3">0</tspan>
                            </text>
                            <path style="" fill="none" stroke="#aaaaaa" d="M33,260H471" stroke-width="0.5"></path>
                            <text style="text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                  x="20.5" y="201.25" text-anchor="end" font-family="sans-serif" font-size="12px"
                                  stroke="none" fill="#888888" font-weight="normal">
                                <tspan dy="3">2</tspan>
                            </text>
                            <path style="" fill="none" stroke="#aaaaaa" d="M33,201.25H471" stroke-width="0.5"></path>
                            <text style="text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                  x="20.5" y="142.5" text-anchor="end" font-family="sans-serif" font-size="12px"
                                  stroke="none" fill="#888888" font-weight="normal">
                                <tspan dy="3">4</tspan>
                            </text>
                            <path style="" fill="none" stroke="#aaaaaa" d="M33,142.5H471" stroke-width="0.5"></path>
                            <text style="text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                  x="20.5" y="83.75" text-anchor="end" font-family="sans-serif" font-size="12px"
                                  stroke="none" fill="#888888" font-weight="normal">
                                <tspan dy="3">6</tspan>
                            </text>
                            <path style="" fill="none" stroke="#aaaaaa" d="M33,83.75H471" stroke-width="0.5"></path>
                            <text style="text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                  x="20.5" y="25" text-anchor="end" font-family="sans-serif" font-size="12px"
                                  stroke="none" fill="#888888" font-weight="normal">
                                <tspan dy="3">8</tspan>
                            </text>
                            <path style="" fill="none" stroke="#aaaaaa" d="M33,25H471" stroke-width="0.5"></path>
                            <text style="text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                  x="416.25" y="272.5" text-anchor="middle" font-family="sans-serif" font-size="12px"
                                  stroke="none" fill="#888888" font-weight="normal" transform="matrix(1,0,0,1,0,7.5)">
                                <tspan dy="3">2015 Q4</tspan>
                            </text>
                            <text style="text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                  x="306.75" y="272.5" text-anchor="middle" font-family="sans-serif" font-size="12px"
                                  stroke="none" fill="#888888" font-weight="normal" transform="matrix(1,0,0,1,0,7.5)">
                                <tspan dy="3">2015 Q3</tspan>
                            </text>
                            <text style="text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                  x="197.25" y="272.5" text-anchor="middle" font-family="sans-serif" font-size="12px"
                                  stroke="none" fill="#888888" font-weight="normal" transform="matrix(1,0,0,1,0,7.5)">
                                <tspan dy="3">2015 Q2</tspan>
                            </text>
                            <text style="text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;"
                                  x="87.75" y="272.5" text-anchor="middle" font-family="sans-serif" font-size="12px"
                                  stroke="none" fill="#888888" font-weight="normal" transform="matrix(1,0,0,1,0,7.5)">
                                <tspan dy="3">2015 Q1</tspan>
                            </text>
                            <rect x="46.6875" y="201.25" width="25.375" height="58.75" rx="0" ry="0" fill="#26b99a"
                                  stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect>
                            <rect x="75.0625" y="171.875" width="25.375" height="88.125" rx="0" ry="0" fill="#34495e"
                                  stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect>
                            <rect x="103.4375" y="142.5" width="25.375" height="117.5" rx="0" ry="0" fill="#acadac"
                                  stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect>
                            <rect x="156.1875" y="171.875" width="25.375" height="88.125" rx="0" ry="0" fill="#26b99a"
                                  stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect>
                            <rect x="184.5625" y="113.125" width="25.375" height="146.875" rx="0" ry="0" fill="#34495e"
                                  stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect>
                            <rect x="212.9375" y="83.75" width="25.375" height="176.25" rx="0" ry="0" fill="#acadac"
                                  stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect>
                            <rect x="265.6875" y="142.5" width="25.375" height="117.5" rx="0" ry="0" fill="#26b99a"
                                  stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect>
                            <rect x="294.0625" y="171.875" width="25.375" height="88.125" rx="0" ry="0" fill="#34495e"
                                  stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect>
                            <rect x="322.4375" y="201.25" width="25.375" height="58.75" rx="0" ry="0" fill="#acadac"
                                  stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect>
                            <rect x="375.1875" y="201.25" width="25.375" height="58.75" rx="0" ry="0" fill="#26b99a"
                                  stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect>
                            <rect x="403.5625" y="142.5" width="25.375" height="117.5" rx="0" ry="0" fill="#34495e"
                                  stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect>
                            <rect x="431.9375" y="113.125" width="25.375" height="146.875" rx="0" ry="0" fill="#acadac"
                                  stroke="none" style="fill-opacity: 1;" fill-opacity="1"></rect>
                        </svg>
                        <div class="morris-hover morris-default-style" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /bar charts group -->

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Pie Chart
                        <small>Sessions</small>
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content2">
                    <div id="graph_donut" style="width:100%; height:300px;">
                        <svg height="300" version="1.1" width="496" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             style="overflow: hidden; position: relative; top: -0.599976px;">
                            <desc>Created with Raphaël @@VERSION</desc>
                            <defs></defs>
                            <path style="opacity: 0;" fill="none" stroke="#26b99a"
                                  d="M248,243.33333333333331A93.33333333333333,93.33333333333333,0,0,0,341.3333330454699,150.00733038285082"
                                  stroke-width="2" opacity="0"></path>
                            <path style="" fill="#26b99a" stroke="#ffffff"
                                  d="M248,246.33333333333331A96.33333333333333,96.33333333333333,0,0,0,344.33333303621714,150.00756600229963L382.99999958362605,150.01060287519496A135,135,0,0,1,248,285Z"
                                  stroke-width="3"></path>
                            <path style="opacity: 1;" fill="none" stroke="#34495e"
                                  d="M341.3333330454699,150.00733038285082A93.33333333333333,93.33333333333333,0,0,0,174.3054960170495,92.7266973728771"
                                  stroke-width="2" opacity="1"></path>
                            <path style="" fill="#34495e" stroke="#ffffff"
                                  d="M344.33333303621714,150.00756600229963A96.33333333333333,96.33333333333333,0,0,0,171.9367441033118,90.88576978843386L137.45824402557423,64.09004605931564A140,140,0,0,1,387.99999956820477,150.01099557427625Z"
                                  stroke-width="3"></path>
                            <path style="opacity: 0;" fill="none" stroke="#acadac"
                                  d="M174.3054960170495,92.7266973728771A93.33333333333333,93.33333333333333,0,0,0,190.72090959672028,223.69000552099328"
                                  stroke-width="2" opacity="0"></path>
                            <path style="" fill="#acadac" stroke="#ffffff"
                                  d="M171.9367441033118,90.88576978843386A96.33333333333333,96.33333333333333,0,0,0,188.87979597661484,226.0586128413109L165.14988709525608,256.58732941429383A135,135,0,0,1,141.40616388180374,67.15825870005436Z"
                                  stroke-width="3"></path>
                            <path style="opacity: 0;" fill="none" stroke="#3498db"
                                  d="M190.72090959672028,223.69000552099328A93.33333333333333,93.33333333333333,0,0,0,247.97067846904892,243.333328727518"
                                  stroke-width="2" opacity="0"></path>
                            <path style="" fill="#3498db" stroke="#ffffff"
                                  d="M188.87979597661484,226.0586128413109A96.33333333333333,96.33333333333333,0,0,0,247.96973599126835,246.3333285794739L247.9575884998743,284.9999933380171A135,135,0,0,1,165.14988709525608,256.58732941429383Z"
                                  stroke-width="3"></path>
                            <text style="text-anchor: middle; font-family:Arial; font-size: 15px; font-weight: 800;"
                                  x="248" y="140" text-anchor="middle" font-family="&quot;Arial&quot;" font-size="15px"
                                  stroke="none" fill="#000000" font-weight="800"
                                  transform="matrix(3.1111,0,0,3.1111,-523.5556,-310.3333)"
                                  stroke-width="0.3214285714285714">
                                <tspan dy="4">Frosted</tspan>
                            </text>
                            <text style="text-anchor: middle; font-family:Arial; font-size: 14px;" x="248"
                                  y="160" text-anchor="middle" font-family="&quot;Arial&quot;" font-size="14px"
                                  stroke="none" fill="#000000" transform="matrix(2.3932,0,0,2.3932,-345.5043,-213.8504)"
                                  stroke-width="0.41785714285714287">
                                <tspan dy="3.5">40%</tspan>
                            </text>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop