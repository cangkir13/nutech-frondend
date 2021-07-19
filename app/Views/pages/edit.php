<?= $this->extend('layout\page_layout') ?>
<?= $this->section('content') ?>
    <div class="row" >
        <div class="col-md-6 offset-md-3">
            <h3 class="text-align-center"><?=$page_titile?></h3>
            <form method="POST" action="/product/update" enctype="multipart/form-data">    
                <input type="hidden" readonly name="id" value="<?=$data->id ?? ''?>">
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Product name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" placeholder="name product" value="<?=$data->name ?? ''?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Price buy</label>
                    <div class="col-sm-10">
                        <input type="text" name="price_buy" class="form-control" placeholder="10000" value="<?=$data->price_buy ?? ''?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Price sell</label>
                    <div class="col-sm-10">
                        <input type="text" name="price_sell" class="form-control" placeholder="12000" value="<?=$data->price_sell ?? ''?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Stok</label>
                    <div class="col-sm-10">
                        <input type="text" name="stok" class="form-control" placeholder="12" value="<?=$data->stok ?? ''?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Upload image</label>
                    <div class="col-sm-10">
                        <input type="file" name="image" class="form-control">
                    </div>
                    <img class="img-thumbnail" src="<?=env('CI_CLIENTURI')."image/".$data->image?>" >
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?= $this->endSection() ?>