<div class="card">
    <div class="card-header row bg-white">
        <div class="col">
            <h3>Đăng ký nhân viên mới</h3>
        </div>
        <div class="col">
            <a href="<?= base_url('logout') ?>" class="btn btn-primary float-end">Logout</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <?php if (session()->getFlashdata('errors')) : ?>
                <div class="text-danger" role="alert">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
        <form action="<?php echo base_url('/users/store') ?>" method="post">
            <div class="col-8">
                <table>
                    <tr>
                        <td>
                            <label for="" class="form-label">Tên</label>
                        </td>
                        <td>
                            <input value="<?= isset($name) ? $name : '' ?>" type="text" class="form-control" name="name">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="" class="form-label">Email</label>

                        </td>
                        <td>
                            <input value="<?= isset($email) ? $email : '' ?>" type="text" class="form-control" name="email">

                        </td>

                    </tr>
                    <tr>
                        <td>
                            <label for="" class="form-label">Tel</label>

                        </td>
                        <td>
                            <input value="<?= isset($tel) ? $tel : '' ?>" type="text" class="form-control" name="tel">

                        </td>
                    </tr>
                </table>

                

            <div class="row">
                <div class="col px-4 mt-3">
                    <button class="btn btn-primary">Register</button>
                    <a onclick="history.back()" class="btn btn-success">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>