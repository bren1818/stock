<?php
	error_reporting(E_ALL);
	include "functions.php";
	
	/*
		Places for data
	-  https://iextrading.com/developer //https://api.iextrading.com/1.0
	
	
	- https://www.alphavantage.co/documentation/ | Key: 49M0C4NYK274FCV6
	
	-http://eoddata.com/stocklist/TSX.htm
	
	*/
	
	$letters = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
	
	//$letters = array("A", "B");
	
	echo '<table><tr><td>Stock</td><td>Name</td><td>High</td><td>Low</td><td>close</td></tr>';
	
	foreach( $letters as $letter){
		//echo "Trying: ".$company;
		//$data = json_decode( doCurl('https://api.iextrading.com/1.0/stock/'.$company.'/company' ) , true );
		$url = "http://eoddata.com/stocklist/TSX/".$letter.".htm";
		
		//echo '<p><strong>'.$url."</strong></p><br />";
		$data = doCurl( $url ); //get the data
		
		$dom = new DOMDocument();
		$res=@$dom->loadHTML($data); //suppress warnings/errors
		$xpath = new DomXPath($dom);
		$class="quotes";
		$divs = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $class ')]");

		foreach($divs as $div) {
			//echo $div->nodeValue;
			
			$tableDom = new DOMDocument();
			$table=@$tableDom->loadHTML( $dom->saveXML($div) );
			
			//$tableData = $dom->saveXML($div);
			$trpath = new DomXPath($tableDom);
			$trs = $trpath->query("//tr");
			foreach($trs as $tr) {
			
				
				$tdDom =  new DOMDocument();
				$td = @$tdDom->loadHTML(  $tableDom->saveXML($tr) );
				$tdpath = new DomXPath($tdDom);
				$tds = $tdpath->query("//td");
				
				
				//want first two
				$c =0;
				echo '<tr>';
				foreach($tds as $td) {
					$c++;
					echo $tdDom->saveXML($td);
					
					if( $c > 4){
						break;
					}
				}
				echo '</tr>';
				
			
			}
			
			
			break; //skip second table
		}
	
	}
	echo '</table>';
?>