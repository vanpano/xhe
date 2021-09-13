<?php
namespace Xhe;

use XheWindowInterface, XheWindowInterfaces;

class XheWindow extends XheWindowCompatible
{
			function __construct($server,$password="")
	{    
		$this->server = $server;
		$this->password = $password;
		$this->prefix = "Window";
	}
	
	
		function get_count($visibled=true,$mained=true)
	{
		$params = array( "visibled" => $visibled , "mained" => $mained );
		return $this->call_get(__FUNCTION__,$params);
	}
		function get_all_texts($visibled=true,$mained=true)
	{
		$params = array( "visibled" => $visibled , "mained" => $mained );
		return $this->call_get(__FUNCTION__,$params);
	}
		function get_text_by_number($number,$visibled=true,$mained=true)
	{
		$params = array( "number" => $number , "visibled" => $visibled , "mained" => $mained );
		return $this->call_get(__FUNCTION__,$params);
	}
		function get_number_by_text($text,$exactly=false,$visibled=true,$mained=true)
	{
		$params = array( "text" => $text , "exactly" => $exactly , "visibled" => $visibled , "mained" => $mained );
		return $this->call_get(__FUNCTION__,$params);
	}

	
		function get_child_count_by_number($number,$visibled=true,$mained=true)
	{
		$params = array( "number" => $number , "visibled" => $visibled , "mained" => $mained );
		return $this->call_get(__FUNCTION__,$params);
	}
		function get_child_texts_by_number($number,$visibled=true,$mained=true)
	{
		$params = array( "number" => $number , "visibled" => $visibled , "mained" => $mained );
		return $this->call_get(__FUNCTION__,$params);
	}

	
	        function execute_open_file($text,$path,$btn_text,$exactly=true,$thread=false)
	{
		$params = array( "text" => $text , "path" => $path , "btn_text" => $btn_text , "exactly" => $exactly , "thread" => $thread );
		return $this->call_boolean(__FUNCTION__,$params);
	}
	        function execute_download_file($path="")
	{
		$params = array( "path" => $path );
		return $this->call_boolean(__FUNCTION__,$params);
	}
	        function execute_prompt($caption,$text="",$btn_text="OK",$exactly=true)
	{
		$params = array( "caption" => $caption , "text" => $text , "btn_text" => $btn_text , "exactly" => $exactly);
		return $this->call_boolean(__FUNCTION__,$params);
	}
	        function execute_authorization($login="",$password="",$caption="������������ Windows")
	{
		$params = array( "login" => $login , "password" => $password , "caption" => $caption);
		return $this->call_boolean(__FUNCTION__,$params);
	}
	        function execute_print($path)
	{
		$params = array( "path" => $path );
		return $this->call_boolean(__FUNCTION__,$params);
	}
	
	
		function get_by_number($number,$mained=true,$visibled=true)
	{
		$params = array( "number" => $number , "mained" => $mained , "visibled" => $visibled);
		$internal_number=$this->call_get(__FUNCTION__,$params);

		return new XheWindowInterface($internal_number,$this->server,$this->password);
	}	
		function get_by_text($text,$exactly=false,$mained=true,$visibled=true)
	{
		$params = array( "text" => $text , "exactly" => $exactly , "mained" => $mained , "visibled" => $visibled);
		$internal_number=$this->call_get(__FUNCTION__,$params);

		return new XheWindowInterface($internal_number,$this->server,$this->password);
	}	
		function get_by_class($class_name,$exactly=false,$mained=true,$visibled=true)
	{
		$params = array( "class_name" => $class_name , "exactly" => $exactly , "mained" => $mained , "visibled" => $visibled);
		$internal_number=$this->call_get(__FUNCTION__,$params);

		return new XheWindowInterface($internal_number,$this->server,$this->password);
	}	
		function get_by_point($x,$y)
	{
		$params = array( "x" => $x , "y" => $y);
		$internal_number=$this->call_get(__FUNCTION__,$params);

		return new XheWindowInterface($internal_number,$this->server,$this->password);
	}	
		function get_by_hwnd($hwnd)
	{
		$params = array( "hwnd" => $hwnd );
		$internal_number=$this->call_get(__FUNCTION__,$params);

		return new XheWindowInterface($internal_number,$this->server,$this->password);
	}	
		function get_foreground_window()
	{
		$params = array( );
		$internal_number=$this->call_get(__FUNCTION__,$params);

		return new XheWindowInterface($internal_number,$this->server,$this->password);
	}	
		function get_focused_window()
	{
		$params = array( );
		$internal_number=$this->call_get(__FUNCTION__,$params);

		return new XheWindowInterface($internal_number,$this->server,$this->password);
	}	

	
		function get_all($mained=true,$visibled=true)
	{
		$params = array(  "mained" => $mained , "visibled" => $visibled);
		$internal_number=$this->call_get(__FUNCTION__,$params);

		return new XheWindowInterfaces($internal_number,$this->server,$this->password);
	}	
		function get_all_by_number($numbers,$mained=true,$visibled=true)
	{
		$params = array( "numbers" => $numbers , "mained" => $mained , "visibled" => $visibled);
		$internal_number=$this->call_get(__FUNCTION__,$params);

		return new XheWindowInterfaces($internal_number,$this->server,$this->password);
	}	
		function get_all_by_text($text,$exactly=false,$mained=true,$visibled=true)
	{
		$params = array( "text" => $text , "exactly" => $exactly , "mained" => $mained , "visibled" => $visibled);
		$internal_number=$this->call_get(__FUNCTION__,$params);

		return new XheWindowInterfaces($internal_number,$this->server,$this->password);
	}	
		function get_all_by_class($class_name,$exactly=false,$mained=true,$visibled=true)
	{
		$params = array( "class_name" => $class_name , "exactly" => $exactly , "mained" => $mained , "visibled" => $visibled);
		$internal_number=$this->call_get(__FUNCTION__,$params);

		return new XheWindowInterfaces($internal_number,$this->server,$this->password);
	}	
		function get_all_by_point($x,$y,$mained=true,$visibled=true)
	{
		$params = array( "x" => $x , "y" => $y , "mained" => $mained , "visibled" => $visibled);
		$internal_number=$this->call_get(__FUNCTION__,$params);

		return new XheWindowInterfaces($internal_number,$this->server,$this->password);
	}	
		function get_all_by_thread_id($thread_id,$mained=true,$visibled=true)
	{
		$params = array( "thread_id" => $thread_id , "mained" => $mained , "visibled" => $visibled);
		$internal_number=$this->call_get(__FUNCTION__,$params);

		return new XheWindowInterfaces($internal_number,$this->server,$this->password);
	}	
		function get_all_by_process_id($process_id,$mained=true,$visibled=true)
	{
		$params = array( "process_id" => $process_id , "mained" => $mained , "visibled" => $visibled);
		$internal_number=$this->call_get(__FUNCTION__,$params);

		return new XheWindowInterfaces($internal_number,$this->server,$this->password);
	}	

