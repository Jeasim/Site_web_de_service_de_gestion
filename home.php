<?php
require_once("action/HomeAction.php");
$action = new HomeAction();
$action->execute();
 
require_once("partial/header.php");
?>


<?php 
if($_SESSION["partner_id"] === 0){
?>

    <h2>Ajouter un partenaire</h2>

    <form action="home.php" method="GET">
        <div>
            <div>Nom d'usager de votre partenaire</div>
            <input type="text" name="partner-username-search">
        </div>
        <button type="submit">Chercher</button>

    </form>

    <div><?= $action->message ?></div>
<?php
}
else{
?>

    <a href="?forgetPartner=true">Oubliez votre partenaire</a>

<?php
}
?>


<?php
require_once("partial/footer.php");