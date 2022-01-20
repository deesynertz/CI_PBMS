<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?php echo $title_active;?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <?php foreach ($breadcrumb as $key) :
                    if(count($breadcrumb) == 1): ?>
                        <li class="breadcrumb-item active"><?php echo $title_active;?></li>
                    <?php else : ?>
                        <li class="breadcrumb-item <?php if(end($breadcrumb) == $key) { echo 'active';}?>"><a <?php if(end($breadcrumb) != $key ) { echo 'href="'.lcfirst($title_active).'"';}?>><?php echo ucfirst($key);?></a></li>
                    <?php endif; endforeach;?>
                </ol>
            </div>
        </div>
    </div>
</div>