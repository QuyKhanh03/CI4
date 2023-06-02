<div class="card">
<div class="card-header row bg-white">
        <div class="col">
        <h3>Xác nhận thông tin.Ấn OK để ghi vào DB</h3>
        </div>
        <div class="col">
            <a href="<?= base_url('logout') ?>" class="btn btn-primary float-end">Logout</a>
        </div>
    </div>
<div class="card-body">
    
    <table class="table table-hover">
        
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
            <?php $formattedPhoneNumber = substr_replace($data['tel'], '-', 4, 0)  ?>
            <?php echo substr_replace($formattedPhoneNumber, "-", 9, 0) ?>
            </td>
        </tr>
    </table>
    <div class="row">
        <div class="col">
            <form action="<?= base_url('/users/confirmAdd') ?>" method="post">
                <input type="hidden" name="name" value="<?= $data['name'] ?>">
                <input type="hidden" name="email" value="<?= $data['email'] ?>">
                <input type="hidden" name="tel" value="<?= $data['tel'] ?>">
                <button class="btn btn-primary">OK</button>
            </form>
        </div>
        <div class="col">
            <a onclick="history.back()" class="btn btn-success">Quay lại</a>
        </div>
        <div class="col"></div>
    </div>
</div>

</div>