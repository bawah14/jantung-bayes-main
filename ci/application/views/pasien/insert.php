
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
                  <h6 class="m-0 font-weight-bold text-primary">Isi <?php echo $title ?></h6>
                </div>
                <div class="card-body">
                    <form action="addHandler" method="post">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="name" class="form-control" id="nama"  placeholder="Enter Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="umur">Umur</label>
                                    <input type="number" name="umur" class="form-control" id="umur" placeholder="(tahun)" required>
                                </div>
                                <div class="form-group">
                                    <label for="kelamin">Gender</label>
                                    <select class="form-control mb-3" id="kelamin" name="kelamin" required>
                                        <option value="" disabled selected>Pilih ... </option>
                                        <option>Laki-laki</option>
                                        <option>Wanita</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" id="alamat"  placeholder="Enter Alamat" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary float-right">Submit</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
<script>
    
</script>