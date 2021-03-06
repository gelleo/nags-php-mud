<?
class COMMAND_SOCIALS
{
	var $NAME = "COMMAND_SOCIALS";
     var $ENABLED;
     var $REQUIRED_FLAG = "";
          /*   ENABELED = bool
               Denotes the class is active and available
          */
    
     function COMMAND_SOCIALS(&$sys_message)
     {
          $this->MESSAGE =& $sys_message;
          $this->MESSAGE->SYSMESSAGE($this->NAME, "SYSTEM", "LOAD COMMAND");
          $this->ENABLED = True;
          return True;
     }
     function INITIALIZE($OBJECT_ARRAY)
     {
          foreach($OBJECT_ARRAY as $key => &$value)
          {
               if(!$this->{$key} =& $value){return False;}
          }
          $this->MESSAGE->SYSMESSAGE($this->NAME, "SYSTEM", "INIT COMMAND");
          return True;
     }
     function LOAD_COMMANDS()
     {
          $this->INTERPRETER->ADD_ACTION($this->NAME,"SOCIALS", "SOCIALS", "", $this->REQUIRED_FLAG);
          $this->PFLAGS->ADD_FLAG($this->REQUIRED_FLAG);
          return True;
     }
     function SOCIALS($message)
     {
		$socket = $this->SYSTEM->CURRENT_SOCKET;
		$this->COMMUNICATION->SEND_TO_CHAR("Loaded Socials:\n");
		$x=0;
		$social_array = $this->DATABASE->GET_RESULTS("select social_command from socials");
		foreach($social_array as $item)
		{
			if($x == 10)
			{
				$this->COMMUNICATION->SEND_TO_CHAR($item[0]."\n");
				$x=0;
			}else{
				$this->COMMUNICATION->SEND_TO_CHAR($item[0].", ");
				$x++;
			}
		}
		if($x != 0)
		{
			$this->COMMUNICATION->SEND_TO_CHAR("\n");
		}
     }  
}
?>