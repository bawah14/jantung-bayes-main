
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>
    
    <?php //print_r($gejala) ?>
    <div class="row">
        <div class="col-lg-12">
        <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Master <?php echo $title ?></h6>
                </div>
                
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Action</th>
                        <th>Nama</th>
                        <th>Gender</th>
                        <th>Umur</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Email</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Action</th>
                        <th>Nama</th>
                        <th>Gender</th>
                        <th>Umur</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Email</th>
                      </tr>
                    </tfoot>
                    <tbody>
                        <?php $no=0; foreach ($_data as $key => $value) { $no++ ?>
                            <tr class="rowtb" data-value="<?php echo $no ?>">
                                <td>#</td>
                                <td><?php echo($value['nama'])?></td>
                                <td><?php echo($value['kelamin'])?></td>
                                <td><?php echo($value['umur'])?></td>
                                <td><?php echo($value['tanggal'])?></td>
                                <td><?php echo($value['alamat'])?></td>
                                <td><?php echo($value['email'])?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
<script>
    
</script>