
<div class="col-md-12">
    <?php
    $i = 1;
    foreach($images as $request){
        foreach($request as $name => $links){
            $j = 1;?>
            <table class="table">
                <thead>
                    <td><h2>ID_<?=$i?>: <?=$name?></h2></td>
                </thead>
                <?php foreach($links as $link){?>
                <tr id="<?=$i?>_<?=$j?>">
                    <td><img src="<?=$link?>" class="img-rounded"></td>
                    <td>ID_<?=$i?>_<?=$j?></td>
                    <td><input class="checkbox" type="checkbox" data-id="<?=$i?>_<?=$j?>"></td>
                </tr>
                <?php
                $j++;
                };?>
            </table>
    <?php $i++;} }?>
</div>


