<?php

namespace Xhe;

class XheTableCompatible extends XheBaseDOMVisual {
			function get_count_within_iframe_by_number($number)
	{
		return $this->get_count($number);
	}
                function get_atribute_by_name($name,$name_attr)
        {
               return $this->get_attribute_by_name($name,$name_attr);
        }
                function get_atribute_by_number($number,$name_attr)
        {
               return $this->get_attribute_by_number($number,$name_attr);
        }
                function get_atribute_by_attribute($attr_name,$attr_value,$exactly,$name_attr)
        {
               return $this->get_attribute_by_attribute($attr_name,$attr_value,$exactly,$name_attr);
        }
                function get_atribute_by_attribute_in_frame_by_number($attr_name,$attr_value,$exactly,$name_attr,$frame_number)
        {
		return $this->get_attribute_by_attribute_in_frame_by_number($attr_name,$attr_value,$exactly,$name_attr,$frame_number);
        }
	        	function get_inner_html($number,$frame=-1)
	{
		return $this->get_inner_html_by_number($number,$frame);
	}
		function get_cell_count_by_number($number,$frame=-1)
	{
		return $this->get_cells_by_number($number,$frame);
	}
	};		
?>