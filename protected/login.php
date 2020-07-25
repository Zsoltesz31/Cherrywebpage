<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
  $postData = [
    'fnev' => $_POST['fnev'],
    'jelszo' => $_POST['jelszo']
  ];

  if(empty($postData['fnev']) || empty($postData['jelszo'])) {
    echo "Hiányzó adat(ok)!";
  } 
   else if(!UserLogin($postData['fnev'], $postData['jelszo'])) {
    echo "Hibás felhasználónév vagy jelszó!";
    
  }

  $postData['jelszo'] = "";
}
?>
<div class="container">
    <div class="menu" style="margin-top:40px" >
    <form method="POST">
        <h1>Bejelentkezés</h1>
    <div class="form-group">
        <label for="formGroupExampleInput" class="font" >Felhasználónév</label>
        <input type="text" class="form-control" id="fnev" name="fnev"  >
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput" class="font">Jelszó</label>
        <input type="password" class="form-control" id="jelszo" name="jelszo">
    </div>
    <div style="display:flex; align-items:center; justify-content:center">
        <button name="login" type='submit'>Bejelentkezés</button>
        </div>
    </div>
    </form>
</div>
