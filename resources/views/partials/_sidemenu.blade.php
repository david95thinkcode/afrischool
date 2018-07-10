<div class="col-md-3 left_col menu_fixed">
    <div class="left_col scroll-view">
        <div class="navbar nav_title mb-1" style="border: 0;">
            <a href="{!! route('home') !!}" class="site_title">
                <i class="fa fa-graduation-cap"></i> 
                <span>AfrikaSchool</span>
            </a>
        </div>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
                <li><a><i class="fa fa-users"></i> Élèves 
                    <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('inscriptions.create') }}">Inscrire</a></li>
                        <li><a href="{{ route('inscriptions.index') }}">Liste par classe</a></li>
                        <li><a href="{{route('eleve.reste.versement')}}">Paiement scolarité</a></li>
                        <li><a href="#">...........</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-user-secret"></i> Professeurs
                        <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('professeurs.create') }}">Créer</a></li>
                        <li><a href="{{ route('professeurs.index') }}">Liste par classe</a></li>
                        <li><a href="{{ route('enseigner.create') }}">Ajouter un professeur à une classe </a></li>
                        <li><a href="{{ route('professeurs.list') }}">Liste complète</a>
                    </ul>
                </li>
                <li><a><i class="fa fa-street-view"></i>Personnel
                        <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#">Créer</a></li>
                        <li><a href="#">...........</a></li>
                        <li><a href="#">...........</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-building-o"></i> Classes
                        <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('classe.create') }}">Créer</a></li>
                        <li><a href="{{ route('classe.index') }}">Liste</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-book"></i>Matières
                        <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('matieres.create') }}">Créer</a></li>
                        <li><a href="{{ route('enseigner.create') }}">Ajouter une matière à une classe </a></li>
                        <li><a href="{{ route('matiere.show.classes') }}">Liste des matières enseignées par classe </a></li>
                        <li><a href="{{ route('matieres.index') }}">Liste complète des matières</a></li>
                    </ul>
                </li>
                <li>
                    <a><i class="fa fa-flag"></i>Notes
                        <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('notes.selecteType') }}">Ajouter</a></li>
                        <li><a href="{!! route('bulletin.index') !!}">Bulletin de notes</a></li>
                    </ul>
                </li>
                <li>
                    <a><i class="fa fa-file-text-o"></i>Emploi du temps<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('emploi-du-temps.search') }}">Consulter</a></li>
                        <li><a href="{{ route('horaire.create') }}">Ajouter</a></li>
                    </ul>                 
                </li>
                <li>
                    <a><i class="fa fa-flag"></i>Notification <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('notifier.user') }}">Parents</a></li>
                        <li><a href="{{route('notifier.notes')}}">Notes des élèves</a></li>
                    </ul>
                </li>
                <li>
                    <a><i class="fa fa-flag"></i>Finance <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('finance.index') }}">Informations générales</a></li>
                        <li><a href="{{ route('finance.depense.index') }}">Saisir les dépenses</a></li>
                        <li><a href="{{ route('finance.depense.show') }}">information dépenses</a></li>
                        <li><a href="#">#</a></li>
                    </ul>
                </li>
                <li>
                    <a><i class="fa fa-file-text-o"></i> Examens
                    <span class="label label-success pull-right">Coming Soon</span></a>
                </li>
                <li>
                    <a><i class="fa fa-hashtag"></i> Absence
                    <span class="label label-success pull-right">Coming Soon</span></a>
                </li>
            </ul>
        </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Paramètre" href='#'>
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Plein écran">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Deconnexion" href="#">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>