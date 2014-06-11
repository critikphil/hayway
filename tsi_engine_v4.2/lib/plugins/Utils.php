<?php

abstract class  Utils{
    
    /*
     * @return string "phone" if phone case,
     *         string "tablet" if tablet case,
     *         false else
     */
    static function isMobile()
    {
        $MobileDetect = new Mobile_Detect();
        return($MobileDetect->isMobile()) ? ($MobileDetect->isTablet() ? "tablet" : "phone") : false;
    }
    
    static function isSearchEnginesBot()
    {
        $searchengines = array(
                                'Googlebot', 
                                'Slurp', 
                                'search.msn.com', 
                                'nutch', 
                                'simpy', 
                                'bot', 
                                'ASPSeek', 
                                'crawler', 
                                'msnbot', 
                                'Libwww-perl', 
                                'FAST', 
                                'Baidu', 
                              );
        foreach ($searchengines as $searchengine)
        {
            if (!empty($_SERVER['HTTP_USER_AGENT']) && strpos(strtolower($_SERVER['HTTP_USER_AGENT']), strtolower($searchengine)))
            {
                    return $searchengine;
            }
        }
        return false;
    }
    
    static function loadFbSync ( $lang = FB_LANG )
    {
        try 
        {
            require_once(MOTOR_ABS_PATH."lib/require/fb_sync.php");
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }   
    }
    
    static function loadGoogleMap ( $latitude, $longitude, $zoom = 8, $marker = true, $type = 'ROADMAP' )
    {
        /*
         * All map types :
         * 
         * ROADMAP displays the normal, default 2D tiles of Google Maps.
         * SATELLITE displays photographic tiles.
         * HYBRID displays a mix of photographic tiles and a tile layer for prominent features (roads, city names).
         * TERRAIN displays physical relief tiles for displaying elevation and water features (mountains, rivers, etc.).

         */
        try 
        {
            require_once(MOTOR_ABS_PATH."lib/require/google_map.php");
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }   
    }
    
    static function loadFbLike ($pageUrl = FB_PAGE_URL, $width = 185, $faces = true, $layout = 'box_count', $share = false)
    {
        try 
        {
            require_once(MOTOR_ABS_PATH."lib/require/fb_like.php");
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }   
    }
    
    static function loadFbLikeBox ($pageUrl, $width = 185, $faces = true, $header = true, $stream = false, $border = false)
    {
        try 
        {
            require_once(MOTOR_ABS_PATH."lib/require/fb_like_box.php");
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }   
    }
    
    static function loadTwitterLike ($pageUrl, $via, $count = 'vertical', $lang = 'en_US')
    {
        try 
        {
            require_once(MOTOR_ABS_PATH."lib/require/twitter_like.php");
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }   
    }
    
    static function loadLinkedinLike ($pageUrl, $counterPosition = 'top', $lang = 'en_US')
    {
        try 
        {
            require_once(MOTOR_ABS_PATH."lib/require/linkedin_like.php");
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }   
    }
    
    static function loadGoogleLike ($pageUrl, $width = 185, $size = 'tall', $annotation = 'bubble', $lang = 'en_US')
    {
        try 
        {
            require_once(MOTOR_ABS_PATH."lib/require/google_like.php");
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }   
    }
    
    static function loadGoogleLikeBox ($pageUrl, $width = 185, $layout = 'portrait', $tagline = true)
    {
        try 
        {
            require_once(MOTOR_ABS_PATH."lib/require/google_like_box.php");
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }   
    }
    
    static function loadGoogleAnalytics ($analyticsId)
    {
        try 
        {
            require_once(MOTOR_ABS_PATH."lib/require/google_analytics.php");
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }   
    }
    
    static function loadSkypeButton ($skypeName, $call = true, $chat = true, $imageSize = 32)
    {
        try 
        {
            require_once(MOTOR_ABS_PATH."lib/require/skype_button.php");
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }   
    }
    
