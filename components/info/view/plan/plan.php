<div id="plan-page">
    <h2>Plan du site</h2>
    <ul class="plan_list">
        <li class="plan_list_item">
            <a href="<?=PATH?>">
                <h3>Accueil</h3>
            </a>
        </li>
        <li class="plan_list_item">
            <a href="<?=PATH?>packages/">
                <h3>Nos packs</h3>
            </a>
            <ul>
                <li class="plan_list_item">
                    <a href="<?=PATH?>packs/le-pack-decouverte.html">
                        <h4>Pack Découverte</h4>
                    </a>
                </li>
                <li class="plan_list_item">
                    <a href="<?=PATH?>packs/le-pack-activite.html">
                        <h4>Pack Activité</h4>
                    </a>
                </li>
                <li class="plan_list_item">
                    <a href="<?=PATH?>packs/le-pack-vitrine.html">
                        <h4>Pack Vitrine</h4>
                    </a>
                </li>
            </ul>
        </li>
        <li class="plan_list_item">
            <a href="<?=PATH?>achievements/">
                <h3>Nos réalisations</h3>
            </a>
            <ul>
                <? foreach($this->_achievements as $achievement): ?>
                <li class="plan_list_item">
                    <a href="<?=PATH?>realisations/<?=$achievement['id']?>-<?=$achievement['url_rewrite']?>.html">
                        <h4><?=$achievement['title']?></h4>
                    </a>
                </li>
                <? endforeach; ?>
            </ul>
        </li>
        <li class="plan_list_item">
            <a href="<?=PATH?>tutoriels/">
                <h3>Tutoriels</h3>
            </a>
            <ul>
                <? foreach($this->_tutorials as $tutorial) : ?>
                <li class="plan_list_item">
                    <a href="<?= PATH . 'tutoriels/' . $tutorial['id'] . '-' . $tutorial['url_rewrite'] ?>.html">
                        <h4><?=$tutorial['subject']?></h4>
                    </a>
                </li>
                <? endforeach; ?>
            </ul>
        </li>
        <li class="plan_list_item">
            <a href="<?=PATH?>clients/">
                <h3>Espace Client</h3>
            </a>
            <ul>
                <li class="plan_list_item">
                    <a href="<?=PATH?>clients/website/">
                        <h4>Mon site internet en direct</h4>
                    </a>
                </li>
                <li class="plan_list_item">
                    <a href="<?=PATH?>clients/payments/">
                        <h4>Mes Paiements</h4>
                    </a>
                </li>
                <li class="plan_list_item">
                    <a href="<?=PATH?>clients/chatbox/">
                        <h4>Messagerie entre vous et nous</h4>
                    </a>
                </li>
                <li class="plan_list_item">
                    <a href="<?=PATH?>clients/users/account/">
                        <h4>Mes informations</h4>
                    </a>
                </li>
            </ul>
        </li>
        <li class="plan_list_item">
            <a href="<?=PATH?>contact/">
                <h3>Contact</h3>
            </a>
        </li>
    </ul>
</div>