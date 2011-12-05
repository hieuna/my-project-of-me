<?php
// $Id: SohaPayOAuth2.inc,v 1.1 2011/01/25 09:27:08 hswong3i Exp $

/**
 * @file
 * SohaPay OAuth2 Implementation
 */
 

if (!defined("PG_ROOT")) die("123");
require_once(PG_ROOT."/include/oauth/OAuth2.php");

define('TBL_OAUTH2_CLIENTS', 'sites');

class SohaPayOAuth2 extends OAuth2 {
   private $db = NULL;

  /**
   * Overrides OAuth2::__construct().
   */
  public function __construct($config = array()) {
    global $database;

    parent::__construct($config);
    
    $this->db = $database;

    $result = NULL;

   // Hack to corresponding user if oauth_token provided.
   if (isset($_REQUEST['oauth_token'])) {
     $result = $this->getAccessToken($_REQUEST['oauth_token']);
   }
   // Hack to corresponding user if code provided.
   elseif (isset($_REQUEST['code'])) {
     $result = $this->getAuthCode($_REQUEST['code']);
   }
   // Hack to corresponding user if refresh_token provided.
   elseif (isset($_REQUEST['refresh_token'])) {
     $result = $this->getRefreshToken($_REQUEST['refresh_token']);
   }

   if ($result) {
     $this->loadUserCredentials($result['user_id'], $result['user_username'], $result['sid']);
   }
  }

  /**
   * Load the user based on uid and name, assign with corresponding session;
   * or create dummy user on-the-fly.
   *
   * @param $uid
   *   The user ID.
   * @param $name
   *   The user name.
   * @param $sid
   *   The target session ID to be set with.
   *
   * @return
   *   The user object after successful login.
   */
  protected function loadUserCredentials($uid, $name, $sid) {
    global $user;

    // Some client/servers, like XMLRPC, do not handle cookies, so
    // imitate it to make sess_read() function try to look for user,
    // instead of just loading anonymous user :).
    $session_name = session_name();
    if (!isset($_COOKIE[$session_name])) {
      $_COOKIE[$session_name] = $sid;
    }

    session_id($sid);
    return $user;
  }

  /**
   * Verify authorized scopes for end-user.
   * 
   * (DzungDH 2011/03/21)
   *
   * @param $client_id
   *   The client identifier to be check with.
   * @param $required_scope
   *   The required scope within current request.
   * @param $uid
   *   The user ID.
   *
   * @return
   *   A list of all extended scopes besides authorized scopes of end-user.
   */
  public function verifyAuthorizedScopes($client_id, $required_scope, $uid) {
    $authorized_scope = $this->getAuthorizedScopes($client_id, $uid);
    $hidden_scope = $this->getHiddenScopes();

    if (!is_array($required_scope))
      $required_scope = explode(",", $required_scope);
    $required_scope = array_unique(array_merge($required_scope, $hidden_scope));

    $scopes = $this->checkExtendedPermissions($required_scope, $authorized_scope);

    $extended_permissions = array();
    foreach ($scopes as $scope) {
      $stmt = $this->db->db_query(sprintf("SELECT scope_id, hidden, bypass FROM oauth2_scopes WHERE scope_id = '%s' AND status=1", $scope));
      $extended_permissions[] = $this->db->db_fetch_assoc($stmt);
    }

    return array_filter($extended_permissions);
  }

  /**
   * Get all hidden scopes that should be automatically included within blank
   * scope request.
   * 
   * (DzungDH 2011/03/21)
   *
   * @return
   *   A list for all hidden scopes.
   */
  public function getHiddenScopes() {
    $stmt = $this->db->db_query("SELECT scope_id FROM oauth2_scopes WHERE hidden = 1 AND status=1");
    $scopes = array();
    while ($result = $this->db->db_fetch_assoc($stmt)) {
      $scopes[] = $result['scope_id'];
    }
    return $scopes;
  }

