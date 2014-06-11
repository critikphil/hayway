<?php
class Model extends Utils {

    protected $_db;
    protected $_fb;
    
    function __construct(){
        $this->initDB();
        $this->initFB();
    }

    private function initDB()
    {
        $this->_db = new DbClass();
        $this->_db->dbConnect();
    }
    
    private function initFB()
    {
        $this->_fb = new Facebook();
    }
    
    public function insert($_table, $_data)
    {
        try {
            $this->_db->setTable($_table);
            return $this->_db->insert( $_data );
        }
        catch (SException $e) {
            throw $e;
        }
    }
    
    public function delete($_table, array $_where)
    {
        try {
            $this->_db->setTable($_table);
            return $this->_db->delete( $_where );
        }
        catch (SException $e) {
            throw $e;
        }
    }
    
    public function update($_table, array $_data, array $_where)
    {
        try {
            $this->_db->setTable($_table);
            return $this->_db->update( $_data, $_where );
        }
        catch (SException $e) {
            throw $e;
        }
    }
    
    public function selectAll($_table, array $_where = array(), array $_orderBy = array())
    {
        try {
            $this->_db->setTable($_table);
            return $this->_db->selectAll($_where, $_orderBy);
        }
        catch (SException $e) {
            throw $e;
        }
    }
    
    public function selectOne($_table, array $_where = array())
    {
        try {
            $this->_db->setTable($_table);
            return $this->_db->selectOne($_where);
        }
        catch (SException $e) {
            throw $e;
        }
    }
    
    public function selectColumn($_table, $_select, array $_where = array())
    {
        try {
            $this->_db->setTable($_table);
            return $this->_db->selectColumn($_select, $_where);
        }
        catch (SException $e) {
            throw $e;
        }
    }
    
    function fbDestroySession()
    {
        $this->_fb->destroySession();
    }
    
    function getFbPermissions()
    {
        $permissions = unserialize(FB_PERMISSIONS);
        return implode(',', $permissions);
    }
    
    function getFbLoginUrl($urlBack = PATH)
    {
        $params = array( 'redirect_uri' => $urlBack, 'scope' => $this->getFbPermissions() );
        return $this->_fb->getLoginUrl($params);
        
    }
    
    function getFbLogoutUrl($urlBack)
    { //not working
        $params = array( 'next' => $urlBack, 'access_token' => $this->_fb->getAccessToken() );
        return $this->_fb->getLogoutUrl($params);
    }
    
    function getFbUser()
    {
        return $this->_fb->getUser();
    }
    
    function getFbAppId()
    {
        return $this->_fb->getAppId();
    }
    
    function getFbAppAccessToken()
    {
        try {
            $token_url =	"https://graph.facebook.com/oauth/access_token?" .
				"client_id=" . $this->_fb->getAppId() .
				"&client_secret=" . $this->_fb->getApiSecret() .
				"&grant_type=client_credentials";
            
            $token = file_get_contents($token_url);
            $token = explode('=', $token);
            return $token[1];
        }
        catch (Exception $e) {
            debeug( $e);
        }
    }
    
    function getFbUserName($_fbUserId = 'me', $accessToken = false)
    {
        if($accessToken)
        {
            $accessToken = '&access_token='.$accessToken;
        }
        else 
        {
            $accessToken = '';
        }
        try{
            $user = $this->_fb->api('/'.$_fbUserId.'?fields=name'.$accessToken);
            return $user['name'];
        }
        catch (Exception $e)
        {
            return false;
        }
    }
    
    function getFbUserInfo($_fbUserId = 'me', $accessToken = false)
    {
        if($accessToken)
        {
            $accessToken = 'access_token='.$accessToken;
        }
        else 
        {
            $accessToken = '';
        }
        try{
            $user = $this->_fb->api('/'.$_fbUserId.'?'.$accessToken);
            return $user;
        }
        catch (Exception $e)
        {
            return false;
        }
    }
    
    function getFbUserFirstName($_fbUserId = 'me', $accessToken = false)
    {
        if($accessToken)
        {
            $accessToken = '&access_token='.$accessToken;
        }
        else 
        {
            $accessToken = '';
        }
        try{
            $user = $this->_fb->api('/'.$_fbUserId.'?fields=first_name'.$accessToken);
            return $user['name'];
        }
        catch (Exception $e)
        {
            return false;
        }
    }
    
    function getFbUserLastName($_fbUserId = 'me', $accessToken = false)
    {
        if($accessToken)
        {
            $accessToken = '&access_token='.$accessToken;
        }
        else 
        {
            $accessToken = '';
        }
        try{
            $user = $this->_fb->api('/'.$_fbUserId.'?fields=first_name'.$accessToken);
            return $user['name'];
        }
        catch (Exception $e)
        {
            return false;
        }
    }
    
    function getFbUserEmail($_fbUserId = 'me', $accessToken = false)
    {
        if($accessToken)
        {
            $accessToken = '&access_token='.$accessToken;
        }
        else 
        {
            $accessToken = '&access_token='.$this->_fb->getAccessToken();
        }
        try{
            $user = $this->_fb->api('/'.$_fbUserId.'?fields=email'.$accessToken);
            return $user['email'];
        }
        catch (Exception $e)
        {
            return false;
        }
    }
    
    function getFbUserProfilePicture($_fbUserId = 'me', $accessToken = false)
    {
        if($accessToken)
        {
            $accessToken = '&access_token='.$accessToken;
        }
        else 
        {
            $accessToken = '&access_token='.  $this->_fb->getAccessToken();
        }
        try{
            $user = $this->_fb->api('/'.$_fbUserId.'?fields=picture'.$accessToken);
            return $user['picture']['data']['url'];
        }
        catch (Exception $e)
        {
            return false;
        }
    }
    
    function getFbUserBigProfilePicture($_fbUserId)
    {
        $query = "SELECT pic_big FROM user WHERE uid='".$_fbUserId."'";
        $fbPicture = $this->_fb->api(array(
                    'method'    => 'fql.query',
                    'locale' => 'en_US',
                    'query'     => $query,
                    'callback'  => ''
                ));

        return $fbPicture[0]['pic_big'];
    }
    
    function getFbUserNameByFbId( $_fbUserId )
    {
        $query = "SELECT name FROM user WHERE uid='$_fbUserId'";
        $userName = $this->_fb->api(array(
                    'method'    => 'fql.query',
                    'locale' => 'en_US',
                    'query'     => $query,
                    'callback'  => ''
                ));

        return $userName[0];
    }
    
    function sendFbNotification($_fbUserId, $_message, $_href = PATH)
    {
        try{
            $accessToken = $this->getFbAppAccessToken();
            $params = array('access_token' => $accessToken, 'template' => $_message, 'href' => $_href);
            $result = $this->_fb->api('/'.$_fbUserId.'/notifications', 'POST', $params);
            return $result;
        }
        catch (Exception $e)
        {
            return $e;
        }
    }
    
    static function sendMail($_mailTo, $_nameTo, $_subject, $_body, $_mailFrom = MAIL_FROM, $_nameFrom = MAIL_NAME, $isHTML = true)
    {
        $Mailer = new PHPMailer();

        $Mailer->IsHTML($isHTML);
        $Mailer->CharSet = 'UTF-8';
        $Mailer->Subject = $_subject;
        $Mailer->Body = $_body;
        $Mailer->SetFrom($_mailFrom, $_nameFrom);
        $Mailer->AddAddress($_mailTo, $_nameTo);
        return $Mailer->send();
    }
    
}
?>