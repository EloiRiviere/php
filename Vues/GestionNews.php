<!Doctype HTML>
<html>
    <h1>Ajouter une News</h1>
    <body>
        <form method="post" action="../index.php?action=ajouter">
            Titre (Primary Key) : <input type="text" name="titre"/><br>
            Catégorie : <input type="text" name="categ"/><br>
            Date : <input type="text" name="date"/><br>
            Description : <input type="text" name="desc"/><br>
            Lien : <input type="text" name="lien"/><br>
            <input type="button" value="Retour" onclick="history.go(-1)">
            <input type="submit" name="Valider" value="Valider"/>
        </form>
    </body>

    <h1>Supprimer une News</h1>
    <body>
    <form method="post" action="../index.php?action=supprimer">
        Titre (Primary Key) : <input type="text" name="titre"/><br>
        <input type="button" value="Retour" onclick="history.go(-1)">
        <input type="submit" name="Valider" value="Valider"/>
    </form>
    </body>

</html>




