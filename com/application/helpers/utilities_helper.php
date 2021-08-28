<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
	get_date_in_format
	get_date_details
	get_key_from_multi_array
	base_encode
	base_decode
	get_peak_memory_usage
	generate_random_numbers
	is_string_empty
	generateRandomString
	generate_random_numbers_array
	multi_array_sort
	standardize_size_format
	DEBUGGER_LOG

*/
if ( ! function_exists('test_method'))
{
    function test_method($var = '')
    {
        return $var;
    }
}


if ( ! function_exists('get_date_in_format'))
{
	function get_date_in_format($date_string, $format){
	  	$date_string = str_replace(",", "", $date_string);
		$str_to_time_val = strtotime($date_string);
		$formatted_date = date($format, $str_to_time_val);
		return $formatted_date;
	 }
}


if ( ! function_exists('get_date_details'))
{
	function get_date_details($input_date){
		$date = new \DateTime($input_date);

		$date_attributes = array("date"=>"", "day"=>"", "monthly_occurence"=>0, "day_of_month"=>0, "month"=>"");

		$occurence_adjective = array("", "first", "second", "third", "fourth", "fifth");
		$date_attributes["date"] = $date->format("Y-m-d");
		$date_attributes["day"] = $date->format("l");
		$date_attributes["month"] = $date->format("F");

		$day_month = (int)$date->format('d');
		$date_attributes["day_of_month"] = $day_month;

		$occurence = ceil($day_month/7);
		$date_attributes["monthly_occurence"] = $occurence_adjective[$occurence];
		echo $occurence."<br>";

		/*switch (true) {
			case ($day_month >0 && $day_month <=7):
				$date_attributes["monthly_occurence"] = "first";
				break;

			case ($day_month >7 && $day_month <=14):
				$date_attributes["monthly_occurence"] = "second";
				break;

			case ($day_month >14 && $day_month <=21):
				$date_attributes["monthly_occurence"] = "third";
				break;

			case ($day_month >21 && $day_month <=28):
				$date_attributes["monthly_occurence"] = "fourth";
				break;

			case ($day_month >28):
				$date_attributes["monthly_occurence"] = "fifth";
				break;

			default:
				# code...
				break;
		}*/

		return $date_attributes;
	}
}


if ( ! function_exists('get_key_from_multi_array'))
{
	function get_key_from_multi_array($multi_array, $search_field, $match_value)
	{
	   foreach($multi_array as $key => $single_array)
	   {
	      if ( $single_array[$search_field] == $match_value )
	         return $key;
	   }
	   return false;
	}
}

if ( ! function_exists('base_encode'))
{
	function base_encode($data){
		return rtrim(strtr(base64_encode($data), '+/','-_'),'=');
	}
}


if ( ! function_exists('base_decode'))
{
	function base_decode($data){
		return base64_decode(strtr($data, '-_', '+/'));
	}
}

if ( ! function_exists('get_peak_memory_usage'))
{
	function get_peak_memory_usage(){
		return ((memory_get_usage()/1024)/1024);
	}
}


if ( ! function_exists('generate_random_numbers'))
{
	function get_random_number($min, $max){
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if( ! function_exists('is_string_empty'))
{
	function is_string_empty($str){
		return (strlen(trim($str)) == 0) ? TRUE : FALSE;
	}
}

if( ! function_exists('generateRandomString'))
{
	function generateRandomString($length = 15) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}

if( ! function_exists('generate_random_numbers'))
{
    function generate_random_numbers($length = 8){
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if( ! function_exists('generate_random_numbers_array'))
{
    function generate_random_numbers_array($min, $max, $limit){
        $random_number_array = range($min, $max);
		shuffle($random_number_array );
		$random_number_array = array_slice($random_number_array , 0, $limit);
        return $random_number_array;
    }
}

if( ! function_exists('multi_array_sort'))
{
	function multi_array_sort($array, $on, $order=SORT_ASC){

	    $new_array = array();
	    $sortable_array = array();

	    if (count($array) > 0) {
	        foreach ($array as $k => $v) {
	            if (is_array($v)) {
	                foreach ($v as $k2 => $v2) {
	                    if ($k2 == $on) {
	                        $sortable_array[$k] = $v2;
	                    }
	                }
	            } else {
	                $sortable_array[$k] = $v;
	            }
	        }

	        switch ($order) {
	            case SORT_ASC:
	                asort($sortable_array);
	                break;
	            case SORT_DESC:
	                arsort($sortable_array);
	                break;
	        }

	        foreach ($sortable_array as $k => $v) {
	            $new_array[$k] = $array[$k];
	        }
	    }

	    return $new_array;
	}

}

if( ! function_exists('standardize_size_format'))
{

	function standardize_size_format($bytes)
	{
	    if ($bytes >= 1073741824)
	    {
	        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
	    }
	    elseif ($bytes >= 1048576)
	    {
	        $bytes = number_format($bytes / 1048576, 2) . ' MB';
	    }
	    elseif ($bytes >= 1024)
	    {
	        $bytes = number_format($bytes / 1024, 2) . ' KB';
	    }
	    elseif ($bytes > 1)
	    {
	        $bytes = $bytes . ' bytes';
	    }
	    elseif ($bytes == 1)
	    {
	        $bytes = $bytes . ' byte';
	    }
	    else
	    {
	        $bytes = '0 bytes';
	    }

	    return $bytes;
	}
}

if( ! function_exists('DEBUGGER_LOG'))
{
    function DEBUGGER_LOG($label, $variable, $show_var_dump=false){
    	if(DEBUGGER_ON){
    		echo "\n<pre style=\"border:1px solid #ccc;padding:10px;" .
			       "margin:10px;font:14px courier;background:whitesmoke;" .
			       "white-space: pre-wrap; white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: -o-pre-wrap;  word-wrap: break-word;".
			       "display:block;border-radius:4px;\">\n";

			echo "<b>".$label."</b><br>";

			$var_type = gettype($variable);
    		if(!$show_var_dump){
    			if($var_type == 'array' || $var_type == 'object'){
    				echo json_encode($variable);
    			}else{
    				echo $variable;
    			}
    		}else{
    			var_dump($variable);

    		}

			echo "</pre>\n";
    	}
    }
}

//$newDate = date("d-m-Y", strtotime($originalDate));
