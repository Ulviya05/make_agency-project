<?php


$data['succes']=false;
				$data['error']='Login or password incorrect';
				
				if(-1>0){
					$data['succes'] = true;

				}
				print json_encode($data);

?>






