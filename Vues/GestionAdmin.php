<!Doctype HTML>
<html>
    <h1>Ajouter un nouvel Admin</h1>
    <body>
    <form method="post" action="../index.php?action=addAdmin">
        Login : <input type="text" name="login"/><br>
        Password : <input type="password" name="password"/><br>
        Mail : <input type="text" name="mail"/><br>
        <input type="button" value="Retour" onclick="history.go(-1)">
        <input type="submit" name="Valider" value="Valider"/>
    </form>
    </body>

    <h1>Modifier le mot de passe d'un admin</h1>
    <body>
        <form method="post" action="../index.php?action=updateMDP">
            Login : <input type="text" name="login"/><br>
            Ancien MDP : <input type="password" name="oldPassword"/><br>
            Nouveau MDP : <input type="password" name="newPassword"/><br>
            <input type="button" value="Retour" onclick="history.go(-1)">
            <input type="submit" name="Valider" value="Valider"/>
        </form>
    </body>

</html>




