<div class="card">
    <div class="card-header row bg-white">
        <div class="col">
            <h3>Xác nhận thông tin</h3>
        </div>
        <div class="col">
            <a href="<?= base_url('logout') ?>" class="btn btn-primary float-end">Logout</a>
        </div>
    </div>
    <div class="card-body">
    <div class="row">
            <div class="col">
                <h4>Ấn nút Delete để xóa thông tin từ DB.</h4>
            </div>
        </div>
        <table class="table table-hover table-bordered">
            <tr>
                <td>ID</td>
                <td>
                    <?php echo $data['id'] ?>
                </td>
            </tr>
            <tr>
                <td>Tên</td>
                <td>
                    <?php echo $data['name'] ?>
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <?php echo $data['email'] ?>
                </td>
            </tr>
            <tr>
                <td>Tel</td>
                <td>
                    <?php echo $data['tel'] ?>
                </td>
            </tr>
        </table>
        <div class="row ">
            <div class="col d-flex justify-content-center ">
                <a href="<?= base_url('/users/remove/' . $data['id']) ?>" class="btn btn-primary">Delete</a>
                &nbsp; &nbsp;
                <a onclick="history.back()" class="btn btn-success">Back</a>
            </div>
            
        </div>
    </div>

</div>