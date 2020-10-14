<?php
$brModela=0;
foreach($proizvods as $proizvod)
{
if($proizvod->brend == $activeBrend)
                        $brModela++;
}
?>
<script>
(function active(){
    var brend= "<?php echo $activeBrend; ?>"+"("+"<?php echo $brModela; ?>"+")";
    var items = document.getElementsByClassName('js');
    for(var i=0;i<items.length;i++){
        console.log(items[i].innerHTML);
        if(items[i].innerHTML==brend){
            items[i].classList.add('activeBrand');
        }
    }
}());
</script>