    static public function isInternetExplorer()
    {
        if (isset($_SERVER['HTTP_USER_AGENT']) && 
        (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
            return true;
        else
            return false;
    }
    
    
    static public function hashStr($_str)
    {
        if(!defined('SALT')) {
            throw new Exception('Utils::hashStr -> SALT need to be declared in configs');
        }
        return sha1(SALT . $_str);
    }
    
    /*
     * translator
     */
    static final public function renderText($text)
    {
        if($_SESSION['lang'] != 'en')
        {
            $file = "lib/lang/".$_SESSION['lang'];
            $fp = fopen($file,"r");
            $content = fread($fp,filesize($file));
            fclose($fp);
            $content = explode(";",$content);
            foreach ($content as $word)
            {
                if( strstr($word,$text.":"))
                {
                    return substr(strstr($word,":"),1 );
                }
            }
        }
        return $text;
    }
    
    static final public function fctredimimage($W_max, $H_max, $rep_Dst, $img_Dst, $rep_Src, $img_Src) 
    {
        // ------------------------------------------------------------------
        $condition = 0;
        // Si certains parametres ont pour valeur '' :
        if ($rep_Dst == '') { $rep_Dst = $rep_Src; } // (meme repertoire)
        if ($img_Dst == '') { $img_Dst = $img_Src; } // (meme nom)
        // ------------------------------------------------------------------
        // si le fichier existe dans le répertoire, on continue...
        if (file_exists($rep_Src.$img_Src) && ($W_max!=0 || $H_max!=0)) {
        // ----------------------------------------------------------------
        // extensions acceptees :
        $ExtfichierOK = '" jpg jpeg png"'; // (l espace avant jpg est important)
        // extension fichier Source
        $tabimage = explode('.',$img_Src);
        $extension = $tabimage[sizeof($tabimage)-1]; // dernier element
        $extension = strtolower($extension); // on met en minuscule
        // ----------------------------------------------------------------
        // extension OK ? on continue ...
        if (strpos($ExtfichierOK,$extension) != '') {
        // -------------------------------------------------------------
        // recuperation des dimensions de l image Src
        $img_size = getimagesize($rep_Src.$img_Src);
        $W_Src = $img_size[0]; // largeur
        $H_Src = $img_size[1]; // hauteur
        // -------------------------------------------------------------
        // condition de redimensionnement et dimensions de l image finale
        // -------------------------------------------------------------
        // A- LARGEUR ET HAUTEUR maxi fixes
        if ($W_max != 0 && $H_max != 0) {
        $ratiox = $W_Src / $W_max; // ratio en largeur
        $ratioy = $H_Src / $H_max; // ratio en hauteur
        $ratio = max($ratiox,$ratioy); // le plus grand
        $W = $W_Src/$ratio;
        $H = $H_Src/$ratio;
        $condition = ($W_Src>$W) || ($W_Src>$H); // 1 si vrai (true)
        } // -------------------------------------------------------------
        // B- HAUTEUR maxi fixe
        if ($W_max == 0 && $H_max != 0) {
        $H = $H_max;
        $W = $H * ($W_Src / $H_Src);
        $condition = $H_Src > $H_max; // 1 si vrai (true)
        }
        // -------------------------------------------------------------
        // C- LARGEUR maxi fixe
        if ($W_max != 0 && $H_max == 0) {
        $W = $W_max;
        $H = $W * ($H_Src / $W_Src);
        $condition = $W_Src > $W_max; // 1 si vrai (true)
        }
        // -------------------------------------------------------------
        // on REDIMENSIONNE si la condition est vraie
        // -------------------------------------------------------------
        // Par defaut :
        // Si l'image Source est plus petite que les dimensions indiquees :
        // PAS de redimensionnement.
        // Mais on peut "forcer" le redimensionnement en ajoutant ici :
        // $condition = 1;
        if ($condition == 1) {
        // ----------------------------------------------------------
        // creation de la ressource-image "Src" en fonction de l extension
        switch($extension) {
        case 'jpg':
        case 'jpeg':
        $Ress_Src = imagecreatefromjpeg($rep_Src.$img_Src);
        break;
        case 'png':
        $Ress_Src = imagecreatefrompng($rep_Src.$img_Src);
        break;
        }
        // ----------------------------------------------------------
        // creation d une ressource-image "Dst" aux dimensions finales
        // fond noir (par defaut)
        switch($extension) {
        case 'jpg':
        case 'jpeg':
        $Ress_Dst = imagecreatetruecolor($W,$H);
        break;
        case 'png':
        $Ress_Dst = imagecreatetruecolor($W,$H);
        // fond transparent (pour les png avec transparence)
        imagesavealpha($Ress_Dst, true);
        $trans_color = imagecolorallocatealpha($Ress_Dst, 0, 0, 0, 127);
        imagefill($Ress_Dst, 0, 0, $trans_color);
        break;
        }
        // ----------------------------------------------------------
        // REDIMENSIONNEMENT (copie, redimensionne, re-echantillonne)
        imagecopyresampled($Ress_Dst, $Ress_Src, 0, 0, 0, 0, $W, $H, $W_Src, $H_Src);
        // ----------------------------------------------------------
        // ENREGISTREMENT dans le repertoire (avec la fonction appropriee)
        switch ($extension) {
        case 'jpg':
        case 'jpeg':
        imagejpeg ($Ress_Dst, $rep_Dst.$img_Dst);
        break;
        case 'png':
        imagepng ($Ress_Dst, $rep_Dst.$img_Dst);
        break;
        }
        // ----------------------------------------------------------
        // liberation des ressources-image
        imagedestroy ($Ress_Src);
        imagedestroy ($Ress_Dst);
        }
        // -------------------------------------------------------------
        }
        }
        // -----------------------------------------------------------------------------------------------------
        // si le fichier a bien ete cree
        if ($condition == 1 && file_exists($rep_Dst.$img_Dst)) { return true; }
        else { return false; }
    } 
}
?>