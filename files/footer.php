<?php 
    $mode = isset($_SESSION["mode"])? $_SESSION["mode"]:0;
?>
<footer>
    <a href="traitement.php?darkMode=1" id="switchMode">&#9789;</a>
</footer>
<script>
    function switchMode(){
        let switchMode = document.querySelector("#switchMode")
        let mode = <?php echo $mode;?>;
        if(mode == 0){
            document.body.classList.add("darkmode")
            switchMode.href="traitement.php?darkMode=1"
            switchMode.textContent="\u263c"
        }else if(mode==1){
            document.body.classList.remove("darkmode")
            switchMode.href="traitement.php?darkMode=0"
            switchMode.textContent="\u263d"
        }
    }
    switchMode()
</script>