  /**
   * Get all authorized scopes for end-user.
   * 
   * (DzungDH 2011/03/21)
   *
   * @param $client_id
   *   The client identifier to be check with.
   * @param $uid
   *   The user ID.
   *
   * @return
   *   A list for all authorized scopes for this end-user.
   */
  public function getAuthorizedScopes($client_id, $uid) {
    $stmt = $this->db->db_query(sprintf("SELECT scope_id FROM oauth2_authorize WHERE client_id = '%s' AND uid = %d", $client_id, $uid));
    $scopes = array();
    while ($result = $this->db->db_fetch_assoc($stmt)) {
      $scopes[] = $result['scope_id'];
    }
    return $scopes;
  }

  /**
   * Set authorized scopes for end-user.
   *
   * @param $client_id
   *   The client identifier to be authorize.
   * @param $scopes
   *   The scopes as a list of space-delimited strings.
   * @param $uid
   *   The user ID.
   */
  public function setAuthorizedScopes($client_id, $scopes, $uid) {
    $scope_ids = explode(",", $scopes);
    foreach ($scope_ids as $scope_id) {
      $this->db->db_query(sprintf("INSERT INTO oauth2_authorize (client_id, uid, scope_id) VALUES ('%s', %d, '%s')", $client_id, $uid, $scope_id));
    }
  }

  /**
   * Unset authorized scopes for end-user.
   * 
   * (DzungDH 2011/03/21)
   *
   * @param $client_id
   *   The client identifier to be unauthorize.
   * @param $scopes
   *   The scopes as a list of space-delimited strings.
   * @param $uid
   *   The user id.
   */
  public function unsetAuthorizedScopes($client_id, $scopes, $uid) {
    $scope_ids = explode(",", $scopes);
    foreach ($scope_ids as $scope_id) {
      $this->db->db_query(sprintf("DELETE FROM oauth2_authorize WHERE client_id = '%s' AND uid = %d AND scope_id = '%s'", $client_id, $uid, $scope_id));
    }
  }

  /**
   * Check if any extended permissions besides authorized scopes.
   * 
   * (DzungDH 2011/03/21)
   *
   * @param $required_scope
   *   The target required scope within current request.
   * @param $authorized_scope
   *   Scopes that already authorized by end-user.
   *
   * @return
   *   A list with all extended permissions.
   */
  private function checkExtendedPermissions($required_scope, $authorized_scope) {
    // The required scope should match or be a subset of the available scope
    if (!is_array($required_scope))
      $required_scope = explode(",", $required_scope);

    if (!is_array($authorized_scope))
      $authorized_scope = explode(",", $authorized_scope);

    return array_filter(array_diff($required_scope, $authorized_scope));
  }

