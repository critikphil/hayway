<section id="intro" class="one">
    <div class="container">
        <header>
            <h2><?=!empty($this->_subject)?$this->_subject:'Contact'?></h2>
        </header>
        <p><?=!empty($this->_description)?$this->_description:''?></p>
    </div>
</section>
<section id="contact-info" class="three">
    <div class="container">
        <header>
            <h3 id="contact_title"><span class="fa fa-pencil"></span><?=!empty($this->_subject)?'Commande / Renseignements':'Pour toutes demandes, contactez-nous via ce formulaire'?></h3>
        </header>
        <p>
            Indiquez votre numéro de téléphone dans le formulaire de contact et nous vous rappelerons rapidement,<br />
            ou appellez directement par skype en un seul clic : 
        </p>
        <? Utils::loadSkypeButton('nicolas.cramail', true, false) ?>
        <div id="contact-form">
            <p class="contact_info">
                Nous mettons un point d'honneur tout particulier sur 
                l'écoute et la compréhension de nos clients.
                Contactez-nous via ce formulaire et nous vous répondrons dans les meilleurs délais.<br/><br/>
            </p>
            <? Controller::loadComponent('contact', 'form'); ?>
        </div>
</section>
<section class="one">
    <div class="container">
        <header>
            <h3 id="google_map_title"><span class="fa fa-map-marker"></span>Où sommes-nous ?</h3>
        </header>
        <div id="google_map_content">
            <? Utils::loadGoogleMap(43.1242280, 5.9280000, 10, false) ?>
        </div>
    </div>
</section>
<section class="two">
    <div class="container">
        <header>
            <h3 class="description_title"><span class="fa fa-user"></span>Qui sommes-nous ?</h3>
        </header>
        <div class="description_content">
            <p>
                tonsiteinternet.fr est une agence de création de site internet passionnée d'informatique et de technologie.<br />
            </p>
            <p>
                L'agence tonsiteinternet.fr propose des sites personnalisés, uniques 
                avec des prix abordables pour les entreprises qui souhaitent se lancer sur internet.<br />
                Nous proposons des packs avantageux pour réaliser votre site internet 
                et vous donner toutes les solutions pour vous démarquer dans votre activité.
            </p>
        </div>
    </div>
</section>
    
<section class="three">
    <div class="container">
        <header>
            <h3 class="description_title"><span class="fa fa-cogs"></span>Comment fait-on ?</h3>
        </header>
        <div class="description_content">
            <p>
                Internet est un univers en constante progression et de nouveaux programmes et langages y sont découverts tous les jours.<br />
                Il est donc nécessaire de se maintenir toujours informé et à la page de l'actualité.
            </p>
            <p>
                Nous réalisons votre site internet en travaillant sur trois critères qui nous semblent essentiels :
            </p>
            <ul>
                <li>Le référencement</li>
                <li>Le respect des standards du web (<a href="http://validator.w3.org">W3C</a>)</li>
                <li>Le design - Identité visuelle</li>
            </ul>
        </div>
    </div>
</section>    

<section class="four">
    <div class="container">
        <header>
            <h3 class="description_title"><span class="fa fa-google-plus-square"></span>Référencement ?</h3>
        </header>
        <div class="description_content">
            <p>
                Il existe trois étapes dans le référencement :
            </p>
            <ul>
                <li>
                    <h4>L'indexation</h4>
                    <p>Il s'agit simplement du fait d'indiquer au moteur de recherche, l'existence du site pour qu'il puisse ainsi le visiter et rendre le contenu accessible aux utilisateurs</p>
                </li>
                <li>
                    <h4>L'optimisation du contenu du site</h4>
                    <p>Le choix des mots clés, de la description, des titres, des liens, etc ... </p>
                    <p>Tout ce contenu est très important pour le référencement : il faut donc le choisir et le construire avec précaution pour le rendre aux maximum utilisable par le moteur de recherche</p>
                </li>
                <li>
                    <h4>Le netlinking</h4>
                    <p>
                        Pour améliorer le référencement, il est possible également d'utiliser des liens externes, 
                        c'est à dire de placer des liens sur des sites internet, vers votre site
                    </p>
                    <p>
                        Cette pratique peut être utile pour lancer un nouveau site et ainsi améliorer la vitesse de son référencement, 
                        mais elle commence à être sanctionnée par google, et peut donc s'avérer néfaste.<br />
                        Il faut donc choisir ses sites annuaires avec précaution pour référencer votre site.
                    </p>
                </li>
            </ul>
            <p>
                Le référencement est donc une étape délicate mais est aussi un travail à moyen et long terme.<br/>
                L'indexation complète d'un site est obtenue après environ 2 semaines et les résultats concrets du référencement arrivent à partir du 2ème mois.
            </p>
        </div>
    </div>
</section>    
    
    
    
    
    