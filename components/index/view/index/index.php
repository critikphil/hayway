
<section id="home">
    <div class="container">
        <header>
            <? Controller::loadComponent('slideshow', 'iosslider'); ?>
        </header>
        <div class="content">
            <div class="leftside">
                
                
                <div id="tendency">
                    <h3><span class="fa fa-flag"></span>Découvrez l'Arménie</h3>
                    <ul>
                        <li>
                            <a href="<?=PATH?>">
                                <img src="<?=SLIDESHOW_PATH?>images/Ararat_Armenia1.jpg" alt="hayway" />
                                <div class="block_text">
                                    <h4>Ararat</h4>
                                    <div class="sub_block_text">
                                        <h5>Xoxovac</h5>
                                        <p>Régalez-vous</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?=PATH?>">
                                <img src="<?=SLIDESHOW_PATH?>images/Sevan_Lake_Armenia1.jpg" alt="hayway" />
                                <div class="block_text">
                                    <h4>Lac Sevan</h4>
                                    <div class="sub_block_text">
                                        <h5>Xoxovac</h5>
                                        <p>Régalez-vous</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?=PATH?>">
                                <img src="<?=SLIDESHOW_PATH?>images/Tatev_Armenia1.jpg" alt="hayway" />
                                <div class="block_text">
                                    <h4>Tatev</h4>
                                    <div class="sub_block_text">
                                        <h5>Xoxovac</h5>
                                        <p>Régalez-vous</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?=PATH?>">
                                <img src="<?=SLIDESHOW_PATH?>images/Ararat_Armenia1.jpg" alt="hayway" />
                                <div class="block_text">
                                    <h4>Ararat</h4>
                                    <div class="sub_block_text">
                                        <h5>Xoxovac</h5>
                                        <p>Régalez-vous</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?=PATH?>">
                                <img src="<?=SLIDESHOW_PATH?>images/Sevan_Lake_Armenia1.jpg" alt="hayway" />
                                <div class="block_text">
                                    <h4>Lac Sevan</h4>
                                    <div class="sub_block_text">
                                        <h5>Xoxovac</h5>
                                        <p>Régalez-vous</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?=PATH?>">
                                <img src="<?=SLIDESHOW_PATH?>images/Tatev_Armenia1.jpg" alt="hayway" />
                                <div class="block_text">
                                    <h4>Tatev</h4>
                                    <div class="sub_block_text">
                                        <h5>Xoxovac</h5>
                                        <p>Régalez-vous</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div id="last_events">
                    <h3><span class="fa fa-calendar-o"></span>Derniers évenements</h3>
                    <? Controller::loadComponent('lastevents', 'previews'); ?>
                </div>
            </div>
            <div class="rightside">
                <div id="weather_block">
                    <div id="arm_clock"></div>
                    <? Controller::loadComponent('weather', 'weatherslider'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