  /**
   * Expires all OAuth2.0 related tokens based on sid.
   *
   * @param $sid
   *   Session ID to be expires with.
   *
   * @return
   *   TRUE if successful, and FALSE if it isn't.
   */
  public function expireSession($sid) {
    // Purge tokens based on oauth_token if provided.
    if (isset($_REQUEST['oauth_token']) && !empty($_REQUEST['oauth_token'])) {
      $result = $this->getAccessToken($_REQUEST['oauth_token']);
      if ($result) {
        $sid = $result['sid'];
      }
    }

    // Purge tokens if session found.
    if ($sid) {
      if (!isset($_GET['redirect_uri'])) {
        // We hack $_REQUEST['redirect_uri'] so handle it custom logout.
        $result = $this->db->db_fetch_assoc($this->db->db_query(sprintf("SELECT oc.redirect_uri
          FROM oauth2_access_tokens AS oat
            INNER JOIN ".TBL_OAUTH2_CLIENTS." AS oc ON oat.client_id = oc.site_client_id
          WHERE oat.sid = '%s' AND oc.site_publish=1", $sid)));
        $_GET['redirect_uri'] = $result['redirect_uri'];
      }

      // Expirse all tokens base on this session_id.
      $this->db->db_query(sprintf("DELETE FROM oauth2_access_tokens WHERE sid = '%s'", $sid));
      $this->db->db_query(sprintf("DELETE FROM shp_oauth2_auth_codes WHERE sid = '%s'", $sid));
      $this->db->db_query(sprintf("DELETE FROM oauth2_refresh_tokens WHERE sid = '%s'", $sid));

      // Also manually destroy user session.
      if (session_id($sid) != $sid) {
        session_start();
        session_id($sid);
      }

      return session_destroy();
    }

    return FALSE;
  }

  /**
   * Implements OAuth2::checkClientCredentials().
   */
  public function checkClientCredentials($client_id, $client_secret = NULL) {
    $stmt = $this->db->db_query(sprintf("SELECT site_secure_secret FROM ".TBL_OAUTH2_CLIENTS." WHERE site_client_id = '%s' AND site_publish=1", $client_id));
    $result = $this->db->db_fetch_assoc($stmt);
    return ($client_secret !== NULL && $result['site_secure_secret'] == $client_secret) ? TRUE : FALSE;
  }

  /**
   * Implements OAuth2::getRedirectUri().
   */
  public function getRedirectUri($client_id) {
    $stmt = $this->db->db_query(sprintf("SELECT redirect_uri FROM ".TBL_OAUTH2_CLIENTS." WHERE site_client_id = '%s' AND site_publish=1", $client_id));
    $result = $this->db->db_fetch_assoc($stmt);
    return $result['redirect_uri'] !== FALSE ? $result['redirect_uri'] : NULL;
  }

  /**
   * Implements OAuth2::getAccessToken().
   */
  public function getAccessToken($oauth_token) {
    $stmt = $this->db->db_query(sprintf("SELECT oat.client_id, oat.sid, oat.expires, oat.scope, u.user_id, u.user_username
      FROM oauth2_access_tokens AS oat
        INNER JOIN shp_users AS u ON oat.uid = u.user_id
      WHERE oat.oauth_token = '%s'", $oauth_token));
    return $this->db->db_fetch_assoc($stmt);
  }

  /**
   * Implements OAuth2::setAccessToken().
   */
  public function setAccessToken($oauth_token, $client_id, $expires, $scope = '', $uid = 0, $sid = '') {
    global $user;
    $uid = ($uid == 0 && $user->user_info['user_id'] != 0) ? $user->user_info['user_id'] : $uid;
    $sid = ($sid == '' && session_id()) ? session_id() : $sid;
    return $this->db->db_query(sprintf("INSERT INTO oauth2_access_tokens (oauth_token, client_id, expires, scope, uid, sid) VALUES ('%s', '%s', %d, '%s', %d, '%s')", $oauth_token, $client_id, $expires, $scope, $uid, $sid));
  }

  /**
   * Overrides OAuth2::getSupportedGrantTypes().
   */
  protected function getSupportedGrantTypes() {
    return array(
      OAUTH2_GRANT_TYPE_AUTH_CODE,
      OAUTH2_GRANT_TYPE_USER_CREDENTIALS,
      OAUTH2_GRANT_TYPE_REFRESH_TOKEN,
      OAUTH2_AUTH_RESPONSE_TYPE_CLIENT_CREDENTIALS
    );
  }

  /**
   * Overrides OAuth2::getSupportedScopes().
   */
  public function getSupportedScopes() {
    $stmt = $this->db->db_query("SELECT scope_id FROM oauth2_scopes WHERE status = 1");
    $scope_ids = array();
    while ($result = $this->db->db_fetch_assoc($stmt)) {
      $scope_ids[] = $result['scope_id'];
    }
    return $scope_ids;
  }

  /**
   * Overrides OAuth2::getAuthCode().
   */
  public function getAuthCode($code) {
    $stmt = $this->db->db_query(sprintf("SELECT oac.client_id, oac.sid, oac.redirect_uri, oac.expires, oac.scope, u.user_id, u.user_username
      FROM shp_oauth2_auth_codes AS oac
        INNER JOIN shp_users AS u ON oac.uid = u.user_id
      WHERE oac.code = '%s'", $code));
      
    return $this->db->db_fetch_assoc($stmt);
  }

  /**
   * Overrides OAuth2::setAuthCode().
   */
  public function setAuthCode($code, $client_id, $redirect_uri, $expires, $scope = '', $uid = 0, $sid = '') {
    global $user;
    $uid = ($uid == 0 && $user->user_info['user_id'] != 0) ? $user->user_info['user_id'] : $uid;
    $sid = ($sid == '' && session_id()) ? session_id() : $sid;
    return $this->db->db_query(sprintf("INSERT INTO shp_oauth2_auth_codes (code, client_id, redirect_uri, expires, scope, uid, sid) VALUES ('%s', '%s', '%s', %d, '%s', %d, '%s')", $code, $client_id, $redirect_uri, $expires, $scope, $uid, $sid));
  }

  /**
   * Overrides OAuth2::checkUserCredentials().
   */
  public function checkUserCredentials($client_id, $username, $password) {
    // Clone from user_service_login().
    /*$account = user_authenticate(array('name' => $username, 'pass' => $password));

    $result = NULL;
    if ($account->uid) {
      // Regenerate the session ID to prevent against session fixation attacks.
      sess_regenerate();
      $array = array();
      user_module_invoke('login', $array, $account);

      $result = array(
        'uid' => $account->uid,
        'name' => $account->name,
        'sid' => session_id(),
        'scope' => trim(implode(' ', $this->getAuthorizedScopes($client_id, $account->uid))),
      );
    }

    return $result ? $result : FALSE;*/
    return NULL;
  }

  /**
   * Overrides OAuth2::getRefreshToken().
   */
  public function getRefreshToken($refresh_token) {
    $stmt = $this->db->db_query(sprintf("SELECT ort.client_id, ort.sid, ort.expires, ort.scope, u.uid, u.name
      FROM oauth2_refresh_tokens AS ort
        INNER JOIN shp_users AS u ON ort.uid = u.user_id
      WHERE ort.refresh_token ='%s'", $refresh_token));
    return $this->db->db_fetch_assoc($stmt);
  }

  /**
   * Overrides OAuth2::setRefreshToken().
   */
  public function setRefreshToken($refresh_token, $client_id, $expires, $scope = '', $uid = 0, $sid = '') {
    global $user;
    $uid = ($uid == 0 && $user->user_info['user_id'] != 0) ? $user->user_info['user_id'] : $uid;
    $sid = ($sid == '' && session_id()) ? session_id() : $sid;
    return $this->db->db_query(sprintf("INSERT INTO oauth2_refresh_tokens (refresh_token, client_id, expires, scope, uid, sid) VALUES ('%s', '%s', %d, '%s', %d, '%s')", $refresh_token, $client_id, $expires, $scope, $uid, $sid));
  }

  /**
   * Overrides OAuth2::unsetRefreshToken().
   */
  public function unsetRefreshToken($refresh_token) {
    return $this->db->db_query(sprintf("DELETE FROM oauth2_refresh_tokens WHERE refresh_token = '%s'", $refresh_token));
  }
  
  /**
   * Return value to client
   * @param $values
   *   Value(s) returned to client
   * 
   * @return
   *  Return message to client
   * 
   */
   
   public function returnMessage($value){
      $json_callback = isset($_REQUEST['callback'])?$_REQUEST['callback']:false;
      $request_type = isset($_REQUEST['type'])?$_REQUEST['type']:"jsonp";
      $return = "";
      
      if ($json_callback){$return = sprintf($json_callback."(%s);", json_encode($value));}
      else $return = json_encode($value);
      
      if ($request_type=="popup"){
         $return = sprintf("<script language='javascript' type='text/javascript'>window.close();</script>", "");
      }
      
      print $return;
      exit();
   }
   
   /**
    * Return Client Information
    * 
    * @return
    *  Return Client Information Array
    */
    public function getClient(){
      $oauth_token = isset($_REQUEST['oauth_token'])?$_REQUEST['oauth_token']:"";
      
      $result = $this->db->db_query(sprintf("SELECT cl.* 
         FROM sites AS cl 
            INNER JOIN oauth2_access_tokens AS at ON cl.site_client_id=at.client_id
         WHERE at.oauth_token='%s'", $oauth_token));
      return $this->db->db_fetch_assoc($result);
    }
    
    public function checkRequest(){
      $request = urldecode(isset($_REQUEST['request'])?$_REQUEST['request']:"");
      $oauth_token = isset($_REQUEST['oauth_token'])?$_REQUEST['oauth_token']:"";
      $client = $this->getClient();
      
      $secure_hash = substr($request, 0, 32);
      $sParams = substr($request, 32);
      $calculatedSecureHash = strtoupper(md5($sParams.$oauth_token.$client['site_secure_secret']));
      if ($secure_hash != $calculatedSecureHash) return false;
      else return unserialize(base64_decode($sParams));
    }
}
