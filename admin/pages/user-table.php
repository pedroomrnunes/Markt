<?php 

$id_user = 67;
function showUsersTable(){
    $users = User::getUsers();
   $total = count($users);
//	echo "Total: ".$total;  // echo  "<br> Total de comissões ganhas: ".$comissionsTotal."€";
	
	
	
	
	echo '<table width="100%" class="table table-striped table-bordered table-hover" id="table-tours">';
    echo  "<thead>
            <tr>            
			<th class='text-center'>#</th>            
			<th class='text-center'>Nome </th> 
			<th class='text-center'>Email</th>			
			<th class='text-center'>Saldo</th>			
			<th class='text-center'>Facebook</th>
			<th class='text-center'>Google</th>
			<th class='text-center'>Anuncios</th>
			<th class='text-center'>Compras</th>			
			<th class='text-center'>Vendas</th>			
			<th class='text-center'>Data de registo</th>			
			</tr>
          </thead>";
    echo "<tbody>";
	
	$count = 0;
    while($count!=$total){		
	   
	   $fb = FbAccount::getFbAccountByUserId($users[$count]['id']);
	   if($fb!=null) $facebookid = $fb['id'];  else  $facebookid =0;
	 $google = GoogleAccount::getgAccountByUserId($users[$count]['id']);
		if($google!=null )   $googleid = $google['id'];   else   $googleid = 0; 
	  	
		list($date, $time) = explode(' ', $users[$count]['timecreated']);
		list($hour, $min, $sec) = explode(':', $time);
		
		$id = $count+1;
	echo "Id: ".$users[$count]['id'];	
		
		
		echo '<tr class="odd gradeX" data-id=1 data-toggle="modal" data-target="#modalTransactions" type="submit">';										
		echo "<td class='text-center'>".$users[$count]['id']."</td>"; 			
        echo "<td class='text-center'>".$users[$count]['name']."</td>";			
		echo "<td class='text-center'>".$users[$count]['email']."</td>";			
		echo "<td class='text-center'>".$users[$count]['balance']."</td>";			
		echo "<td class='text-center'><a href='user-fb.php?q=".$facebookid."'>".$facebookid."</a></td>";		
		echo "<td class='text-center'><a href='user-g.php?q=".$googleid."'>".$googleid."</a></td>";
		echo "<td class='text-center'><a href='annoucements.php'>Anuncios</a></td>";			
		echo "<td class='text-center'><a href='user-buys.php'>Compras</a></td>";
		echo "<td class='text-center'><a href='user-sells.php'>Vendas</a></td>";
		echo "<td class='text-center'>".$date."  às ".$hour.":".$min."</td>" ; 		 		 
		echo  "</tr>";
	   
	   $count++;
	}
	echo "</tbody>";	
	echo "</table>";

   return $total;	
}




?>