
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
                  <h6 class="m-0 font-weight-bold text-primary"><?php echo "Hasil Diagnosa" ?></h6>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#prosesModal">
                        Lihat Perhitungan 
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary">Pasien</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <img src="<?php echo $foto ?>" class="img-profile rounded-circle" style="width: 100%;" alt="">
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" name="email" class="form-control" value="<?php echo $pasien['nama'] ?>" >
                                            </div>
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <input type="text" name="email" class="form-control" value="<?php echo $pasien['kelamin'] ?>" >
                                            </div>
                                            <div class="form-group">
                                                <label>Umur</label>
                                                <input type="text" name="email" class="form-control" value="<?php echo $pasien['umur'] ?>" >
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <input type="text" name="email" class="form-control" value="<?php echo $pasien['alamat'] ?>" >
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" name="email" class="form-control" value="<?php echo $pasien['email'] ?>" >
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Diagnosa</label>
                                                <input type="text" name="email" class="form-control" value="<?php echo $pasien['tanggal'] ?>" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="m-0 font-weight-bold text-primary">Diagnosa Gejala</h6>
                                            
                                        </div>
                                        <div class="card-body">
                                            <ul>
                                                <?php foreach ($gejala as $row) { ?>
                                                    <li> <?php echo $row['namagejala'] ?></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="m-0 font-weight-bold text-primary">Rekomendasi</h6>
                                            
                                        </div>
                                        <div class="card-body">
                                        <?php echo $diagnosa ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="prosesModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Perhitungan Diagnosa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="" style="overflow:scroll; height:400px;">
            <?php echo $result ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
    
</script>