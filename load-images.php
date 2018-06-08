<?php
    include('db_con.php');

    $imageNewCount = $_POST['imageNewCount'];

    $sql = "SELECT * FROM image LIMIT $imageNewCount";
    //$stmt = $con->prepare($sql);
    //$stmt->execute();
    //$stmt->bind_result($id, $name, $url);
    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
?>
            <div class="uploadedImg">
                <img id="my-img<?=$row['id']?>" src="<?=$row['url']?>" class="preview-img" data-toggle="modal" data-target="#exampleModal<?=$row['id']?>" />
            </div>
            
            <div class="modal fade" id="exampleModal<?=$row['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="my-img<?=$row['id']?>" src="<?=$row['url']?>" class="modal-img"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
    <?php }

    } else {
        echo "Der er ingen billeder!";
    }
    ?>