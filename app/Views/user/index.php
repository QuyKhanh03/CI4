<div class="card">
    <div class="card-header row bg-white">
        <div class="col">
            <h3>Tạo mới nhân viên</h3>
        </div>
        <div class="col">
            <a class="btn btn-primary " href="<?php echo base_url('users/create') ?>">Add</a>
        </div>
        <div class="col">
            <a href="<?= base_url('logout') ?>" class="btn btn-primary float-end">Logout</a>
        </div>
    </div>


    <div class="row mt-2">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="text-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col">
            <h5 class="p-3">
                Tìm kiếm nhân viên bằng tên. Nếu không có điều kiện thì hiện toàn bộ.
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <form method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search" placeholder="Nhập từ khóa tìm kiếm">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>

    </div>


    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Tel</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <?php
        if (count($users) > 0) {
        ?>
            <tbody>
                <?php
                foreach ($users as $user) :
                ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <?php $formattedPhoneNumber = substr_replace($user['tel'], '-', 4, 0)  ?>
                        <td><?= substr_replace($formattedPhoneNumber, "-", 9, 0) ?></td>
                        <td>
                            <a href="<?= base_url('/users/edit/' . $user['id'])  ?>" class="btn btn-success  ">Sửa</a>
                            <a onclick="return askDelete('<?php echo $user['name'] ?>')" href="<?= base_url('/users/delete/' . $user['id'])  ?>" class="btn btn-danger">Xóa</a>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        <?php
        } else {
            echo '<h3 class="text-center">Không có dữ liệu</h3>';
        }
        ?>
    </table>
    <div class="row">
        
        <div class="col">
            <nav aria-label="Page navigation example ">
                <ul class="pagination">
                    <?php if (count($users) > 0) : ?>
                        <?php if ($current_page > 1) : ?>
                            <li class="page-item"><a class="page-link" aria-label="Previous" href="<?php echo base_url('users?page=' . ($current_page - 3)) ?>"><span aria-hidden="true">&laquo;</span></a></li>
                        <?php endif; ?>
                        <?php for ($i = $start; $i < $end; $i++) : ?>
                            <?php if($end > $total_page): ?>
                                <?php $end = $total_page+1; ?>
                                <?php endif; ?>
                                <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>"><a class="page-link" href="<?php echo base_url('users?page=' . $i) ?>"><?php echo $i ?></a></li>
                        <?php endfor; ?>
                        <?php if ($current_page < $total_page-1) : ?>
                            <li class="page-item"><a class="page-link" href="<?php echo base_url('users?page=' . ($current_page + 3)) ?>"><span aria-hidden="true">&raquo;</span></a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
        <div class="col">
        </div>
    </div>
</div>
<script>
    function askDelete(name) {
        if (confirm("Bạn có chắc chắn muốn xóa nhân viên " + name + " không ?")) {
            return true;
        }
        return false;
    }
</script>