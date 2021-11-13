
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
                  <h6 class="m-0 font-weight-bold text-primary">Gejala</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>Action</th>
                        <th>Kode</th>
                        <th>Gejala</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Action</th>
                        <th>Kode</th>
                        <th>Gejala</th>
                      </tr>
                    </tfoot>
                    <tbody>
                        <?php $no=0; foreach ($gejala as $key => $value) { $no++ ?>
                            <tr class="rowtb" data-value="<?php echo $no ?>">
                                <td>
                                    <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="gejala[]" id="gejala<?php echo $no ?>">
                                    <label class="custom-control-label" for="gejala<?php echo $no ?>"></label>
                                    </div>
                                </td>
                                <td><?php echo($value['kd_gejala'])?></td>
                                <td><?php echo($value['gejala'])?></td>
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
    
    $(".rowtb").on("click",function(){
        // alert($(this).data('value'))
        let selector = "#gejala"+$(this).data('value')
        $(selector).prop('checked', !$(selector).is(":checked"));
    })
</script>