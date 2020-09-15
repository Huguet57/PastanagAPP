<h1>Crea nova taula</h1>
<form action="createtable.php" method="GET">
	<label>Crear taula: <input type="text" name="dbname" placeholder="Nom de la base de dades" /></label>
	<input type="submit" />
</form>

<h1>Inserta valors</h1>
<form action="insert.php" method="POST" enctype="multipart/form-data">
	<label>Insert CSV: <input type="file" name="csvname" /></label>
	<input type="text" name="dbname" placeholder="Nom de la base de dades" value="<?=isset($_GET['dbname']) ? $_GET['dbname'] : ''?>" />
	<input type="submit" />
</form>