	   	function wait_for_window_open_by_text($text,$exactly=true,$main=false,$visibled=false,$wait_count=300,$wait_step=1,$is_verbose=true)
   	{
		$params = array( "text" => $text , "exactly" => $exactly, "main" => $main, "visibled" => $visibled, "wait_count" => $wait_count, "wait_step" => $wait_step, "is_verbose" => $is_verbose );
		return $this->call_boolean(__FUNCTION__,$params,$wait_count*$wait_step*2);
   	}   
	   	function wait_for_window_open_by_class($class_name,$exactly=true,$main=false,$visibled=false,$wait_count=300,$wait_step=1,$is_verbose=true)
   	{
		$params = array( "class_name" => $class_name , "exactly" => $exactly, "main" => $main, "visibled" => $visibled, "wait_count" => $wait_count, "wait_step" => $wait_step, "is_verbose" => $is_verbose );
		return $this->call_boolean(__FUNCTION__,$params,$wait_count*$wait_step*2);
   	}   
	   	function wait_for_window_close_by_text($text,$exactly=true,$main=false,$visibled=false,$wait_count=300,$wait_step=1,$is_verbose=true)
   	{
		$params = array( "text" => $text , "exactly" => $exactly, "main" => $main, "visibled" => $visibled, "wait_count" => $wait_count, "wait_step" => $wait_step, "is_verbose" => $is_verbose );
		return $this->call_boolean(__FUNCTION__,$params,$wait_count*$wait_step*2);
   	}   
	   	function wait_for_window_close_by_class($class_name,$exactly=true,$main=false,$visibled=false,$wait_count=300,$wait_step=1,$is_verbose=true)
   	{
		$params = array( "class_name" => $class_name , "exactly" => $exactly, "main" => $main, "visibled" => $visibled, "wait_count" => $wait_count, "wait_step" => $wait_step, "is_verbose" => $is_verbose );
		return $this->call_boolean(__FUNCTION__,$params,$wait_count*$wait_step*2);
   	}   

};	
?>