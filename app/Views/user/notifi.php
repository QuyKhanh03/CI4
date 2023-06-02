<div class="card">
    <div class="card-header row bg-white">
        <div class="col">
            <a href="<?= base_url('logout') ?>" class="btn btn-primary float-end">Logout</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="text-success text-center">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">


            <div class="col p-5 text-center">
                <a href="<?= base_url('/users') ?>" class="btn btn-primary">OK</a>

            </div>
        </div>
    </div>

</div>