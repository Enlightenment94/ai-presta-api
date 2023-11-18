<?php

function conn(){
	$dbHost = "127.0.0.1";
	$dbUser = "russ_ps";
	$dbPass = "sbi0wIkCP+Omte7B";
	$dbName = "russ_ps";
	$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

	if ($conn->connect_error) {
	    exit('Błąd połączenia z bazą danych: ' . $conn->connect_error);
	}
	return $conn;
}

function selectByLangWithoutEmptyOnlyActiveCategory($column){
	$conn = conn();
	$sql = "SELECT * FROM ps_category_lang t1, ps_category t2 WHERE t1.id_category = t2.id_category AND t1." . $column . " = '' AND t1.id_lang = 1 AND t1.name != 'root' AND t1.name != 'home' AND t2.active = 1";
	$result = $conn->query($sql);

	$arr = array();
	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	    	array_push($arr, $row);
	    }
	} else {
	    echo 'Brak wyników.';
	}
	$conn->close();
	return $arr;
}

function selectByLangOnlyActiveCategory($idLang){
	$conn = conn();
	$sql = "SELECT * FROM ps_category_lang t1, ps_category t2 WHERE t1.id_category = t2.id_category AND t1.id_lang = '" . $idLang . "' AND t1.name != 'root' AND t1.name != 'home' AND t2.active = 1";

	$result = $conn->query($sql);

	$arr = array();
	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	    	array_push($arr, $row);
	    }
	} else {
	    echo 'Brak wyników.';
	}
	$conn->close();
	return $arr;
}

function updateRewrite($columnName, $tableName, $set,  $id_category, $id_lang){
	$conn = conn();
	$sql = "UPDATE " . $tableName . " SET `" . $columnName . "` = '" . $conn->real_escape_string($set) . "' WHERE id_category='" . $id_category. "' AND id_lang='" . $id_lang . "'";
	
	$result = $conn->query($sql);
	if($result){
		return "Success";
	}
	$conn->close();
	return "err";
}

function updateEmpty($columnName, $tableName, $set, $column_key, $id_column, $id_lang){
	$conn = conn();

	$sql = "UPDATE `" . $tableName . "` SET `" . $columnName . "` = '" . $conn->real_escape_string($set) . "' WHERE ". $column_key. " = '" . $id_column. "' AND id_lang = '" . $id_lang . "' AND (`" . $columnName . "` = \"\" OR " . $columnName . " IS NULL )";

	echo $sql;
	
	$result = $conn->query($sql);
	if($result){
		//echo "result: " . $result . "</br>";
		$conn->close();
		return "Success";
	}
	$conn->close();
	return "err";
}

function selectByIdByLang($tableName, $columnId, $idValue, $idLang){
	$conn = conn();
	$sql = 'SELECT * FROM ' . $tableName . '' . " WHERE " . $columnId  . " = '" . $idValue . "' AND id_lang='" . $idLang . "'";
	//echo $sql . "</br>";
	$result = $conn->query($sql);

	$arr = array();
	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	    	array_push($arr, $row);
	    }
	} else {
	    echo 'Brak wyników.';
	}
	$conn->close();
	return $arr;
}

function selectChildCategoryByParentIdActiveLang($id_parent, $id_lang){
	$conn = conn();
	$sql = "SELECT * FROM ps_category_lang cl , ps_category c  WHERE cl.id_category  = c.id_category AND cl.id_lang = " . $id_lang . " AND c.active = 1 AND id_parent ='" . $id_parent ."'";
	$result = $conn->query($sql);

	$arr = array();
	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	    	array_push($arr, $row);
	    }
	} else {
	    echo 'Brak wyników.';
	}
	$conn->close();
	return $arr;
}







function select($tableName){
	$conn = conn();
	$sql = 'SELECT * FROM ' . $tableName . '';
	$result = $conn->query($sql);

	$arr = array();
	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	    	array_push($arr, $row);
	    }
	} else {
	    echo 'Brak wyników.';
	}
	$conn->close();
	return $arr;
}

function selectByLangAng($tableName){
	$conn = conn();
	$sql = 'SELECT * FROM ' . $tableName . " WHERE id_lang=1 and name!='root' and name !='home'";
	$result = $conn->query($sql);

	$arr = array();
	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	    	array_push($arr, $row);
	    }
	} else {
	    echo 'Brak wyników.';
	}
	$conn->close();
	return $arr;
}

function selectJoinIdLang($tableName1, $tableName2){
	$conn = conn();
	$sql = 'SELECT * FROM ' . $tableName1 . ' t1 , ' . $tableName2 . ' t2 WHERE t1.id_lang = t2.id_lang';
	$result = $conn->query($sql);

	$arr = array();
	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	    	array_push($arr, $row);
	    }
	} else {
	    echo 'Brak wyników.';
	}
	$conn->close();
	return $arr;
}
