<?php
    function oneStackBack(){
        $stackstring = $_SESSION['stack'];
        $stackarray = explode("/",$stackstring);

        if(strpos($stackarray[count($stackarray) - 2], 'validate') !== false){
            if(strpos($stackarray[count($stackarray) - 4], 'validate') !== false){
                var_dump($stackarray[count($stackarray) - 5]);
                header('Location: '.$stackarray[count($stackarray) - 5].'');
            }
            else{
                var_dump($stackarray[count($stackarray) - 3]);
                header('Location: '.$stackarray[count($stackarray) - 3].'');
            }
        }
        else{
            header('Location: '.$stackarray[count($stackarray) - 2].'');
            var_dump($stackarray[count($stackarray) - 3]);
        }
    }

    function setStack($target){
        $stackstring = $_SESSION['stack'];
		$stackarray = explode("/",$stackstring);
		$finalstringbefore = $stackarray[count($stackarray) - 2];

		$targetarray = explode(".",$target);
		$targetstring = $targetarray[count($targetarray) - 2];
		$targetarray2 = explode("/",$targetstring);
		$finalstring = $targetarray2[count($targetarray2) - 1];

		if($finalstringbefore != NULL){
			if(in_array($finalstring, $stackarray)){
				if($finalstringbefore != $finalstring){
					$number = array_search($finalstring, $stackarray);
					$i = 0;
					$finalstackarray = array();
					foreach($stackarray as $value){
						if($i <= $number){
							if(strpos($stackarray[count($stackarray) - 2], 'validate') !== false){
                                if(strpos($stackarray[count($stackarray) - 4], 'validate') !== false){
                                    if($i == count($stackarray) - 5){
                                        $finalstackarray[$i] = ''.$value.'/';
                                    }
                                    else{
                                        $finalstackarray[$i] = $value;
                                    }
                                }
                                else{
                                    if($i == count($stackarray) - 4){
                                        $finalstackarray[$i] = ''.$value.'/';
                                    }
                                    else{
                                        $finalstackarray[$i] = $value;
                                    }
                                }
							}
							else{
								if($i == count($stackarray) - 3){
									$finalstackarray[$i] = ''.$value.'/';
								}
								else{
									$finalstackarray[$i] = $value;
								}
							}
							$i++;
						}
					}
					$finalstring = implode("/", $finalstackarray);
					$_SESSION['stack'] = $finalstring;
				}
			}
			else{
				$_SESSION['stack'] .= $finalstring.'/';
			}
		}
		else{
			$_SESSION['stack'] .= $finalstring.'/';
		}
	}
?>