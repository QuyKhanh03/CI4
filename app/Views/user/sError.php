<div class="row">

<?php 
    if (isset($errors)) {
        echo '<div class="alert alert-danger" role="alert">';
        echo '<ul>';
        foreach ($errors as $error) {
            echo '<li>'.$error.'</li>';
        }
        echo '</ul>';
        echo '</div>';
    }

?>


</div>
<div class="row">
    <div class="col p-5">
        <a href="<?= base_url('users') ?>">OK</a>
    </div>
</div>