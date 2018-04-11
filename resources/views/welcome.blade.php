@extends('templates.app')
@section('title')
    Gestion des écoles
@endsection

@section('content')
    <div class="page-title mb-5">
        <div class="title_left">
            <h3>Accueil</h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12">
        <div class="x-content">
            <div class="row mb-2">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats bg-green">
                        <div class="count">{!! $count['eleves'] !!}</div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
    
                        <h3>Liste des élèves</h3>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats bg-blue">
                        <div class="count">{!! $count['prof'] !!}</div>
                        <div class="icon">
                            <i class="fa fa-user-secret"></i>
                        </div>
    
                        <h3>Liste des professeurs</h3>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats bg_red">
                        <div class="count">{!! $count['classes'] !!}</div>
                        <div class="icon">
                            <i class="fa fa-building-o"></i>
                        </div>
    
                        <h3>Liste des classes</h3>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats bg-blue-sky">
                        <div class="count">179</div>
                        <div class="icon">
                            <i class="fa fa-street-view"></i>
                        </div>
    
                        <h3>Liste du personnel</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats bg-purple">
                        <div class="count">179</div>
                        <div class="icon">
                            <i class="fa fa-archive"></i>
                        </div>
    
                        <h3>Liste des unités</h3>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats bg-orange">
                        <div class="count">{!! $count['mat'] !!}</div>
                        <div class="icon">
                            <i class="fa fa-book"></i>
                        </div>
    
                        <h3>Liste des matières</h3>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats bg-red">
                        <div class="count">19</div>
                        <div class="icon">
                            <i class="fa fa-file-text-o"></i>
                        </div>
    
                        <h3>Liste des examens</h3>
                    </div>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="tile-stats bg-white">
                        <div class="count">8</div>
                        <div class="icon">
                            <i class="fa fa-leanpub"></i>
                        </div>
    
                        <h3>Liste du control</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection