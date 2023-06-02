<div class="card">
    <div class="card-header row bg-white">
        <div class="col">
            <h3>Biên soạn thông tin nhân viên</h3>
        </div>
        <div class="col">
            <a href="<?= base_url('logout') ?>" class="btn btn-primary float-end">Logout</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- alert -->
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
        <form action="<?php echo base_url('/users/update/' . $user['id']) ?>" method="post">

            <div class="col-6">
                <div class="mb-3">
                    <table>
                        <tr>
                            <td><label for="" class="form-label">ID</label> </td>
                            <td>
                                <input type="hidden" value="<?= $user['id'] ?>" name="id">
                                <input disabled type="text" value="<?php echo $user['id'] ?> (View only here)" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="" class="form-label">Tên</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $user['name'] ?>" class="form-control" name="name">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="" class="form-label">Tel</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $user['tel'] ?>" class="form-control" name="tel">
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <label for="" class="form-label">Email</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $user['email'] ?>" class="form-control" name="email">
                            </td>
                        </tr>
                    
                    </table>
                </div>
                
            </div>
    </div>

    <div class="row">
        <div class="col px-4 mb-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a onclick="return askDelete('<?php echo $user['name'] ?>')" href="<?= base_url('/users/delete/' . $user['id'])  ?>" class="btn btn-danger">Delete</a>
            <a onclick="history.back()" class="btn btn-success">Back</a>
        </div>
        <div class="col">
        </div>
    </div>
    </form>
</div>

<script>
    function askDelete(name) {
        if (confirm("Bạn có chắc chắn muốn xóa nhân viên " + name + " không ?")) {
            return true;
        }
        return false;
    }
</script>
</div>