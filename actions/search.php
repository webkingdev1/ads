<?php
	$departmant = $_POST["city"];
	var_dump($departmant);
	$salary 	= $_POST["types"];
	$limits 	= $_POST["limits"];
		
	if (isset($_POST["from_val"], $_POST["to_val"], $departmant, $salary))
	{
		$connect = mysqli_connect("mysql4.gear.host", "testz10", "", "testz10");
		$output = '';
			if ($departmant == "---"){
		$query = "SELECT * FROM z10_employment AS em
				JOIN z10_position AS p ON p.id = em.id_position
                JOIN z10_departmant AS d ON d.id = em.id_departmant
                JOIN z10_salary AS s ON s.id = em.id_salary
                WHERE id_salary = '".$salary."' AND sum_salary BETWEEN '".$_POST["from_val"]."' AND '".$_POST["to_val"]."' LIMIT 0,".$limits." ";	
			}

			if (($salary == '1')||($salary == '2')){
		$query = "SELECT * FROM z10_employment AS em
				JOIN z10_position AS p ON p.id = em.id_position
                JOIN z10_departmant AS d ON d.id = em.id_departmant
                JOIN z10_salary AS s ON s.id = em.id_salary
                WHERE id_departmant = (SELECT id FROM z10_departmant WHERE departmant = '".$departmant."') AND id_salary = '".$salary."' AND sum_salary BETWEEN '".$_POST["from_val"]."' AND '".$_POST["to_val"]."' LIMIT 0,".$limits." ";
			}
			if (($salary == '3')&&($departmant != "---")){
		$query = "SELECT * FROM z10_employment AS em
				JOIN z10_position AS p ON p.id = em.id_position
                JOIN z10_departmant AS d ON d.id = em.id_departmant
                JOIN z10_salary AS s ON s.id = em.id_salary
				WHERE id_departmant = (SELECT id FROM z10_departmant WHERE departmant = '".$departmant."') AND sum_salary BETWEEN '".$_POST["from_val"]."' AND '".$_POST["to_val"]."' LIMIT 0,".$limits." ";
			}
			if (($salary == '3')&&($departmant == "---")){
		$query = "SELECT * FROM z10_employment AS em
				JOIN z10_position AS p ON p.id = em.id_position
                JOIN z10_departmant AS d ON d.id = em.id_departmant
                JOIN z10_salary AS s ON s.id = em.id_salary
				WHERE sum_salary BETWEEN '".$_POST["from_val"]."' AND '".$_POST["to_val"]."' LIMIT 0,".$limits." ";
			}
			if (($salary != '3')&&($departmant == "---")){
		$query = "SELECT * FROM z10_employment AS em
				JOIN z10_position AS p ON p.id = em.id_position
                JOIN z10_departmant AS d ON d.id = em.id_departmant
                JOIN z10_salary AS s ON s.id = em.id_salary
				WHERE id_salary = '".$salary."' AND sum_salary BETWEEN '".$_POST["from_val"]."' AND '".$_POST["to_val"]."' LIMIT 0,".$limits." ";
			}
		$result = mysqli_query($connect, $query);
		
		?>
			<table class="table table-bordered">
                    <tr>
                        <th width="20%">Ф.И.О.</th>
                        <th width="10%">Дата рождения</th>
                        <th width="15%">Должность</th>
                        <th width="20%">Отдел</th>
                        <th width="15%">Зарплата</th>
                        <th width="10%">Сумма</th>
                    </tr>
                  	<?php
                        while($row = mysqli_fetch_array($result))
                        {
                    ?>
                    <tr>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["date"]; ?></td>
                        <td><?php echo $row["position"]; ?></td>
                        <td><?php echo $row["departmant"]; ?></td>
                        <td><?php echo $row["salary"]; ?></td>
                        <td>$<?php echo $row["sum_salary"]; ?></td>
                    </tr>
                    <?php
                        }
                    ?>
            </table>
                    <?
	}

	else{
		$output.='
		<tr>
			<td colspan="5">Problemo</td>
		</tr>
		';
	}
	$output.='</table>';
	
	echo $output;
?>