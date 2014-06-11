<div id="likes_and_followings">
    <div class="sub_block">
        <div id="fb_block">
            <div id="fb_like">
                <?Utils::loadFbLike('https://www.facebook.com/tonsiteinternet', 185, false, 'box_count' );?>
            </div>
            <a id="fb_link" target="_blank" href="https://www.facebook.com/tonsiteinternet/">
                <img alt="facebook" src="<?=SOCIALNETWORKS_PATH?>images/facebook_logo100x100.png" />
            </a>
        </div>
        <div id="linkedin_block">
            <div id="linkedin_like">
                <?Utils::loadLinkedinLike('http://www.linkedin.com/company/tonsiteinternet-fr/', 'top');?>
            </div>
            <a id="linkedin_link" target="_blank" href="http://www.linkedin.com/company/tonsiteinternet-fr/">
                <img alt="linkedin" src="<?=SOCIALNETWORKS_PATH?>images/linkedin_logo100x100.png" />
            </a>
        </div>
    </div>
    <div class="sub_block">
        <div id="twitter_block">
            <div id="twitter_like">
                <?Utils::loadTwitterLike('https://twitter.com/tonsiteinternet', 'tonsiteinternet');?>
            </div>
            <a id="twitter_link" target="_blank" href="https://twitter.com/tonsiteinternet">
                <img alt="twitter" src="<?=SOCIALNETWORKS_PATH?>images/twitter_logo100x100.png" />
            </a>
        </div>
        <div id="google_block">
            <div id="google_like">
                <?Utils::loadGoogleLike('https://plus.google.com/112253164378066733164', 185, 'tall', '', 'fr_FR');?>
            </div>
            <a id="google_link" target="_blank" href="https://plus.google.com/112253164378066733164/">
                <img alt="google" src="<?=SOCIALNETWORKS_PATH?>images/gplus_logo100x100.png" />
            </a>
        </div>
    </div>
</div>