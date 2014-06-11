<!doctype html>
<html lang="fr">
    
    <head>
        <meta charset="UTF-8" />
    </head>

    <body style="color: #333333;margin: auto;max-width: 640px;width: 100%;background-color: #FFFFFF;font-family: Helvetica,Verdana,Arial;">

        <div style="background-color: #F1F1F1;margin: 20px auto;padding: 20px 2.5% 130px;position: relative;border: 1px solid #DDDDDD;">
            <div style="">
                <div style="background-color: #212628;padding: 10% 5%;">
                    <div style="display: inline-block;text-align: center;width: 20%;">
                        <img style="display: inline-block;margin: 0;padding: 0;vertical-align: middle;width: 50px;" src="<?=PATH?>/template/default/images/tonsiteinternet.fr_logo_white.png" />
                    </div>
                    <h1 style="color: #FFFFFF !important;display: inline-block;font-size: 1.5em;margin: 0;padding: 0;">tonsiteinternet .fr</h1>
                </div>
                <div style="background: none repeat scroll 0 0 #FFFFFF;box-shadow: 0 0 5px #ADADAD inset;margin: 0 0 20px;min-height: 300px;padding: 20px 5%;">
                    <? $this->loadView(); ?>
                </div>
            </div>
            <div style="bottom: 0;left: 5%;padding: 0;position: absolute;font-size: 0.8em;width: 90%;">
                <div style="">
                    <p style="">Cordialement,</p>
                    <p style="">L'équipe de <?=DOM_NAME?></p>
                </div>
                <div style="color: #8D8D8D;text-align: center;padding: 10px;">
                    <p style="">Copyright © 2014  tonsiteinternet .fr. Tous droits réservés.</p>
                </div>
            </div>
	</div>
        
        
        <div>
            <p style="font-size: 12px;"><a href="<?=DOM_NAME?>/account/">Vous ne souhaitez plus recevoir d'e-mail de la part de <?=DOM_NAME?> ?</a></p>
        </div>
            
        
    </body>
    
</html>