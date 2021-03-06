<?php 
$nipErr = $namaErr = $usernameErr = $passwordErr = $emailErr = "";
if(isset($_POST['save'])){
	if(!isset($_POST['nama']) || !isset($_POST['username']) || !isset($_POST['password']) || !$_POST['email']){
		if($_POST['nip'] == ""){
		$nipErr = "NIP tidak boleh kosong!";
		}
		if($_POST['nama'] == ""){
		$namaErr = "Nama tidak boleh kosong!";
		}
		if($_POST['username'] == ""){
			$usernameErr = "Username tidak boleh kosong!";
		}
		if($_POST['password'] == ""){
			$passwordErr = "Password tidak boleh kosong!";
		}
		if($_POST['email'] == ""){
			$emailErr = "Email tidak boleh kosong!";
		}
	}else{
		$nip = $_GET['nip'];
		$nama = $_POST['nama'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];

		$query = "INSERT INTO dosen (nama,username,password,email) VALUES('$nama', '$username', '$password', '$email')";
		$query = "UPDATE dosen SET nama='$nama', username='$username', password='$password', email='$email' WHERE nip=$nip";
		if (mysqli_query($connect, $query)) {
			$_SESSION['flash'] = "<div class=\"alert alert-success\" role=\"alert\">Data berhasil diubah</div>";
			header("location:".$WEB_CONFIG['base_url']."dosen.php");
		}else{
			$_SESSION['flash'] = "<div class=\"alert alert-danger\" role=\"alert\">Data gagal diubah</div>";
			header("location:".$WEB_CONFIG['base_url']."dosen.php");
		}
	}
}

$nip = $_GET['nip'];
$query = "SELECT * FROM dosen WHERE nip = $nip";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);

?>

<a href="<?= $WEB_CONFIG['base_url'] ?>dosen.php" class="btn btn-warning mb-3">
	<svg style="width:20px;height:20px" viewBox="0 0 24 24">
		<path fill="#000000" d="M2,12A10,10 0 0,1 12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12M18,11H10L13.5,7.5L12.08,6.08L6.16,12L12.08,17.92L13.5,16.5L10,13H18V11Z" />
	</svg> Back To Data
</a>
<div class="container">
	<form action="" method="post">
		<div class="form-group">
			<label for="inputNama">NIP</label>
			<input type="text" name="nip" class="form-control-plaintext border-0 shadow-none" id="inputNama" value="<?= $data['nip'] ?>" maxlength="40" required autofocus readonly>
		</div>
		<div class="form-group">
			<label for="inputNama">Nama</label>
			<input type="text" name="nama" class="form-control" id="inputNama" value="<?= $data['nama'] ?>" maxlength="40" required autofocus>
			<small class="text-danger"><?= $namaErr == "" ? "":"* $namaErr " ?></small>
		</div>
		<div class="form-group">
			<label for="inputUsername">Username</label>
			<input type="username" name="username" class="form-control" id="inputUsername" value="<?= $data['username'] ?>" maxlength="30" required>
			<small class="text-danger"><?= $usernameErr == "" ? "":"* $usernameErr" ?></small>
		</div>
		<div class="form-group">
			<label for="inputPassword">Password</label>
			<input type="password" name="password" class="form-control" id="inputPassword" value="<?= $data['password'] ?>" maxlength="30" minlength="3" required>
			<small class="text-danger"><?= $passwordErr == "" ? "":"* $passwordErr" ?></small>
		</div>
		<div class="form-group">
			<label for="inputEmail">Email</label>
			<input type="email" name="email" class="form-control" id="inputEmail" value="<?= $data['email'] ?>" maxlength="50" required>
			<small class="text-danger"><?= $emailErr == "" ? "":"* $emailErr" ?></small>
		</div>
		<input type="submit" class="btn btn-dark m-1" name="save" value="Update Now!">
	</form>
</div>
