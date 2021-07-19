<?= $this->extend('layout\page_layout') ?>
<?= $this->section('content') ?>
    <div class="col-md-12">
        <nav>
            <ul class="pagination justify-content-center pagination-sm">
            </ul>
        </nav>
    </div>
    <div class="row" id="content">
        <?php foreach ($products as $key => $value) {?>
            <div class="col-md-3 content text-center">
                <div class="card bg-dark" >
                    <img class="card-img-top" src="<?=env('CI_CLIENTURI')."image/".$value->image?>" alt="Card image cap" style="width: 100%; height: 180px;">
                    <div class="card-body ">
                        <h5 class="card-title text-white"> <?=$value->name?> </h5>
                        <div >
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Harga beli <b><?=$value->price_buy?></b></li>
                                <li class="list-group-item">Harga Jual <b><?=$value->price_sell?></b></li>
                                <li class="list-group-item">Stok <b><?=$value->stok?></b></li>
                            </ul>
                            <div class="btn-group text-center" role="group" aria-label="Basic example">
                                <!-- <button type="button" class="btn btn-primary">Edit</button> -->
                                <a href="/product/edit/<?=$value->id?>" class="btn btn-primary">Edit</a>
                                <a href="/product/delete/<?=$value->id?>" class="btn btn-danger">Delete</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>  
          
    </div>
<?= $this->endSection() ?>