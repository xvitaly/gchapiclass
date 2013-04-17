<?php
/**
*
* @package Garant Checker API Class
* @copyright (c) 2005 - 2012 EasyCoding Team
* @license http://www.gnu.org/licenses/gpl.html GPLv3
*
*/
class GchAPI
{
  const URI = "%s://check.team-fortress.ru/api.php?action=check&token=%s&id=%s";
  const Token = "";
  
  public $SteamID32;
  public $SteamID64;
  public $Nickname;
  public $AvatarURI;
  public $OnlineStatus;
  public $CustomDescription;
  public $SiteStatus;
  public $IsBanned;
  public $IsF2P;
  public $TradeStatus;
  public $IsPremium;
  public $Permalink;
  
  function __construct($user, $IsSSL = true)
  {
    $AURI = sprintf(self::URI, $IsSSL ? "http" : "https", self::Token, $user);
    if ($xml = simplexml_load_file($AURI))
    {
      if ($xml -> qstatus != "OK") { throw new InvalidArgumentException("API returned error in request."); }
      $this -> SteamID32 = (string)$xml -> steamID;
      $this -> SteamID64 = (string)$xml -> steamID64;
      $this -> Nickname = (string)$xml -> nickname;
      $this -> AvatarURI = (string)$xml -> avatar;
      $this -> OnlineStatus = (string)$xml -> olstatus;
      $this -> CustomDescription = (string)$xml -> customdescr;
      $this -> SiteStatus = (int)$xml -> sitestatus;
      $this -> IsBanned = (int)$xml -> isbanned;
      $this -> IsF2P = (int)$xml -> isf2p;
      $this -> TradeStatus = (int)$xml -> istrbanned;
		$this -> IsPremium = (int)$xml -> ispremium;
      $this -> Permalink = (string)$xml -> permalink;
    }
    else
    {
      throw new Exception("Can't parse XML.");
    }
  }
}
?>