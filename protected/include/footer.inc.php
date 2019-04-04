<div id="popup_confirmation_deconnexion" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <p>Voulez-vous vraiment vous déconnecter?</p>
            <button class="btn" type="button" data-dismiss="modal">Non</button>
            <a href="index.php?page=1&logout" class="btn btn-danger">Se
                déconnecter</a>
        </div>
    </div>
</div>

<div id="popup_confirmation_fermeture" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <p>Voulez-vous vraiment quitter cette page?</p><br>
            <p>Toutes les informations non sauvegardées seront perdues.</p>
            <button class="btn" type="button" data-dismiss="modal">Non</button>
            <a href="index.php?page=<?php echo retour(); ?>"
               class="btn btn-danger">Retour</a>
        </div>
    </div>
</div>

</div>

<script>
    $(document).ready(function () {
        $("#contenu").fadeIn(700).removeClass('hidden');
    });
</script>

</body>

</html>